@extends('layout.app')
@section('content')

<style>
    #qrcode img {
        display: block;
        margin: auto;
    }
</style>



<form action="{{route('print')}}">
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
                                        <input type="hidden" class="qr_name" name="qr_name">
                                    </td>
                                    <td>
                                        <span class="qr_price"></span>
                                        <input type="hidden" class="qr_price" name="qr_price">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="qr_code"></span>
                                        <input type="hidden" class="qr_code" name="qr_code">
                                    </td>
                                    <td>
                                        <span class="qr_code_system"></span>
                                        <input type="hidden" class="qr_code_system" name="qr_code_system">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-4 p-0">
                            <div id="qrcode" class="pl-5 d-block "></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold d-block mx-auto w-100 text-center">تعداد چاپ : </label>
                        <input type="number" name="count" class=" w-75 mx-auto form-control js-qr-count text-center "
                            placeholder="0">
                    </div>
                </div>
                <div class="modal-footer mx-auto">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                    <button type="submit" class="js-qr-print btn btn-dark">چاپ</button>
                </div>
            </div>
        </div>
    </div>
</form>

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
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/qrcode.min.js')}}"></script>

<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: '0',
        width: 128,
        height: 128,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
           });

        $(document).on('click','.js-modal-qrcode',function(){
            $('.qr_name').html("نام : <br> " + $(this).attr('data-name'));
            $('.qr_price').html("قیمت : <br>" + $(this).attr('data-price'));
            $('.qr_code').html("کد : <br>" + $(this).attr('data-code'));
            $('.qr_code_system').html("سیستم : <br>" + $(this).attr('data-code_system'));

            $('.qr_name').val($(this).attr('data-name'));
            $('.qr_price').val($(this).attr('data-price'));
            $('.qr_code').val($(this).attr('data-code'));
            $('.qr_code_system').val($(this).attr('data-code_system'));


            qrcode.clear();
            qrcode.makeCode($(this).attr('data-code'));
    })
    
</script>



@endsection