<?php

namespace App\Http\Controllers;

use App\Box;
use App\Item;
use App\Order;
use App\Client;
use App\Product;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;
use stdClass;
use Image;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function table()
    {
        $orders = Order::Where('status', '3')->get();
        return DataTables::of($orders)
            ->addColumn('client', function ($data) {
                if (isset($data->client))
                    return ($data->client->name . " " . $data->client->lastname);
                else
                    return "-";
            })
            ->addColumn('user', function ($data) {
                if (isset($data->user))
                    return ($data->user->username);
                else
                    return "-";
            })
            ->addColumn('action', function ($data) {
                $id = $data->id;
                $order_show_link = route('orders.show', $id);
                $invoice_show_link = route('orders.show_invoice', $id);
                $maali_accept_order_link = route('orders.maali_accept_status', $id);
                $anbaar_accept_order_link = route('orders.anbaar_accept_status', $id);
                $cover_order_to_pre_invoice_link = route('orders.convert_order_to_pre_invoice', $id);
                $destroy_order_link = route('orders.destroy_order', $id);
                $confirm_query = 'onclick="return confirm(';
                $confirm_query .= "'آیا از حذف این سفارش مطمئنید؟'";
                $confirm_query .= ')"';
                $string = "<div class='btn-group-sm btn-group'>";
                $string .= "<a class='btn btn-sm btn-dark' data-toggle='tooltip'  title='مشاهده سفارش'  href=$order_show_link><i class='fas fa-eye'></i></a>";
                $string .= "<a class='btn btn-sm btn-dark' data-toggle='tooltip'  title='مشاهده فاکتور'  href=$invoice_show_link><i class='fas fa-file-invoice'></i></a>";
                if (auth()->user()->role == 1){
                    if($data->returned == 0){
                        $string .= "<a class='btn btn-sm btn-dark' data-toggle='tooltip' data-placement='top' title='تبدیل فاکتور به پیش فاکتور' href=$cover_order_to_pre_invoice_link><i class='fas fa-shopping-cart'></i></a>";
                    }
                    if($data->returned == 1){
                    $string .= "<button class='btn btn-dark' disabled><i class='fas fa-shopping-cart'></i></button>";
                    }

                }
                if (auth()->user()->role == 1){
                    $string .= "<a class='btn btn-sm btn-dark' data-toggle='tooltip'  title='حذف سفارش'  href='$destroy_order_link' $confirm_query><i class='fas fa-trash'></i></a>";
                }

                if (auth()->user()->role == 1) {
                    if ($data->maali_status != 1)
                        $string .= "<a href='$maali_accept_order_link'  data-toggle='tooltip'  title='تایید سفارش' class='btn btn-dark btn-sm' disabled ><i class='fas fa-check'></i></a>";
                    else {
                        $string .= "<button class='btn btn-success btn-sm'  disabled ><i class='fas fa-check'></i></button>";
                    }
                }
                if (auth()->user()->role == 2) {
                    if ($data->maali_status != 1) {
                        $string .= "<span class='btn btn-secondary btn-sm' data-toggle='tooltip'  title='در انتظار تایید مالی'  disabled ><i class='fas fa-hourglass-half'></i></span>";
                    }
                    if ($data->anbaar_status != 1 && $data->maali_status == 1) {
                        $string .= "<a href='$anbaar_accept_order_link'  data-toggle='tooltip'  title='تایید سفارش' class='btn btn-dark btn-sm' disabled ><i class='fas fa-check'></i></a>";
                    }
                    if ($data->anbaar_status == 1 && $data->maali_status == 1) {
                        $string .= "<button class='btn btn-success btn-sm'  disabled ><i class='fas fa-check'></i></button>";
                    }
                }





                return ($string);
            })
            ->editColumn('updated_at', '{!! verta($updated_at)->formatJalaliDatetime() !!}')
            ->editColumn('date_manual', '{!! verta($updated_at)->formatJalaliDatetime() !!}')
            ->make(true);
    }
    public function table_temporary()
    {
        $orders = Order::Where('status', '1')->Where('user_id', auth()->user()->id)->get();
        return DataTables::of($orders)
            ->addColumn('client', function ($data) {
                if (isset($data->client))
                    return ($data->client->name . " " . $data->client->lastname);
                else
                    return "-";
            })
            ->addColumn('action', function ($data) {
                $id = $data->id;
                $status_set_cart_link = route('orders.status_set_cart', $id);
                $order_destory_link = route('orders.destroy', $id);
                $string = "<a class='btn btn-sm btn-dark'href=$status_set_cart_link> ویرایش سبد موقت (تبدل به سبد) <i class='fa fa-shopping-cart align-middle' aria-hidden='true'></i> </a>";
                $string .= "<a class='btn btn-sm mx-2 btn-outline-dark'href=$order_destory_link> حذف سبد <i class='fa fa-trash align-middle' aria-hidden='true'></i></a>";
                return ($string);
            })
            ->make(true);
    }
    public function table_foroosh()
    {
        $orders = Order::Where('status', '3')->Where('user_id', auth()->user()->id)->get();
        return DataTables::of($orders)
            ->addColumn('client', function ($data) {
                if (isset($data->client))
                    return ($data->client->name . " " . $data->client->lastname);
                else
                    return "-";
            })
            ->addColumn('user', function ($data) {
                if (isset($data->user))
                    return ($data->user->username);
                else
                    return "-";
            })
            ->addColumn('action', function ($data) {
                $id = $data->id;
                $show_link = route('orders.show', $id);
                $show_invoice_link = route('orders.show_invoice', $id);
                $foroosh_accept_order_link = route('orders.foroosh_accept_status', $id);
                $string = "<div class='btn-group btn-group-sm'>";
                $string .= "<a href=$show_link class='btn btn-dark btn-sm'><i class='fas fa-eye'></i></a>";
                if ($data->maali_status == 1) {
                    $string .= "<a href=$show_invoice_link  class='btn btn-dark btn-sm' ><i class='fas fa-file-invoice'></i></a>";
                } else {
                    $string .= "<button title='انتظار تایید مالی' class='btn btn-dark btn-sm' disabled><i class='fas fa-file-invoice'></i></button>";
                }
                if ($data->maali_status == 1 && $data->anbaar_status == 1 && $data->foroosh_status != 1) {
                    $string .= "<a href=$foroosh_accept_order_link  class='btn btn-dark btn-sm' ><i class='fas fa-check'></i></a>";
                } else {
                    if ($data->foroosh_status != 1)
                        $string .= "<button class='btn btn-dark btn-sm' disabled ><i class='fas fa-check'></i></button>";
                    else
                        $string .= "<button class='btn btn-success btn-sm' disabled ><i class='fas fa-check'></i></button>";
                }
                $string .= "</div>";
                return ($string);
            })
            ->editColumn('updated_at', '{!! verta($updated_at)->formatDifference() !!}')
            ->make(true);
    }
    public function table_pre_invoice()
    {
        if (auth()->user()->role == 3) {
            $orders = Order::Where('status', '2')->Where('user_id', auth()->user()->id)->get();
        }
        if (auth()->user()->role != 3) {
            $orders = Order::Where('status', '2')->get();
        }
        return DataTables::of($orders)
            ->addColumn('client', function ($data) {
                if (isset($data->client))
                    return ($data->client->name . " " . $data->client->lastname);
                else
                    return "-";
            })
            ->addColumn('user', function ($data) {
                if (isset($data->user))
                    return ($data->user->username);
                else
                    return "-";
            })
            ->editColumn('amount', '{!! number_format($amount) !!}' . ' ریال ')
            ->addColumn('action', function ($data) {
                $id = $data->id;
                $status_set_cart_link = route('orders.convert_pre_invoice_to_cart', $id);
                $order_destory_link = route('orders.destroy_pre_invoice', $id);
                $string = "<div class='btn-group btn-group-sm'>";
                if (auth()->user()->role == 3) {
                    $string .= "<a class='btn btn-sm btn-dark 'href=$status_set_cart_link>  <i class='fa fa-edit align-middle' aria-hidden='true'></i> </a>";
                }
                $string .= "<a class='btn btn-sm  btn-dark 'href=$order_destory_link>  <i class='fa fa-trash align-middle' aria-hidden='true'></i></a>";

                $show_link = route('orders.show', $id);
                $show_invoice_link = route('orders.show_pre_invoice', $id);
                $string .= "<a href=$show_link class='btn btn-dark btn-sm  '><i class='fas fa-eye'></i></a>";
                $string .= "<a href=$show_invoice_link class='btn btn-dark btn-sm  '><i class='fas fa-file-invoice'></i></a>";
                $string .= "</div>";
                return ($string);
            })
            ->editColumn('updated_at', '{!! verta($updated_at)->formatJalaliDatetime() !!}')
            ->make(true);
    }
    public function index()
    {
        return view('order_index');
    }
    public function index_temporary()
    {
        return view('order_temporary_index');
    }
    public function index_pre_invoice()
    {
        $user = auth()->user();
        $open_cart_count = Order::Where('status', '0')->Where('user_id', $user->id)->count();
        return view('order_pre_invoice_index', compact('open_cart_count'));
    }
    public function create()
    {
        $user = auth()->user();
        $open_orders_count = Order::where('status', '3')->Where('user_id', $user->id)->count();
        if ($open_orders_count < 5) {
            $cart = Order::Where('status', '0')->Where('user_id', $user->id)->first();
            if ($cart) {
                $client = $cart->client;
                $item = $cart->items()->first();
                return view('order_create', compact('client', 'item'));
            }
            return view('order_create');
        } else {
            return view('order_open_error');
        }
    }
    public function store(Request $request, Order $order)
    {
        $user = auth()->user();
        $order = Order::Where('status', '0')->Where('user_id', $user->id)->first();
        if (!$order) {
            $order = Order::Create([
                'status' => '0',
                'type' => '99',
                'user_id' => $user->id,
                'client_id' => $request->get('client_id'),
            ]);
        }
        foreach ($request->get('item') as $box_id => $count) {
            $item = $order->items->where('box_id', $box_id)->first();
            if ($item) {
                $box = Box::where('id', $box_id)->first();
                if ($item->count + $count <= $box->value) {
                    $item->count = $item->count + $count;
                    $item->count_total = $item->count * $item->box_name;
                    $item->save();
                } else {
                    $error = "مقدار محصول اضافه شده از مجموع کالای موجودی انبار و سبد شما بیشتر است";
                    $request->session()->flash('error', $error);
                    return redirect(route('orders.create'));
                }
            } else {
                $box = Box::where('id', $box_id)->first();
                $product = Product::where('code', $request->code)->first();
                if ($count) {
                    if ($count <= $box->value) {
                        $item = $order->items()->create([
                            'cilent_id' => $request->client_id,
                            'box_id' => $box_id,
                            'box_name' => $box->name,
                            'product_id' => $product->id,
                            'product_color' => $box->color->name,
                            'product_code' => $product->code,
                            'product_name' => $product->name,
                            'product_image' => $product->image,
                            'product_category' => $product->category->name,
                            'product_price' => $product->price,
                            'product_price_total' =>  $product->price * $box->name * $count,
                            'product_price_financial' => $product->price_financial,
                            'product_price_total_financial' => $product->price_financial * $box->name * $count,
                            'count' => $count,
                            'count_total' => $count * intval($box->name),
                        ]);
                    } else {
                        $error = "مقدار محصول اضافه شده از مجموع کالای موجودی انبار و سبد شما بیشتر است";
                        if ($count == 0) {
                            $error = "مقدار 0 قابل قبول نیست";
                        }
                        $request->session()->flash('error', $error);
                        return redirect(route('orders.create'));
                    }
                }
            }
        }
        //if cart emptry after every thing
        $cart = Order::Where('status', '0')->Where('user_id', $user->id)->first();
        if (!$cart->items->first()) {
            $cart->delete();
        }
        $msg = "محصول مورد نظر به سبد اضافه شد";
        $request->session()->flash('msg', $msg);
        return redirect(route('orders.create'));
    }
    public function show(Order $order)
    {
        $jalali = verta($order->updated_at)->formatJalaliDate();
        $jalali_manual = verta($order->manual_date)->formatJalaliDate();
        $client = Client::where('id', $order->client_id)->first();
        return view('order_show', compact('order', 'jalali', 'jalali_manual', 'client'));
    }
    public function show_invoice(Order $order)
    {
        $jalali = verta($order->updated_at)->formatJalaliDate();
        $jalali_manual = verta($order->manual_date)->formatJalaliDate();
        $client = Client::where('id', $order->client_id)->first();
        return view('order_show_invoice', compact('order', 'jalali', 'jalali_manual', 'client'));
    }
    public function show_pre_invoice(Order $order)
    {
        $jalali = verta($order->manual_date)->formatJalaliDate();
        $client = Client::where('id', $order->client_id)->first();
        return view('order_show_pre_invoice', compact('order', 'jalali', 'client'));
    }
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back();
    }

    public function item_delete(Item $item)
    {
        $item->delete();
        // $user = auth()->user();
        // $cart = Order::Where('status', '0')->Where('user_id', $user->id)->first();

        $cart = Order::Where('status', '0')->first();
        if (!$cart->items->first()) {
            $cart->delete();
        }

        return response()->json(['success' => true, 'msg' => $cart->items]);
    }



    function cart()
    {
        $user = auth()->user();
        $cart = Order::Where('status', '0')->Where('user_id', $user->id)->first();
        if ($cart) {
            $client = $cart->client;
            return view('order_cart', ['order' => $cart, 'client' => $client]);
        }
        return view('order_cart');
    }
    public function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('clients')
                ->where('name', 'like', '%' . $query . '%')
                ->orWhere('lastname', 'like', '%' . $query . '%')
                ->get();
            $output = '<div class="client_dropdown dropdown-menu dropdown-menu-right w-100 border-0 d-block">';
            foreach ($data as $row) {
                $output .=
                    "<li class='client_li dropdown-item' id='" . $row->id . "'><a href='#' class='text-body' >" . $row->name . ' ' . $row->lastname . "</a></li>";
            }
            $output .= '</div>';
            echo $output;
        }
    }
    public function upload(Request $request)
    {
        $request->validate([
            'invoice' => 'required|max:4000|file'
        ]);
        $file_name = time() . 1 . '-' . $request->file('invoice')->getClientOriginalName();
        //normal save 
        //$request->file('invoice')->move(public_path('/upload'), $file_name);
        $img = Image::make($request->file('invoice'));
        $img->resize($img->width() / 2, $img->height() / 2)->save(public_path() . '/upload/invoices/' . $file_name);
        return $file_name;
    }
    public function status_set_temporary(Request $request)
    {
        $user = auth()->user();
        $cart = Order::Where('status', '0')->Where('user_id', $user->id);
        if ($cart) {
            $cart->update([
                'status' => 1
            ]);
        } else {
            return false;
        }
        return redirect()->route('orders.index_temporary');
    }
    public function status_set_cart(Order $order)
    {
        $user = auth()->user();
        $cart = Order::Where('status', '0')->Where('user_id', $user->id);
        if ($cart) {
            $cart->update([
                'status' => 1
            ]);
        }
        $temporary = Order::Where('id', $order->id)->Where('user_id', $user->id);
        if ($temporary) {
            $temporary->update([
                'status' => 0
            ]);
        }
        return redirect()->route('orders.cart');
    }
    public function convert_cart_to_buy_order(Request $request)
    {
        $order = Order::where('id', $request->get('order_id'));
        if (isset($request->year) && isset($request->month) && isset($request->day)) {
            $date = Verta::getGregorian($request->get('year'), $request->get('month'), $request->get('day'));
            $date = $date[0] . '-' . $date[1] . '-' . $date[2] . " 12:00:00";
        } else {
            $date = now();
        }
        //cash
        if (isset($request->cash))
            $cash = $request->cash;
        else
            $cash = 0;
        //pos
        if (isset($request->pos))
            $pos = $request->pos;
        else
            $pos = 0;
        //cheque
        if (isset($request->cheque))
            $cheque = $request->cheque;
        else
            $cheque = 0;
        //discount
        if (isset($request->discount))
            $discount = $request->discount;
        else
            $discount = 0;
        $type = null;
        if (intval($cash) + intval($pos) + intval($discount) == intval($request->get('amount'))  && (intval($cheque) == 0 || empty(intval($cheque)))) {
            $type = 0; //naghd
        }
        if (intval($cash) + intval($pos) + intval($cheque) + intval($discount) == intval($request->get('amount')) && (intval($cheque) > 0)) {
            $type = 1; //cheque
        }
        if (intval($cash) + intval($pos) + intval($cheque) + intval($discount) < intval($request->get('amount'))) {
            $type = 2; //hesabbaz
        }
        //maali_status
        $maali_status = 0;
        if ($type == 0) {
            $maali_status = 1;
        }
        //balance
        if (intval($cash) + intval($pos) + intval($cheque)  + intval($discount) <= intval($request->get('amount'))) {
            $client = Client::Where('id', $request->client_id)->first();
            if ($type == 2) {

                //important value increase
                $increase_balance = intval($request->get('amount')) - intval($cash) + intval($pos) + intval($cheque) - intval($discount);
                $client->balance = $client->balance + $increase_balance;
                $client->save();
            }
            $order->update([
                'amount' => intval($request->get('amount')),
                'amount_financial' => $request->get('amount_financial'),
                'status' => $request->get('status'),
                'type' => $type,
                'cash' => $cash,
                'pos' => $pos,
                'cheque' => $cheque,
                'discount' => $discount,
                'amount_returned' => 0,
                'description' => $request->get('description'),
                'image' => $request->get('image'),
                'date_manual' => $date,
                'maali_status' => $maali_status,
                'noe_kharid' => $request->get('noe_kharid'),
            ]);
            $order_selector = Order::where('id', $request->get('order_id'))->first();
            foreach ($order_selector->items()->get() as $item) {
                $box = Box::Where('id', $item->box_id)->first();
                if ($box->value * $box->name - $item->count_total >= 0) {
                    $box->value = $box->value - $item->count;
                    $box->save();
                } else {
                    $order->update(['status' => 0]);
                    $error = "موجودی انبار با سفارش تناقض دارد";
                    $request->session()->flash('error', $error);
                    return redirect()->route('orders.cart');
                }
            };
        } else {
            $order->update(['status' => 0]);
            $error = "مجموع فیلد ها از مبلغ سفارش بیشتر است";
            $request->session()->flash('error', $error);
            return redirect()->route('orders.cart');
        }
        return redirect()->route('orders.index');
    }
    public function convert_cart_to_pre_invoice(Request $request)
    {
        $user = auth()->user();
        $cart = Order::Where('status', '0')->Where('user_id', $user->id);
        if ($cart) {
            $cart->update([
                'status' => 2,
                'amount' => $request->amount,
            ]);
        } else {
            return false;
        }
        $order_selector = Order::where('id', $request->get('order_id'))->first();
        foreach ($order_selector->items()->get() as $item) {
            $box = Box::Where('id', $item->box_id)->first();
            if ($box->value * $box->name - $item->count_total >= 0) {
                $box->value = $box->value - $item->count;
                $box->save();
            } else {
                $cart->update(['status' => 0]);
                $error = "موجودی انبار با سفارش تناقض دارد";
                $request->session()->flash('error', $error);
                return redirect()->route('orders.cart');
            }
        };
        //mishe inam mahdood kard be status 3 haye baz 
        return redirect()->route('orders.index_pre_invoice');
    }
    public function convert_cart_to_returned_order(Request $request)
    {
        //
        if (intval($request->amount_returned) > $request->amount) {
            $error = "مبلغ مرجوعی مرجوعی از مجموع فاکتور بیشتر است";
            $request->session()->flash('error', $error);
            return (redirect()->route('orders.cart'));
        }
        //
        $order = Order::where('id', $request->get('order_id'));
        if (isset($request->year) && isset($request->month) && isset($request->day)) {
            $date = Verta::getGregorian($request->get('year'), $request->get('month'), $request->get('day'));
            $date = $date[0] . '-' . $date[1] . '-' . $date[2] . " 12:00:00";
        } else {
            $date = now();
        }
        $client = Client::Where('id', $request->client_id)->first();
        //
        $returned_balance = $request->get('amount');
        if (intval($request->amount_returned) !== 0)
            $returned_balance = $request->amount_returned;
        //
        $client->balance = $client->balance - $returned_balance;
        $client->save();
        $order->update([
            'returned' => 1,
            'amount' => intval($request->get('amount')),
            'amount_financial' => $request->get('amount_financial'),
            'status' => 3,
            'type' => 3,
            'cash' => 0,
            'pos' => 0,
            'cheque' => 0,
            'discount' => 0,
            'amount_returned' => $returned_balance,
            'description' => $request->get('description'),
            'date_manual' => $date,
        ]);
        $order_selector = Order::where('id', $request->get('order_id'))->first();
        foreach ($order_selector->items()->get() as $item) {
            $box = Box::Where('id', $item->box_id)->first();
            $box->value = $box->value + $item->count;
            $box->save();
        };
        return redirect()->route('orders.index');
    }
    public function convert_pre_invoice_to_cart(Order $order)
    {
        $user = auth()->user();
        //now cart to temporary
        $cart = Order::Where('status', '0')->Where('user_id', $user->id);
        if ($cart) {
            $cart->update([
                'status' => 1,
            ]);
        }
        $pre_invoice = Order::Where('id', $order->id)->Where('user_id', $user->id);
        if ($pre_invoice) {
            $pre_invoice->update([
                'status' => 0,
                'amount' => null,
            ]);
        }
        $pre_invoice_selector = $pre_invoice->first();
        foreach ($pre_invoice_selector->items()->get() as $item) {
            $box = Box::Where('id', $item->box_id)->first();
            $box->value = $box->value + $item->count;
            $box->save();
        }
        return redirect()->route('orders.cart');
    }
    public function destroy_pre_invoice(Order $order)
    {
        $pre_invoice = Order::Where('id', $order->id);
        $pre_invoice_selector = $pre_invoice->first();
        foreach ($pre_invoice_selector->items()->get() as $item) {
            $box = Box::Where('id', $item->box_id)->first();
            $box->value = $box->value + $item->count;
            $box->save();
        }
        $pre_invoice->delete();
        return redirect()->route('orders.index_pre_invoice');
    }
    /*
 * 
 * 
 * 
 * accept 
 * 
 * 
 * 
 * 
*/
    public function foroosh_accept_status(Order $order)
    {
        $order->foroosh_status = 1;
        $order->save();
        return redirect()->back();
    }
    public function maali_accept_status(Order $order)
    {
        $order->maali_status = 1;
        $order->save();
        return redirect()->back();
    }
    public function anbaar_accept_status(Order $order)
    {
        $order->anbaar_status = 1;
        $order->save();
        return redirect()->back();
    }
    /*
maali
*/
    public function convert_order_to_pre_invoice(Order $order)
    {
        $order->status = 2;
        $client = Client::where('id',$order->client_id)->first();
        $increase_balance = $order->amount - $order->cash + $order->pos + $order->cheque - $order->discount;
        $client->balance = $client->balance - $increase_balance;
        $client->save();
        $order->save();
        /////////MOHEEEEEEEEEEEEM   MARJOOYI NABAYAD PISH FACTOR BSHE
        /////////MOHEEEEEEEEEEEEM   BALANCE BAYAD DISCOUNT MOHASABE SHE
        //mishe inam mahdood kard be status 3 haye baz 
        return redirect()->route('orders.index_pre_invoice');
    }
    public function destroy_order(Order $order)
    {
        $order = Order::Where('id', $order->id)->first();
        $returned_balance = $order->amount;
        if (intval($order->amount_returned) !== 0) {
            $returned_balance = $order->amount_returned;
        }
        $client = Client::Where('id', $order->client_id)->first();
        if ($order->returned == 1) {
            foreach ($order->items()->get() as $item) {
                $box = Box::Where('id', $item->box_id)->first();
                $box->value = $box->value - $item->count;
                $box->save();
            }
            $client->balance = $client->balance + $returned_balance;
            $client->save();
        }
        if ($order->returned == 0) {
            foreach ($order->items()->get() as $item) {
                $box = Box::Where('id', $item->box_id)->first();
                $box->value = $box->value + $item->count;
                $box->save();
            }
            $client->balance = $client->balance - $returned_balance;
            $client->save();
        }
        $order->delete();
        return redirect(route('orders.index'));
    }
}
