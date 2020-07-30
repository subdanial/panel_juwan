@extends('layout.app')
@section('content')
<div class="container-fluid mt-4">
    <div class="card p-4">
        <div class="alert alert-danger non-fade" role="alert">
            <h1>سفارشات تایید نشده شما بیشتر از پنج عدد است</h1>
            <p>
                برای ثبت سفارش جدید دریافت سفارشات از انبار را تایید کنید
                <br>
                برای اینکار به سفارشات رفته و از عملیات روی <i class="fa fa-check" ></i>
                کلیک کنید
            </p>
        </div>
    </div>
</div>
@endsection
