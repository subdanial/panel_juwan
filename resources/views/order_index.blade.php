@extends('layout.app')
@section('content')
<style>
    /* td{
    white-space:nowrap;
    } */
</style>
<div class="container-fluid mt-4">
    <div class="card p-4">
        <div class="table-responsive">
            @if (auth()->user()->role == 1)
            <table class="table table-bordered table-hover text-center" id="table_order">
                <thead>
                    <th  style="white-space:nowrap" >کد</th>
                    <th  style="white-space:nowrap" >نوع</th>
                    <th  style="white-space:nowrap" >مشتری</th>
                    <th  style="white-space:nowrap" >فروشنده</th>
                    <th  style="white-space:nowrap" class="bg-light">پرداخت</th>
                    <th  style="white-space:nowrap" class="bg-light">مبلغ</th>
                    <th  style="white-space:nowrap" class="bg-light">تمام شده</th>
                    <th  style="white-space:nowrap" class="bg-light">مبلغ مرجوعی</th>
                    <th  style="white-space:nowrap" class="bg-light">تخفیف</th>
                    <th  style="white-space:nowrap" class="bg-light">کارت</th>
                    <th  style="white-space:nowrap" class="bg-light">چک</th>
                    <th  style="white-space:nowrap" class="bg-light">نقد</th>
                    <th  style="white-space:nowrap" >تاریخ</th>
                    <th  style="white-space:nowrap" >تاریخ دستی</th>
                    <th  style="white-space:nowrap" >مالی</th>
                    <th  style="white-space:nowrap" >انبار</th>
                    <th  style="white-space:nowrap" >فروش</th>
                    <th  style="white-space:nowrap" >عملیات</th>
                </thead>
            </table>
            @endif
            @if (auth()->user()->role == 2)
            <table class="table table-bordered table-hover text-center" id="table_order_anbaar">
                <thead>
                    <th>کد</th>
                    <th>نوع</th>
                    <th>مشتری</th>
                    <th>فروشنده</th>
                    {{-- <th>تاریخ</th> --}}
                    <th>مالی</th>
                    <th>انبار</th>
                    <th>فروش</th>
                    <th>عملیات</th>
                </thead>
            </table>
            @endif
            @if (auth()->user()->role == 3)
            <table class="table table-bordered table-hover text-center" id="table_order_foroosh">
                <thead>
                    <th>کد</th>
                    <th>نوع</th>
                    <th>پرداخت</th>
                    <th>مشتری</th>
                    <th>زمان</th>
                    <th>مالی</th>
                    <th>انبار</th>
                    <th>فروش</th>
                    <th>عملیات</th>
                </thead>
            </table>
            @endif
        </div>
    </div>
</div>

@endsection
