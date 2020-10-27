@extends('layout.app')
@section('content')
<script src="{{asset('js/qrcode.min.js')}}"></script>
<style>
    #qrcode img {
        display: block;
        margin: auto;
    }
</style>
<div class="modal fade" id="modal_qrcode" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0 w-100">
                <div class="row  pt-4">
                    <div class="col-8 ">
                        <table class="table d-block mx-auto table-borderless pr-3 text-center ">
                            <tr>
                                <td>
                                    <span class="qr_name"></span>
                                </td>
                                <td>
                                    <span class="qr_price"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="qr_code"></span>
                                </td>
                                <td>
                                    <span class="qr_code_system"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-4 p-0">
                        <div id="qrcode" class="pl-5 d-block "></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer mx-auto">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                <button type="button" class="btn btn-dark">چاپ</button>
            </div>
        </div>
    </div>
</div>


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