@extends('layout.app')
@section('content')
<style>
    @media print {
        .non-print{
            display: none!important;
        }
    }
</style>
<script src="{{asset('js/jspdf.min.js')}}"></script>

<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">

                    ویرایش محصول <span class="edit_number"></span>

                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <table class="table">
                        <tr>
                            <td class="border-0">بسته</td>
                            <td class="border-0"><span class="box_name"></span> تایی</td>
                        </tr>
                        <tr>
                            <td class="">رنگ</td>
                            <td class=""><span class="product_color"></span> </td>
                        </tr>
                        <tr>
                            <td class=""> تعداد فعلی</td>
                            <td class=""><span class="count"></span> </td>
                        </tr>
                        <tr>
                            <td class=""> تعداد جدید</td>
                            <td class="">
                                <div class="form-group">
                                    <input type="number" min='1' max='0' name=""
                                        class="form-control text-right new_count" dir="rtl" placeholder="">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn_update_item">ذخیره</button>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid mt-4">
    <div class="row">
        @if(Session::has('msg'))
        <div class="col">
            <div class="alert alert-success text-right" role="alert">
                {{Session::get('msg')}}
            </div>
        </div>
        @endif
        @if(Session::has('error'))
        <div class="col">
            <div class="alert alert-danger text-right" role="alert">
                {{Session::get('error')}}
            </div>
        </div>
        @endif
    </div>
    <div class="alert alert-danger alert-inventory-error non-fade d-none" role="alert">
        <p class="p-0 m-0">تعداد کالاهای مشخص در سبد از موجودی انبار از موجودی انبار بیشترند </p>
    </div>
    <div class="card p-4 mb-4">
        <div class="d-flex w-100 justify-content-between  mb-2">
            @isset($client)
            <span class="h5 d-block">

                سبد خرید
                <button class="btn btn-sm btn-dark" onclick="window.print();"><i class="fa fa-share-alt"
                        aria-hidden="true"></i></button>

            </span>
            <span class="h5 d-block mb-2">مشتری : {{$client->name }} {{$client->lastname}}</span>
            @endisset
        </div>
        @isset($order)
        <div class="table-responsive" id="print_table">
            <table class="table table-hover bg-white">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>کد</th>
                        <th>دیتا</th>
                        <th>عنوان</th>
                        <th>رنگ</th>
                        <th>بسته</th>
                        <th>تعداد</th>
                        <th>مجموع</th>
                        <th>فی</th>
                        <th>قیمت</th>
                        <th>عملیلات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $counter => $item)
                    <tr class='item_tr' data-item-count-total='{{ $item->count_total }}' id="{{ $item->id }} "
                        data-box-id="{{$item->box_id}}">
                        <td scope="row">{{ $counter+1 }}</td>
                        <td>{{ $item->product ? $item->product->code : $item->product_id }}</td>
                        <td>{{ $item->id}}</td>
                        <td>
                            <a class="text-dark" data-caption=" {{$item->product_name}} | کد : {{$item->product_code}} "
                                data-fancybox="gallery"
                                href="{{asset('/upload/'.$item->product_image)}}">{{ $item->product_name }}</a>
                        </td>
                        <td>{{ $item->product_color }}</td>
                        <td>{{ $item->box_name }} تایی</td>
                        <td>{{ $item->count }} </td>
                        <td>{{ $item->count_total }} </td>
                        <td>{{ number_format( $item->product_price ) }}</td>
                        <td>{{ number_format( $item->product_price_total ) }}</td>
                        <td>
                            <button class="btn btn-sm item-delete text-center  btn-dark" id="{{$item->id}}"><i
                                    class="fa fa-trash align-middle"></i></button>
                            <button data-toggle="modal" data-target="#modal_edit"
                                class="btn btn-sm item-edit text-center  btn-dark" id="{{$item->id}}"><i
                                    class="fa fa-edit align-middle"></i></button>
                        </td>
                    </tr>
                    @endforeach
                <tfoot>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>مجموع:</td>
                    <td><strong
                            class="m-0 font-weight-bold">{{ number_format( $order->items()->sum('product_price_total') ) }}
                            ریال</td>
                    <td></td>
                </tfoot>
                </tbody>
            </table>
            <form action="{{route('orders.status_set_temporary')}}" class="d-inline non-print">
                <input type="hidden" name="order_id" value="{{$order->id}}">
                <button type="submit" class="btn btn-sm btn-outline-dark d-inline">تبدیل به سبد موقت
                    <i class="fa fa-shopping-bag"></i>
                </button>
            </form>
            <form action="{{route('orders.destroy',$order->id)}}" class="d-inline non-print">
                <input type="hidden" name="order_id" value="{{$order->id}}">
                <button type="submit" class="btn btn-sm btn-outline-danger d-inline">حذف سبد
                    <i class="fa fa-trash"></i>
                </button>
            </form>
        </div>
        <hr>

        <div class="non-print">


            <div class="form-check form-check-inline">
                <span class="ml-2">نوع سفارش :</span>
                <label class="form-check-label ">
                    سفارش خرید <input class="form-check-input align-middle ml-3" type="radio" name="order_type"
                        id="order_buy_radio" value="2" checked>
                </label>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        سفارش مرجوعی <input class="form-check-input align-middle" type="radio" name="order_type"
                            id="order_return_radio" value="3">
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        پیش فاکتور <input class="form-check-input align-middle" type="radio" name="order_type"
                            id="order_preinvoice_radio" value="4">
                    </label>
                </div>
            </div>
            <hr>
            <form action="{{route('orders.convert_cart_to_buy_order')}}" id='order_buy_form'>
                {{-- hiddenfileds --}}
                <input type="hidden" name="amount" value="{{$order->items()->sum('product_price_total')}}"
                    name="amount">
                <input type="hidden" name="amount_financial"
                    value="{{$order->items()->sum('product_price_total_financial')}}" name="amount_financial ">
                <input type="hidden" name="status" value="3">
                <input type="hidden" name="order_id" value="{{$order->id}}">
                <input type="hidden" name="client_id" value="{{$client->id}}">
                {{-- end --}}
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">وجه نقد:</label>
                            <input type="text" class="form-control js_autonumeric" name="cash">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">کارت خوان:</label>
                            <input type="text" class="form-control js_autonumeric" name="pos">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">چک:</label>
                            <input type="text" class="form-control js_autonumeric" name="cheque">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">مانده حساب:</label>
                            <input type="text" class="form-control  js_autonumeric text-right" dir="ltr"
                                value="{{$client->balance}}" name="balance" id="balance" disabled>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="d-block">رسید: <span class="invoice_message"></span></label>
                            <span class="btn btn-dark btn-block mb-2 w-100 btn-file-invoice ">
                                انتخاب تصویر <input type="file" class="custom-file-input-invoice"
                                    name="invoice_file_input" id="invoice">
                            </span>
                            <input type="hidden" class="js-invoice-picture" name="image">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">تخیف:</label>
                            <input type="text" class="form-control js_autonumeric" name="discount">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">تاریخ دستی:</label>
                            <div class="row">
                                <div class="col px-1 pr-3  "><input type="number" max="1500" min="1398"
                                        class="form-control" name="year" placeholder="سال"></div>
                                <div class="col px-1"><input type="number" max="12" min="1" class="form-control"
                                        name="month" placeholder="ماه"></div>
                                <div class="col px-1 pl-3 "><input type="number" max="31" min="1" class="form-control"
                                        name="day" placeholder="روز"></div>
                            </div>
                            <small class="form-text text-muted ">مقدار پیشفرض فیلد تاریخ اکنون است</small>
                            <hr>
                            <label for="">نوع خرید</label>
                            <div class="row">
                                <div class="col">
                                    <input type="radio" name="noe_kharid" value="-" autocomplete="off" checked>
                                    <label for="">نا معلوم</label>
                                    <input type="radio" name="noe_kharid" value="حضوری">
                                    <label for="">حضوری</label>
                                    <input type="radio" name="noe_kharid" value="غیر حضوری">
                                    <label for="">غیر حضوری</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">توضیح :</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <button type="submit" class="submit_buy_order btn btn-dark float-left" href="#" role="button">
                            ثبت
                            سفارش <i class="fa fa-briefcase"></i>
                    </div>
                </div>
            </form>
            <form action="{{route('orders.convert_cart_to_returned_order')}}" id='order_return_form' class="d-none">
                <input type="hidden" name="order_id" value="{{$order->id}}">
                <input type="hidden" name="client_id" value="{{$client->id}}">
                <input type="hidden" name="amount_financial"
                    value="{{$order->items()->sum('product_price_total_financial')}}" name="amount_financial">
                <input type="hidden" name="amount" value="{{$order->items()->sum('product_price_total')}}"
                    name="amount">
                <p class="alert-warning alert non-fade">
                    - با ثبت این سفارش <strong>تائید میکنید</strong> مشتری لیست کالاهای فوق را مرجوع کرده است
                    <br>
                    - کالا به انبار اضافه شده و مانده حساب مشتری به روز میشود
                </p>
                <div class="row">
                    <div class="col-5">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">مبلغ مرجوعی</label>
                                    <input type="text" class="form-control js_autonumeric" name="amount_returned"
                                        placeholder="{{ number_format( $order->items()->sum('product_price_total') ) }}">
                                    <small class="form-text text-muted ">مقدار پیشفرض فیلد خالی مجموع فاکتوراست</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">مانده حساب:</label>
                                    <input type="text" class="form-control js_autonumeric text-right" dir="ltr"
                                        value="{{$client->balance}}" name="balance" id="balance" disabled>
                                    <small class="form-text text-muted ">مبلغ مرجوعی از مانده مشتری کسر میشود</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">تاریخ دستی:</label>
                            <div class="row">
                                <div class="col px-1 pr-3 "><input type="number" max="1500" min="1398"
                                        class="form-control" name="year" placeholder="سال"></div>
                                <div class="col px-1 "><input type="number" max="12" min="1" class="form-control"
                                        name="month" placeholder="ماه"></div>
                                <div class="col px-1 pl-3 "><input type="number" max="31" min="1" class="form-control"
                                        name="day" placeholder="روز"></div>
                            </div>
                            <small class="form-text text-muted ">مقدار پیشفرض فیلد تاریخ اکنون است</small>
                            <hr>
                            <label for="">نوع خرید</label>
                            <div class="row">
                                <div class="col">
                                    <input type="radio" name="noe_kharid" value="" checked>
                                    <label for="">نامعلوم</label>
                                    <input type="radio" name="noe_kharid" value="hozoori">
                                    <label for="">حضوری</label>
                                    <input type="radio" name="noe_kharid" value="gheyrehozoori">
                                    <label for="">غیر حضوری</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="form-group">
                            <label for="">توضیح مرجوعی : <strong class="text-danger">در فاکتور درج
                                    میشود</strong></label>
                            <textarea class="form-control" name="" rows="7"
                                placeholder="لطفا کد فاکتور مرجع مرجوعی و علت مرجوعی را درج کنید."></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-dark  float-left" type="submit"> تایید مرجوعی <i
                                class="fas fa-sync-alt align-middle"></i></button>
                    </div>
                </div>
            </form>
            <form action="{{route('orders.convert_cart_to_pre_invoice')}}" id='order_preinvoice_form' class="d-none">
                <input type="hidden" name="status" value="2">
                <input type="hidden" name="amount" value="{{$order->items()->sum('product_price_total')}}">
                <input type="hidden" name="order_id" value="{{$order->id}}">
                <div class="row">
                    <div class="col-12">
                        <p class="text-dark">
                            این حالت مشابه سبد موقت می باشد با این تفاوت که <strong class="text-danger"> محصولات سفارش
                                از
                                موجودی انبار کسر میشوند</strong>
                        </p>
                        <button class="btn btn-dark" type="submit"> ثبت پیش فاکتور <i
                                class="fas fa-clipboard-check align-middle"></i></button>
                    </div>
                </div>
            </form>
        </div>
        @else
        <h1 class="text-center font-weight-bold">سبد خرید شما خالی است</h1>
        <div class="d-flex w-100 justify-content-center">
            <a href="{{route('orders.create')}}" class="btn mx-2 d-block btn-dark text-center font-weight-bold">ثبت
                سفارش
            </a>
            <a href="{{route('orders.index_temporary')}}"
                class="btn d-block btn-outline-dark text-center font-weight-bold">
                مشاهده سبد خرید های
                موقت
            </a>
        </div>
        @endisset
    </div>

</div>

<script>
    AutoNumeric.multiple('.js_autonumeric',{
        unformatOnSubmit: true,
        allowDecimalPadding:false,
          });
</script>
{{-- itemEdit --}}
<script>
    var edit_selected = 0;
$('.item-edit').click(function(){
edit_selected = $(this).attr('id');
$('.edit_number').html(edit_selected);

// get_item_ajax
$.get("{{route('items.get_item_values')}}", 
{id:edit_selected},
function(data){
    $('.box_name').html(data.box_name);
    $('.product_color').html(data.product_color);
    $('.count').html(data.count + " بسته ");
});

//get_box_ajax
$.get("{{route('items.get_box')}}", 
{id:edit_selected},
function(data){
  $('.new_count').val('');
  $('.new_count').attr('placeholder'," موجودی " + data.value + " بسته ");
  $('.new_count').attr('max',data.value);
});
})


//update_item
$('.btn_update_item').click(function(){
//item_update
$.get("{{route('items.update_item')}}", 
    {
        id:edit_selected,
        new_count:$('.new_count').val()
    },
    function(data,status){
    console.log(data);
    location.reload(true);
    });
})

</script>

{{-- jspdf --}}

<script>

</script>




@endsection