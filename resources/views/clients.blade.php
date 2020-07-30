@extends('layout.app')
@section('content')
{{-- modal-delete --}}
<div class="modal fade" id="client-modal-delete" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">حذف مشتری</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>

            <form action="/clients/destroy">
                <input type="hidden" name="hidden_delete_id" class="hidden_delete_id">
                <div class="modal-body">
                    آیا از حذف این مشتری مطمئنید
                </div>
                <div class="modal-footer">
                    <div class="float-right w-100">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر</button>
                        <button type="submit" class="btn btn-danger">بله حذف شود</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
{{-- modal-edit-add --}}
<div class="modal fade" id="client-modal" tabindex="-1">
    <form class="client-modal-form" method="post" action="">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="role" id="role" value="3">
                    <input type="hidden" name="client_hidden_id" id="client_hidden_id">
                    <div class="delete-hidden">

                        <div class="form-row mt-2">
                            <div class="col-3">
                                <label class="d-block pt-2">نام <small><i class="fas fa-asterisk"></i></small></label>
                            </div>
                            <div class="col-9">
                                <input type="text"  name="name" id="name" class="form-control">
                            </div>
                        </div>

                        <div class="form-row mt-2">
                            <div class="col-3">
                                <label class="d-block pt-2"> نام خانوادگی <small><i class="fas fa-asterisk"></i></small></label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="lastname" id="lastname" class="form-control">
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-3">
                                <label class="d-block pt-2">تماس <small><i class="fas fa-asterisk"></i></small></label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-3">
                                <label class="d-block pt-2">شهر</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="city" id="city" class="form-control">
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-3">
                                <label class="d-block pt-2">آدرس</label>
                            </div>
                            <div class="col-9">
                                <textarea name="address" id="address" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-3">
                                <label class="d-block pt-2">مانده <small><i class="fas fa-asterisk"></i></small></label>
                            </div>
                            <div class="col-9">
                                <input type="number" name="balance" id="balance" class="form-control" value="0">
                            </div>
                        </div>
            
                    </div>
                    <p class="delete-show" style="display:none;">
                        آیا از حذف این مشتری مطمئنید؟
                    </p>
                    <input type="hidden" name="hidden_delete_id" class="hidden_delete_id">
                </div>
                <div class="modal-footer">
                    <div class="float-right w-100">
                        <button type="button" class="btn btn-modal-client-close btn-secondary"
                            data-dismiss="modal">لغو</button>
                        <button type="submit" class="btn btn-modal-client-action btn-dark">ثبت</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="container-fluid mt-4">
    @include('layout.message')
    <div class="row">
        @if(Session::has('msg'))
        <div class="col">
            <div class="alert alert-success text-right" role="alert">
                {{Session::get('msg')}}
            </div>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-4 border rounded-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div><span class="h4 d-block m-0">مشتری ها</span></div>
                    <div><button type="button" class="btn btn-dark btn-client-modal" data-action="add"
                            data-modal="clients_modal_table"><i class="fa fa-plus mr-2"></i> افزودن مشتری</button>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    
                    @if (auth()->user()->role == 2 || auth()->user()->role == 1)
                    <table class="table text-center table-hover w-100 " id="table_client">
                        <thead>
                            <th>کد</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>سازنده</th>
                            <th>تماس</th>
                            <th>شهر</th>
                            {{-- <th>آدرس</th> --}}
                            <th>مانده</th>
                            <th>عملیات</th>
                        </thead>
                    </table>
                    @endif
                    @if (auth()->user()->role == 3)
                    <table class="table text-center table-hover w-100 " id="table_client_marketer">
                        <thead>
                            <th>کد</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>تماس</th>
                            <th>شهر</th>
                            <th>مانده</th>
                            <th>عملیات</th>
                        </thead>
                    </table>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
