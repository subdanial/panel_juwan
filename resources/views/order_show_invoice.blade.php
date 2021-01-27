@extends('layout.app')
@section('content')
<style>
    .bg-light {
        background-color: white !important;
    }

    .navbar.navbar-expand.navbar-dark.bg-dark {
        /* display: none; */
    }
</style>




<?php
$the_array = $order->items->toArray();   
$temp_array = [];
foreach ($the_array as $init) {
$temp_array[$init['product_code']][] = $init;
}
$result = [];
foreach ($temp_array as $product_code => $arr) {
$result[] = [
    'product_code' => $product_code,
    'product_name' => array_column($arr, 'product_name')[0],
    'product_price' => array_column($arr, 'product_price')[0],
    'count_total' => array_sum(array_column($arr, 'count_total')),
    'product_price_total' => array_sum(array_column($arr, 'product_price_total')),
    'product_color' => implode(',',array_unique(array_column($arr, 'product_color')))

];
}
?>



<div class="container border mt-5 p-4">
    <div class="row">
        <span class="col h5 d-block" id="invoice_id">شماره فاکتور : {{$order->id}}</span>
        @if($order->returned == 0)
        <span class="col h5 mx-auto text-center d-block" id="invoice_title">ژوان | فاکتور فروش</span>
        @else
        <span class="col h5 mx-auto text-center d-block" id="invoice_title">فاکتور مرجوعی | ژوان</span>
        @endif
        <span class="col h5 text-left" id="invoice_date">تاریخ : {{$jalali_manual}}</span>
        
    </div>
    <hr>
    <div id="client_information" class="pb-3">
        <strong id="client_information_title" class="d-block">اطلاعات مشتری </strong>
        <div class="d-flex justify-content-between pt-2">
            <span id="client_name" class="d-block">نام : {{$client->name}} {{$client->lastname}}</span>
            {{-- <span id="client_id" class="d-block">کد : {{$client->id}}</span> --}}
            <span id="client_phone" class="d-block">تماس :{{$client->phone}}</span>
            <span id="client_city" class="ml-5">شهر :{{$client->city}}</span>
            <span id="noe_kharid"> نوع خرید:{{$order->noe_kharid}}</span>

        </div>
        <div class="d-flex  justify-content-between  pt-2">
            <span id="client_address"> آدرس:{{$client->address}}</span>
            <span id="hidden"></span>
            <span id="hidden"></span>
        </div>

    </div>
    <div class="table-responsive">
        <table class="table table-striped bg-white">
            <thead>
                <tr>
                    <th>#</th>
                    <th>کد</th>
                    <th>عنوان</th>
                    <th>رنگ</th>
                    <th>تعداد</th>
                    <th>فی</th>
                    <th>قیمت</th>
                </tr>
            </thead>
            <tbody>
                @foreach($result as  $index =>  $item)
                <tr>
                    <td>{{  $index + 1}}</td>
                    <td>{{ $item['product_code'] }}</td>
                    <td>{{ $item['product_name'] }}</td>
                    <td>{{ $item['product_color'] }}</td>
                    <td>{{ $item['count_total'] }}</td>
                    <td>{{ $item['product_price'] }}</td>
                    <td>{{ $item['product_price_total'] }}</td>
                 
                </tr>
                @endforeach
            </tbody>
            @if($order->returned == 0)
            <tfoot>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>مجموع:</td>
                <td>
                    <h4 class="m-0 font-weight-bold">
                        {{ number_format( $order->items()->sum('product_price_total') ) }}
                        ریال</h4>
                </td>
            </tfoot>

        </table>
        <label class="d-block">توضیحات:</label>
        <td class=""><textarea class="w-100" rows="2" disabled>{{$order->description}}</textarea></td>
        @endif
        @if($order->returned == 1 )
        <div class=" pt-5">

            <table class="table w-100 m-0">
                <tbody>


                    <tr>
                        <td class="px-0"><label class="m-0">مجموع سفارش:</label></td>
                        <td class="">
                            <b>{!!number_format($order->amount)!!}</b>
                        </td>
                        <td><label class="m-0" for="discount">مبلغ مرجوعی:</label></td>
                        <td class="pr-0">
                            <b>{!!number_format($order->amount_returned)!!}</b>
                        </td>

            </table>

            <label class="d-block">توضیحات:</label>
            <td class=""><textarea class="w-100" rows="2" disabled>{{$order->description}}</textarea></td>
        </div>
        @endif



    </div>
</div>

@endsection