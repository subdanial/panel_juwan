@extends('layout.app')
@section('content')
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
    <div class="row">
        <div class="col-12">
            <div class="card px-4  mb-1">
                <div class="d-flex justify-content-between  pt-2 pb-2">
                    <span class="h4 d-block m-0">
                        افزودن محصول به سبد
                    </span>
                    <div>
                        <a href="{{route('orders.cart')}}" class="d-block btn btn-sm btn-dark pt-1"> مشاهده سبد <i class="fa fa-eye align-middle mr-1" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-8 pl-0">
            <div class="card p-4 mb-2">
                <table id="table-products-order" class="w-100 table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>کد</th>
                            <th>عنوان</th>
                            <th>تصویر</th>
                            <th>دسته</th>
                            {{-- <th>قیمت</th> --}}
                            {{-- <th>سایز</th> --}}
                            {{-- <th>رنگ</th> --}}
                            <th>عملیات</th>
                        </tr>
                    </thead>
       
                </table>
            </div>
        </div>
        <div class="col-4 pr-1">
            <form action="{{route('orders.store')}}" class="order_store">
                <div class="card p-4 mb-2">
                    <div class="form-group">
                        <label for="client_name">مشتری : </label>
                        @if(isset($client))
                        <input type="text" value="{{$client->name}} {{$client->lastname}} " autocomplete="off"
                            class="form-control client_name" name="client_name" disabled>
                        <div id="clientList"></div>
                        {{csrf_field()}}
                        <input type="hidden" class="client_id" name="client_id" value="{{$client->id}}">
                        @else
                        <input type="text" autocomplete="off" class="form-control client_name" name="client_name"
                            placeholder="جستجو نام مشتری" required>
                        <div id="clientList"></div>
                        {{csrf_field()}}
                        <input type="hidden" class="client_id" name="client_id" value="">
                        @endif
                    </div>
                </div>
                <div class="card p-4 mb-2">
                    <label for="product_code">کد کالا</label>
                    <div class="d-flex mb-2">
                        <input type="number" name="code" class="form-control"
                            value="@isset($item){{$item->product_code}}@endisset" id="product_code" required>
                        <button type="submit" class="select_color btn btn-dark">انتخاب</button><br>
                    </div>
                    <hr>
                    <label for="">رنگ و تعداد سفارش</label>
                    <select class="colors custom-select w-100 mb-2">
                        <option value="-1">انتخاب نشده</option>
                    </select>
                    <div class="boxes d-block w-100">
                    </div>
                    <button type="submit" class="btn order_create_submit btn-dark mt-3">ثبت</button>
                </div>
                <div class="card p-4 mb-2">
                    <label for="">تصویر کالای انتخاب شده</label>
                    <img class="procut_image  d-block w-100 mb-3" src="" alt="" width="">
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
