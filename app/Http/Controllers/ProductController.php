<?php

namespace App\Http\Controllers;

use App\Category;
use App\Color;
use App\Product;
use Exception;
use Image;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{

    public function table(Request $request)
    {
        return DataTables::of(Product::all())
            ->editColumn('price', '{!!number_format($price)." ریال "!!}')
            ->editColumn('price_financial', '{!!number_format($price_financial)." ریال "!!}')

            ->editColumn('updated_at', '{!! verta($updated_at)->formatJalaliDate() !!}')
            ->editColumn('sizes', function ($data) {
                return json_decode($data->sizes);
            })

            ->addColumn('colors', function ($data) {
                return $data->colors()->pluck('name')->toArray();
            })
            ->addColumn('category', function ($data) {
                if (isset($data->category->name))
                    return ($data->category->name);
                else
                    return "-";
            })
            ->addColumn('action', function ($data) {
                $content = '
                        <div class="btn-group btn-group-sm" role="group" >
			<form action=' . route("products.destroy", $data->id) . '>
                        <button type="submit" class="btn btn-sm  p-btn-sm btn-dark product_delete" id="' . $data->id . '"><i class="fas fa-trash fa-sm"></i></button>
</form>
                  
      <a href="/products/edit/' . $data->id . '">
                        <button type="button" class="btn btn-sm p-btn-sm btn-dark product_edit" id="' . $data->id . '"><i class="fas fa-sm fa-edit"></i></button>
                        </a>
                        <button 
                        
                        id="' . $data->id . '"
                        data-code="' . $data->code . '"
                        data-name_system="' . $data->name_system . '"
                        data-price="' . $data->price . '"
                        data-code_system="' . $data->code_system . '"
                        data-toggle="modal" data-target="#modal_qrcode"
                        class="js-modal-qrcode btn btn-dark btn-sm p-btn-sm "><i class="fas fa-sm fa-qrcode"></i></button>
                        </div>
                        
                        
          ';
                return $content;
            })

            ->make(true);
    }

    public function index(Request $request)
    {
        return view('product_index');
    }

    public function select(Request $request)
    {
        $product = Product::where('code', '=', $request->code)->get()->first();
        return response()->json(['success' => true, 'product_colors' => $product->colors, 'product_boxes' => $product->boxes, 'product_image' => $product->image]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'picture' => 'required|max:4000|file'
        ]);
        $file_name = time() . 1 . '-' . $request->file('picture')->getClientOriginalName();
        //normal save 
        //$request->file('picture')->move(public_path('/upload'), $file_name);
        $img = Image::make($request->file('picture'));
        $img->fit(400, 400)->save(public_path() . '/upload/' . $file_name);
        return $file_name;
    }

    public function create()
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('product_create', compact('categories'));
    }


    public function store(Request $request)
    {
        if ($request->price_financial == 0)
            $price_financial = $request->price;
        else
            $price_financial = $request->price_financial;
        $request->validate([
            'category_id' => 'required',
            'code' => 'required|unique:products',
            'name' => 'required',
            'image' => 'required',
            'sizes' => 'required',
            'price' => 'required',
            'price_financial' => 'required',
        ]);



        try {
            $product = Product::create([
                'category_id' => $request->category_id,
                "code" => $request->code,
                "code_system" => $request->code_system,
                "name" => $request->name,
                "name_system" => $request->name_system,
                "image" => $request->image,
                "sizes" => json_encode($request->sizes),
                "price" => $request->price,
                "price_financial" => $price_financial,
            ]);
            foreach ($request->colors as $color) {
                $product->colors()->create([
                    'name' => $color['name']
                ]);
            }
            foreach ($request->boxes as $box) {
                $color = $product->colors()->where('name', $box['color'])->first();
                $color->boxes()->create([
                    'name' => $box['name'],
                    'value' => $box['value']
                ]);
            }
            $msg = "محصول مورد نظر افزوده شد";
            $request->session()->flash('msg', $msg);

            return response()->json(['success' => true, 'msg' => $msg]);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'msg' => $e]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::where('parent_id', 0)->get();

        return view('product_edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // dd($request);
        if ($request->price_financial == 0)
            $price_financial = $request->price;
        else
            $price_financial = $request->price_financial;

        $image = $product->image;
        if ($request->image !== 'default/product.png')
            $image = $request->image;


        $product->update([
            'category_id' => $request->category_id,
            "code" => $request->code,
            "code_system" => $request->code_system,
            "name" => $request->name,
            "name_system" => $request->name_system,
            "image" => $image,
            "sizes" => json_encode($request->sizes),
            "price" => $request->price,
            "price_financial" => $price_financial,
        ]);

        $colors_ids = [];
        foreach ($request->colors as $color) {
            $relative_color = $product->colors()->where('name', $color['name'])->first();
            if (!$relative_color) {
                $relative_color = $product->colors()->create([
                    'name' => $color['name'],
                ]);
            }

            $colors_ids[] = $relative_color->id;
        }

        $product->colors()->whereNotIn('id', $colors_ids)->delete();

        $boxes_ids = [];
        foreach ($request->boxes as $box) {
            $color = $product->colors()->where('name', $box['color'])->first();
            if ($color) {

                $relative_box = $color->boxes()->updateOrCreate(
                    [
                        'name' => $box['name']
                    ],
                    [
                        'value' => $box['value'],
                    ]
                );

                $boxes_ids[] = $relative_box->id;
            }
        }

        $product->boxes()->whereNotIn('boxes.id', $boxes_ids)->delete();

        return response()->json(['success' => true, 'id' => $product->code]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        session()->flash('msg', 'Successfully done the operation. ');
        return redirect()->back();
    }


    public function table_order(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Product::all())
                ->editColumn('price', '{!!number_format($price)." ریال "!!}')
                ->editColumn('price_financial', '{!!number_format($price_financial)." ریال "!!}')
                ->addColumn('colors', function ($data) {
                    return $data->colors()->pluck('name')->toArray();
                })
                ->addColumn('category', function ($data) {
                    if (isset($data->category->name))
                        return ($data->category->name);
                    else
                        return "-";
                })
                ->addColumn('action', function ($data) {
                    $content = '<button type="button" class="btn btn-sm btn-dark product_select" id="' . $data->id . '" data-code="' . $data->code . '">انتخاب  </button>';
                    return $content;
                })

                ->make(true);
        }
    }

    public function code_exists_check(Request $request)
    {
        $product_count = Product::where('code', $request->code)->count();
        if ($product_count != 0) {
            return response()->json(['success' => true, 'result' => '1']);
        }
    }
    public function get_box_value(Request $request)
    {
        $product = Product::where('id', $request->product_id)->first();
        $box = $product->boxes->where('color_id', $request->color_id)->where('name', $request->box_name)->first();
        if ($box)
            return  $box->value;
    }

    public function print(Request $request){
        $qr_name_system = $request->get('qr_name_system');
        $qr_price = $request->get('qr_price');
        $qr_code = $request->get('qr_code');
        $qr_code_system = $request->get('qr_code_system');
        $count =  $request->get('count');

        return view('print',compact('qr_name_system','qr_price','qr_code','qr_code_system','count'));
    }
}
