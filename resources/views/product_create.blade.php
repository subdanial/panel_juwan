@extends('layout.app')
@section('content')
<div class="container-fluid mt-4">
    
    @include('layout.message')
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success text-right" style="display:none" role="alert">
                محصول جدید اضافه شد.
             </div>
        </div>
            
    </div>

    <div class="row">
                <div class="col">
                    <div class="product_alert  text-right alert alert-success d-none" role="alert">
                       محصول جدید با موفقیت افزوده شد
                    </div>
                </div>
    </div>
    <div class="card pt-2 px-4 mb-2">
        <span class="h4  text-right d-block"> افزودن محصول جدید</span>
    </div>
    <form id="product_add_form" method="POST">
        <div class="row">
            <div class="col-7 pl-2">
                <div class="card p-4">
                    <h4 class="text-right">مشخصات</h4>
                    @csrf
                    <table class="table w-100 text-right">
                        <tr>
                            <td>
                                <span>کد</span>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" class="form-control js-code-new" name="code" id="" >
                                    <small class="text-danger js-code-exist" style="display: none">کد کالا موجود است</small>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>کد سیستمی</span>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" class="form-control " name="code_system"  >
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>نام</span>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id="" >
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>نام سیستمی</span>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name_system" id="" >
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>قیمت</span>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="price" id=""  >
                                </div>
                            </td>
                        </tr>
                        <tr class=" @if(auth()->user()->role == 2) d-none @endif"">
                            <td>
                                <span>قیمت اصلی</span>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="price_financial" id="" value="0" >
                                    <small id="helpId" class="text-muted">در صورت 0 بودن این فیلد قیمت اصلی برابر با قیمت عادی میشود</small>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card p-4 mt-2">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <h4 class="d-block mb-0 size_check">سایز ها</h4>
                        <div class="dropup">
                            <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-toggle="dropdown">
                                سایز های پیشفرض
                            </button>
                            <div class="dropdown-menu">
                                <div class="w-100 text-center d-flex justify-item-between flex-wrap">
                                    <div class="w-50 p-1"><button type="button"
                                            class="btn size_add btn-outline-dark w-100 " data-content="XS">XS</button>
                                    </div>
                                    <div class="w-50 p-1"><button type="button"
                                            class="btn size_add btn-outline-dark w-100 " data-content="S">S</button>
                                    </div>
                                    <div class="w-50 p-1"><button type="button"
                                            class="btn size_add btn-outline-dark w-100 " data-content="M">M</button>
                                    </div>
                                    <div class="w-50 p-1"><button type="button"
                                            class="btn size_add btn-outline-dark w-100 " data-content="L">L</button>
                                    </div>
                                    <div class="w-50 p-1"><button type="button"
                                            class="btn size_add btn-outline-dark w-100 " data-content="XL">XL</button>
                                    </div>
                                    <div class="w-50 p-1"><button type="button"
                                            class="btn size_add btn-outline-dark w-100 " data-content="XXL">XXL</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-dark size_add" data-content="">افزودن سایز +</button>
                        </div>
                    </div>
                    <div class="sizes_board">
                    </div>
                </div>
                {{-- end size card --}}
                <div class="card p-4 mt-2">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <h4 class="color_check">رنگ ها</h4>
                        <div class="dropup">
                            <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-toggle="dropdown">
                                رنگ های پیش فرض
                            </button>
                            <div class="dropdown-menu">
                                <div class="w-100 text-center d-flex justify-content-center flex-wrap">
                                    <div class="w-30 p-1"><button type="button"
                                            class="btn color_add btn-outline-dark w-100 "
                                            data-content="مشکی">مشکی</button>
                                    </div>
                                    <div class="w-30 p-1"><button type="button"
                                            class="btn color_add btn-outline-dark w-100 "
                                            data-content="سفید">سفید</button>
                                    </div>
                                    <div class="w-30 p-1"><button type="button"
                                            class="btn color_add btn-outline-dark w-100 "
                                            data-content="قرمز">قرمز</button>
                                    </div>
                                    <div class="w-30 p-1"><button type="button"
                                            class="btn color_add btn-outline-dark w-100 "
                                            data-content="آبی">آبی</button>
                                    </div>
                                    <div class="w-30 p-1"><button type="button"
                                            class="btn color_add btn-outline-dark w-100 "
                                            data-content="سبز">سبز</button>
                                    </div>
                                    <div class="w-30 p-1"><button type="button"
                                            class="btn color_add btn-outline-dark w-100 "
                                            data-content="زرد">زرد</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-dark btn-sm color_add" data-content="">افزودن رنگ +</button>
                        </div>
                    </div>
                    <div class="color_board">
                    </div>
                </div>
                {{-- end color card --}}
                <div class="card p-4 mt-2">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <h4 class="box_check">بسته ها</h4>
                        <div class="dropup">
                            <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-toggle="dropdown">
                                بسته های پیش فرض
                            </button>
                            <div class="dropdown-menu">
                                <div class="w-100 text-center d-flex justify-content-center flex-wrap">
                                    <div class="w-50 p-1"><button type="button"
                                            class="btn box_add btn-outline-dark w-100 " data-content="1">تکی</button>
                                    </div>
                                    <div class="w-50 p-1"><button type="button"
                                            class="btn box_add btn-outline-dark w-100 " data-content="3">3 تایی</button>
                                    </div>
                                    <div class="w-50 p-1"><button type="button"
                                            class="btn box_add btn-outline-dark w-100 " data-content="4">4 تایی</button>
                                    </div>
                                    <div class="w-50 p-1"><button type="button"
                                            class="btn box_add btn-outline-dark w-100 " data-content="5">5 تایی</button>
                                    </div>
                                    <div class="w-50 p-1"><button type="button"
                                            class="btn box_add btn-outline-dark w-100 " data-content="6">6 تایی</button>
                                    </div>
                                    <div class="w-50 p-1"><button type="button"
                                            class="btn box_add btn-outline-dark w-100 " data-content="10">10
                                            تایی</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-dark btn-sm box_add" data-content="">افزودن بسته +</button>
                        </div>
                    </div>
                    <div class="box_board">
                    </div>
                </div>
                {{-- end box card --}}
                <div class="card p-4 mt-2">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <h4>موجودی</h4>
                        <div>
                            <button type="button" class="btn btn-dark items_submit">ثبت</button>
                        </div>
                    </div>
                    <div class="items_board">
                        <div class="alert alert-success text-right color_empty_alert" role="alert">
                            لطفا حداقل یک <strong>رنگ</strong> و یک <strong>بسته</strong> انتخاب کنید
                        </div>
                        <ul class="nav nav-tabs pr-0 items_tab">
                        </ul>
                        <div class="items_tab_content tab-content">
                        </div>
                        {{-- end item card --}}
                    </div>
                </div>
            </div>
            {{-- end right col --}}
            <div class="col-5 pr-2 ">
                <div class="card p-4 mb-2">
                    <button type="submit" class="btn_submit btn btn-block btn-dark">ثبت نهایی</button>
                </div>
                <div class="card p-4">
                    <h4 class="mb-2 text-right d-block border-bottom pb-2">تصویر</h4>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group">
                                <span class="btn btn-dark btn-block mb-2 btn-file">
                                    انتخاب عکس <input type="file" class="custom-file-input" name="picture" id="picture" >
                                </span>
                            </span>
                            <input type="text" class="form-control w-100" value="نام عکس آپلود شده" readonly>
                        </div>
                        <img id='img-upload' />
                    <div id="uploaded_image" class="w-100 d-block text-right mt-2"></div>
                    </div>
                </div>
            {{-- end picture --}}
                <div class="card p-4 mt-2">
                    <h4 class="text-right border-bottom pb-2">دسته</h4>
                    <ul class="tree">
                        @foreach($categories as $category)
                        <li>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="category_id"
                                        value="{{ $category->id }}">
                                    <span>{{ $category->name }}</span>
                                </label>
                            </div>
                            @if ( $category->children->isNotEmpty() )
                            @include('layout.category-children',['children' => $category->children])
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{-- end category --}}
    </form>
    @endsection

    @section('product_create_js')



    
    <script>
    

//form_is_valid
var form_is_valid = false;
var input_is_valid = false;
var color_is_valid = false;
var color_is_valid = false;
var size_is_valid = false;
var size_is_valid = false;
var box_is_valid = false;
var box_is_valid = false;
var item_is_valid = false;

// product default


var product = {};
product.image = 'default/product.png';

$(document).on('change', '#picture', function () {
    uploadImage();
})

//uniqeArray
function getUnique(array) {
    var uniqueArray = [];
    // Loop through array values
    for (i = 0; i < array.length; i++) {
        if (uniqueArray.indexOf(array[i]) === -1) {
            uniqueArray.push(array[i]);
        }
    }
    return uniqueArray;
}

//size
var sizes = [];
var size_row_id = 0;
var size_value
$('.size_add').click(function () {
    size_value = $(this).attr('data-content');
    size_row_id++;
    size_row =
        `<div class="d-flex mb-2 justify-content-between align-items-center size_row" id="` + size_row_id + `" >
            <input type="text" class="form-control w-100 mr-2 size_input" name="sizes[]" placeholder="سایز" id="` +
        size_row_id + `" value="` + size_value + `">
            <div><button type="button" class="size_remove btn btn-outline-dark" id="` + size_row_id + `">&times</button></div>
            </div>`;
    $('.sizes_board').append($(size_row));
});
$(document).on('click', '.size_remove', function () {
    $('.size_row#' + $(this).attr('id')).remove();
});
//color
var colors = [];
var color_row_id = 0;
var color_value;

$('.color_add').click(function () {
    color_value = $(this).attr('data-content');
    color_row_id++;
    color_row =
        `<div class="d-flex mb-2 justify-content-between align-items-center color_row" id="i` +
        color_row_id + `" >
            <input  data-sql-id="-1" type="text" class="form-control w-100 mr-2 color_input" name="colors[]" placeholder="رنگ" id="` +
        color_row_id + `" value="` + color_value + `">
            <div><button type="button" class="color_remove btn btn-outline-dark" id="i` + color_row_id + `">&times</button></div>
            </div>`;
    $('.color_board').append($(color_row));
})
$(document).on('click', '.color_remove', function () {
    $('.color_row#' + $(this).attr('id')).remove();
});
//box
var boxs = [];
var box_row_id = 0;
var box_value
$('.box_add').click(function () {
    box_value = $(this).attr('data-content');
    box_row_id++;
    box_row =
        `<div class="d-flex mb-2 justify-content-between align-items-center box_row" id="b` + box_row_id + `" >
        <input type="number" class="form-control w-100 mr-2 box_input" name="boxs[]" placeholder="بسته" id="` +
        box_row_id + `" value="` + box_value + `">
        <div><button type="button" class="box_remove btn btn-outline-dark" id="b` + box_row_id + `">&times</button></div>
        </div>`;
    $('.box_board').append($(box_row));
});
$('.box_board').on('click', '.box_remove', function () {
    $('.box_row#' + $(this).attr('id')).remove();
});
//--//array_generators//-//
$(document).on('click change keydown keyup keypress focus blur',
    '.size_add , .size_input , .size_remove , .color_add , .color_input , .color_remove , .box_add , .box_input , .box_remove , .items_submit',
    function () {
        sizes = [];
        $(".size_input").each(function () {
            if (/\S/.test($(this).val()))
                sizes.push($(this).val());
        });
        sizes = getUnique(sizes);
        boxs = [];
        $(".box_input").each(function () {
            if (/\S/.test($(this).val()))
                boxs.push($(this).val());
        });
        boxs = getUnique(boxs);
        colors = [];
        $(".color_input").each(function () {
            if (/\S/.test($(this).val()))
                colors.push($(this).val());
        });
        colors = getUnique(colors);
    })

$('.items_submit').click(function () {
    //alert-hide
    if (!$.isEmptyObject(colors) && !$.isEmptyObject(boxs))
        $('.color_empty_alert').hide();
    else
        $('.color_empty_alert').show();

    //items
    var i = 0;
    var b = 0;
    $('.items_tab').empty();
    $('.items_tab_content').empty();
    $.each(colors, function () {
        if (i == 0)
            var active = 'active';
        var item_row = `<li class="nav-item item_row" id=` + i +
            `><a class="nav-link item_link " data-toggle="tab" href="#m` + i + `" data-color="` +
            colors[i] + `">` + colors[i] + `</a></li>`;
        $('.items_tab').append(item_row);
        var items_tab_pane = `
            <div id="m` + i + `" class="items_tab_pane tab-pane" data-color="` + colors[i] + `">
            </div>
            `;
        $('.items_tab_content').append(items_tab_pane);
        i++;
    });
    $.each(boxs, function () {
        var box_item_row = `
            <div class="row box_item_row mt-2" id="` + b + `">
                <div class="col-2"><span class=" d-block pt-2"> بسته ` + boxs[b] + ` تایی </span> </div>
                <div class="col-10">
                    <div class="form-group">
                        <input name="boxs[1]" type="number" class="form-control item_value" id="v` + b +
            `" data-name="` + boxs[b] + `">
                    </div>
                </div>
            </div>`;
        $('.items_tab_pane').append(box_item_row);
        b++
    });
    //tabs
    $(".item_link").first().click(); //select a tab!
    $('.items_tab_pane').each(function () {
        $(this).find(".item_value").attr('data-color', $(this).attr('data-color'));
    });
});



$("#product_add_form").on('submit', function (e) {
    e.preventDefault();
    //colors_objects
    var color_objects = [];
    $.each(colors, function (index, value) {
        color_objects.push({
            name: value
        });
    });
    //boxs_objects
    var box_objects = [];
    $('.item_value').each(function () {
        box_objects.push({
            color: $(this).attr('data-color'),
            name: $(this).attr('data-name'),
            value: $(this).val()
        })
    })
    //---Reqire Validator Test---//
    $(document).find('input').each(function () {
        if ($(this).val() == "" && $(this).attr('type') !== 'file') {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
    if (!colors || colors.length == 0) {
        $('.color_check').addClass('text-danger');
        color_is_valid = false;
    } else {
        $('.color_check').removeClass('text-danger');
        color_is_valid = true;
    }
    if (!sizes || sizes.length == 0) {
        $('.size_check').addClass('text-danger');
        size_is_valid = false;
    } else {
        $('.size_check').removeClass('text-danger');
        size_is_valid = true;
    }
    if (!boxs || boxs.length == 0) {
        $('.box_check').addClass('text-danger');
        box_is_valid = false;
    } else {
        $('.box_check').removeClass('text-danger');
        box_is_valid = true;
    }
    if ($(document).find($('.is-invalid')[0]).length == 0) {
        input_is_valid = true;
    } else {
        input_is_valid = false;
    }
    if ($(document).find($('.item_value')[0]).length !== 0) {
        item_is_valid = true;
    } else {
        item_is_valid = false;
    }
    product.category_id = $("input[name='category_id']:checked").val();
    product.code = $("input[name='code']").val();
    product.code_system = $("input[name='code_system']").val();
    
    product.name = $("input[name='name']").val();
    product.name_system = $("input[name='name_system']").val();
    product.price = $("input[name='price']").val();
    product.price_financial = $("input[name='price_financial']").val();
    product.sizes = sizes;
    product.colors = color_objects;
    product.boxes = box_objects;


    if (item_is_valid && input_is_valid && color_is_valid && size_is_valid && box_is_valid ) {
        console.log(product);
        $.ajax({
            type: "POST",
            url: "/products/store",
            data: product,
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('.alert-success').show();

                setTimeout(
                    function () {
                        location.reload(true);
                    }, 1500);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        })
    } else {
        alert('فیلد هارا بررسی کنید');
    }
});




    $(document).ready(function () {
        $('.form-check-input').first().prop("checked", true);
    });

    </script>
    @endsection
    