@extends('layout.app')
@section('content')



{{-- modal-delete --}}
<div class="modal fade" id="marketer-modal-delete" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">حذف مشتری</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <form action="/marketers/destroy">
                <input type="hidden" name="hidden_delete_id" class="hidden_delete_id">
                <div class="modal-body">
                    آیا از حذف این فروشنده مطمئنید
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
<div class="modal fade" id="marketer-modal" tabindex="-1">
    <form class="marketer-modal-form" method="post" action="">
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
                    <input type="hidden" name="marketer_hidden_id" id="marketer_hidden_id">
                    <div class="delete-hidden">
                        <div class="form-row mt-2">
                            <div class="col-3">
                                <label class="d-block pt-2">نام</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-3">
                                <label class="d-block pt-2"> نام خانوادگی</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="lastname" id="lastname" class="form-control">
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-3">
                                <label class="d-block pt-2">تماس</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-3">
                                <label class="d-block pt-2">نام کاربری</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                        </div>
                        <div class="edit-show">
                            <hr>
                            <small class="text-center text-secondary w-100 d-block"> اگر قصد ندارید رمز عبور فروشنده
                                تغییر کند فیلد های پسورد را خالی بگذارید</small>
                            <hr>
                        </div>

                        <div class="form-row mt-2">
                            <div class="col-3">
                                <label class="d-block pt-2">رمز عبور</label>
                            </div>
                            <div class="col-9">
                                <input type="password" name="password" id="password" class="form-control ">
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-3">
                                <label class="d-block pt-2">تکرار رمز عبور</label>
                            </div>
                            <div class="col-9">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
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
                        <button type="button" class="btn btn-modal-marketer-close btn-secondary"
                            data-dismiss="modal">لغو</button>
                        <button type="submit" class="btn btn-modal-marketer-action btn-dark">ثبت</button>
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
                    <div><span class="h4 d-block m-0">فروشنده ها</span></div>
                    <div><button type="button" class="btn btn-dark btn-marketer-modal" data-action="add"
                            data-modal="marketers_modal_table"><i class="fa fa-plus mr-2"></i> افزودن فروشنده</button>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table text-center table-hover w-100 " id="table_marketer">
                        <thead>
                            <th>کد</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>نام کاربری</th>
                            <th>تماس</th>
                            <th>عملیات</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
