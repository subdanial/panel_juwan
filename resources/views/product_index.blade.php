@extends('layout.app')
@section('content')
<div class="container-fluid mt-4">
    <div class="card p-4">
        
        @if(auth()->user()->role==1)
        <table id="table-products" class="w-100 table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th>کد</th>
                    <th>عنوان</th>
                    <th>دسته</th>
                    <th>قیمت</th>
                    <th>قیمت تمام شده</th>
                    <th>سایز</th>
                    <th>رنگ</th>
                    <th>تاریخ</th>
                    <th>عملیات</th>
                </tr>
            </thead>
        </table>
        @endif

        @if(auth()->user()->role==2)
        <table id="table-products-anbaar" class="w-100 table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th>کد</th>
                    <th>عنوان</th>
                    <th>دسته</th>
                    <th>قیمت</th>
                    <th>رنگ</th>
                    <th>سایز</th>
                    <th>تاریخ</th>
                    <th>عملیات</th>
                </tr>
            </thead>
        </table>
        @endif


    </div>



</div>
    @endsection