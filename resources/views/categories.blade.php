@extends('layout.app')
@section('content')
<div class="modal fade" id="cat_delete_modal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">حذف دسته</h5>
                <button type="button" class="close" data-dismiss="modal" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-right">
                <div class="alert alert-danger" role="alert">
                    آیا از حذف دسته مطمئنید؟<br>
                    <strong>اخطار:</strong> با حذف هر دسته زیر مجموعه ها به دسته مادر تبدیل میشوند
                </div>
            </div>
            <div class="modal-footer ltr">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر</button>
                <button type="button" class="btn btn-danger cat_delete_ok">بله حذف کن</button>
            </div>
        </div>
    </div>
</div>
{{-- end delete modal --}}
<div class="modal fade" id="cat_edit_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ویرایش دسته</h5>
                <button type="button" class="close position-absolute" data-dismiss="modal" style="left:0;top:20px"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="category_edit_form" method="post" >
                <div class="modal-body">
                    <input type="hidden" id="category_hidden_id" name="category_hidden_id">
                    <table class="table ">
                        <tr>
                            <td class="border-0"><span class="pt-2 d-block">نام دسته</span></td>
                            <td class="border-0">
                                <div class="form-group">
                                    <input type="text" name="category_name" id="category_name" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="pt-2 d-block">دسته مادر</span></td>
                            <td>
                                <select name="parent_edit" class="custom-select " id="category_parrent">
                                    <option value="0">بدون مادر</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer ltr">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>
                    <input type="submit" class="btn btn-dark" value="ویرایش">
                </div>
            </form>
        </div>
    </div>
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
    <div class="card pt-2 px-4 mb-2">
        <span class="h4  text-right d-block ">مدیریت دسته ها</span>
    </div>
    <div class="row">
        <div class="col-4 pl-1">
            <div class="card p-4">
            <form action="{{route('categories.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="text-right d-block">نام دسته</label>
                        <input type="text" class="form-control" name="name" id="" required>
                    </div>
                    <label class="text-right d-block">دسته مادر </label>
                    <select name="parent" class="custom-select">
                        <option selected value="0">بدون مادر</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-dark mt-3 btn-block">ساخت
                        دسته</button>
                </form>
            </div>
        </div>
        <div class="col-8 pr-1">
            <div class="card p-4" dir="rtl">
                <div class="table-responsive">
                    {{-- tootablet nabayad responsivebashe --}}
                    <table class="table table-bordered table-hover text-center" id="table_category">
                        <thead>
                            <th>نام دسته</th>
                            <th>دسته مادر</th>
                            <th>عملیات</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
