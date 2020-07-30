@extends('layout.app')
@section('content')
<div class="container-fluid mt-4">
    <div class="h4 d-flex justify-content-between">
        <div>
            <span>سفارش : </span>
            <span>
                @if($order->returned == 0)
                فروش
                @else
                مرجوعی
                @endif
            </span>
        </div>
        <div>
            <span> کد : </span>
            <span>{{$order->id}}</span>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover bg-white">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>کد</th>
                    <th>عنوان</th>
                    <th>رنگ</th>
                    <th>بسته</th>
                    <th>تعداد</th>
                    <th>مجموع</th>
                    <th>فی</th>
                    <th>قیمت</th>
                    {{-- <th>عملیات</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $counter => $item)
                <tr>
                    <td scope="row">{{ $counter+1 }}</td>
                    <td>{{ $item->product ? $item->product->code : $item->product_id }}</td>
                    <td>
                        <a class="text-dark" data-caption="{{$item->product_name . ' | کد : ' . $item->product_code}}"
                            data-fancybox="gallery"
                            href="{{asset('upload').'/'.$item->product_image}}">{{$item->product_name}}</a>
                    </td>
                    <td>{{ $item->product_color }}</td>
                    <td>{{ $item->box_name }} تایی</td>
                    <td>{{ $item->count }} </td>
                    <td>{{ $item->count_total }} </td>

                    <td>{{ number_format( $item->product_price ) }}</td>
                    <td>{{ number_format( $item->product_price_total ) }}</td>
                    {{-- <td><button class="btn btn-sm item-delete text-center  btn-dark" id="{{$item->id}}"><i
                        class="fa fa-trash align-middle"></i></button></td> --}}
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>مجموع:</td>
                <td>
                    <h6 class="m-0 font-weight-bold">{{ number_format( $order->items()->sum('product_price_total') ) }}
                        ریال</h6>
                </td>
                {{-- <td></td> --}}
            </tfoot>
        </table>
    </div>



    <div class="row mb-5">
        <div class="col-12">
            <strong class="d-block mb-2">سفارش :</strong>

            <div class="p-3 border card rounded-0">
                <table class="table w-100 m-0">
                    <tbody>
                        <tr>
                            <td class="px-0 border-0"><label class="m-0">نوع پرداخت:</label></td>
                            <td class=" border-0">
                                <b>
                                    @switch($order->type)
                                    @case(0)
                                    نقد
                                    @break
                                    @case(1)
                                    چک + نقد
                                    @break
                                    @case(2)
                                    حساب باز
                                    @break
                                    @case(3)
                                    مرجوعی
                                    @break
                                    @endswitch
                                </b>

                            </td>
                            <td class="border-0"><label class="m-0" for="amount"> نوع سفارش : </label></td>
                            <td class="pr-0 border-0">
                                <b>
                                    @switch($order->status)
                                    @case(0)
                                    <span class="text-danger"> سبد : باپشتیبانی تماس بگیرید چیزی اشتباه است</span>
                                    @break
                                    @case(1)
                                    <span class="text-danger"> سبد موقت : باپشتیبانی تماس بگیرید چیزی اشتباه است</span>
                                    @break
                                    @case(2)
                                    <span class="text-warrning"> پیش سفارش</span>
                                    @break
                                    @case(3)
                                    <span>سفارش اصلی</span>
                                    @break
                                    @endswitch
                                </b>
                            </td>
                        </tr>

                        <tr>
                            <td class="px-0"><label class="m-0">مبلغ سفارش:</label></td>
                            <td class="">
                                <b>{!!number_format($order->amount)!!}</b>
                            </td>
                            <td><label class="m-0" for="discount">مبلغ مرجوعی:</label></td>
                            <td class="pr-0">
                                <b>{!!number_format($order->amount_returned)!!}</b>
                            </td>
                        </tr>


                        <tr>
                            <td class="px-0"><label class="m-0">وجه نقد:</label></td>
                            <td class="">
                                <b>{!!number_format($order->cash)!!}</b>
                            </td>
                            <td><label class="m-0" for="discount">مبلغ تخفیف:</label></td>
                            <td class="pr-0">
                                <b>{!!number_format($order->discount)!!}</b>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-0"><label class="m-0" for="pos">کارت خوان:</label></td>
                            <td class="">
                                <b>{!!number_format($order->pos)!!}</b>
                            </td>
                            <td><label class="m-0" for="cheque">چک:</label></td>
                            <td class="pr-0">
                                <b>{!!number_format($order->cheque)!!}</b>
                            </td>
                        </tr>
                        <tr>

                        <tr>
                            <td class="px-0"><label class="m-0" for="pos">تاریخ سفارش:</label></td>
                            <td class="">
                                <b>{{$jalali}}</b>
                            </td>
                            <td><label class="m-0" for="cheque">تاریخ دستی:</label></td>
                            <td class="pr-0">
                                <b>{{$jalali_manual}}</b>
                            </td>
                        </tr>
                        <tr>
                            
                            <td class="px-0"><label class="m-0 " for="image-new">عکس رسید:</label></td>
                            <td class="pr-0">
                                <span class="w-100">@if(empty($order->image))
                                    بدون عکس
                                    @else
                                    <a href="{{ asset('/upload/invoices/'.$order->image)}}" target="_blank"
                                        rel="noopener noreferrer">
                                        <img src="{{ asset('/upload/invoices/'.$order->image)}}" alt="" height="150px">
                                    </a>
                                    @endif
                                </span>
                            </td>
                            <td></td>
                            <td></td>
                           
                        </tr>
                    </tbody>
                </table>
                <hr>
                @if (!empty($order->description))
                <div class="d-block mb-2">    
                    <span>توضیح : </span>
                </div>
                <textarea class="w-100" rows="2" disabled>{{$order->description}}</textarea>
                @else
                <div class="d-block">    
                    <span>توضیح : </span>
                    <span>بدون توضیح</span>
                </div>
                @endif
            </div>
        </div>




        <div class="col-12 mt-4 ">
            <strong class="d-block mb-2">مشتری :</strong>

            <table class="table bg-white border w-100 ">
                <tbody>
                    <tr>
                        <td class="border-0">کد مشتری:</td>
                        <td class="border-0">
                            <b>{{$client->id}}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>نام مشتری:</td>
                        <td>
                            <b>{{$client->name . ' ' . $client->lastname}}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>تلفن مشتری:</td>
                        <td>
                            <b>{{$client->phone}}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>مانده حساب:</td>
                        <td>
                            <b>{!!number_format($client->balance)!!} ریال</b>
                        </td>
                    </tr>
                    <tr>
                        <td>آدرس مشتری:</td>
                        <td>
                            <div class="form-group">
                                <textarea class="form-control" rows="2" disabled="">{{$client->address}}</textarea>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection