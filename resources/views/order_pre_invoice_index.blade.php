@extends('layout.app')
@section('content')
<div class="container-fluid mt-4">

    @isset($open_cart_count)
        @if ($open_cart_count != 0)
        <div class="alert alert-warning non-fade" role="alert">
            <strong>شما سبد فعال دارید </strong> <br>
            با ویرایش پیش فاکتور سبد فعال فعلی شما تبدیل به سبد موقت میشود
        </div>
        @endif
    @endisset

    
    <div class="card p-4">
    
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" id="table_pre_invoice">
                <thead>
                    <th>کد</th>
                    <th>مشتری</th>
                    <th>فروشنده</th>
                    <th>مبلغ</th>
                    <th>تاریخ</th>
                    <th>عملیات</th>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
