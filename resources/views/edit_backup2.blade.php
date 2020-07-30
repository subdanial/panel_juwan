@extends('layout.app')
@section('content')
<div class="container-fluid mt-4">
    @include('layout.message')
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success text-right" style="display:none" role="alert">
                محصول ویرایش شد
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="product_alert  text-right alert alert-success d-none" role="alert">
                محصول ویرایش شد
            </div>
        </div>
    </div>
    <div class="card pt-2 px-4 mb-2">
        <span class="h4  text-right d-block"> ویرایش محصول : {{$product->name}}</span>
    </div>
    <form id="product_update_form" method="POST">
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
                                    <input type="number" class="form-control" name="code" id=""
                                        value="{{$product->code}}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>نام</span>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id=""
                                        value="{{$product->name}}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>قیمت</span>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="price" id=""
                                        value="{{$product->price}}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>قیمت اصلی</span>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="price_financial" id=""
                                        value="{{$product->price_financial}}">
                                    <small id="helpId" class="text-muted">در صورت 0 بودن این فیلد قیمت اصلی برابر با
                                        قیمت عادی میشود</small>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card p-4 mt-2">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <h4 class="d-block mb-0 size_check">سایز ها</h4>
                        <div class="dropup">
                            <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle"
                                data-toggle="dropdown">
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
                            <button type="button" class="btn btn-dark btn-sm size_add" data-content="">افزودن سایز
                                +</button>
                        </div>
                    </div>
                    <div class="sizes_board">
                        @foreach (json_decode($product->sizes) as $size)
                        <div class="d-flex mb-2 justify-content-between align-items-center size_row"
                            id="s{{$loop->iteration}}">
                            <input type="text" class="form-control w-100 mr-2 size_input" name="sizes[{{$size}}]"
                                placeholder="سایز" id="s{{$loop->iteration}}" value="{{$size}}">
                            <div><button type="button" class="size_remove btn btn-outline-dark"
                                    id="s{{$loop->iteration}}">&times</button></div>
                        </div>
                        @endforeach
                    </div>
                </div>
                {{-- end size card --}}
                <div class="card p-4 mt-2">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <h4 class="color_check">رنگ ها</h4>
                        <div class="dropup">
                            <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle"
                                data-toggle="dropdown">
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
                            <button type="button" class="btn btn-sm btn-dark color_add" data-content="">افزودن رنگ
                                +</button>
                        </div>
                    </div>
                    <div class="color_board">
                        @foreach ($product->colors as $color)
                        <div class="d-flex mb-2 justify-content-between align-items-center color_row"
                            id="c{{$color->id}}">
                            <input type="text" class="form-control w-100 mr-2 color_input color_input_sql"
                                name="colors[{{$color->name}}]" placeholder="رنگ" id="color_row_id"
                                value="{{$color->name}}" data-sql-color={{$color->name}} data-sql-id={{$color->id}}>
                            <span class="w-60 btn btn-light border border-black" data-toggle="dropup"
                                title="درصورت حذف این رنگ بسته و موجودی آن حذف میشود">متصل به بسته</span>
                            <div>
                                <button data-sql-id={{$color->id}} data-sql-color={{$color->name}} type="button"
                                    class="color_remove btn btn-outline-danger" id="c{{$color->id}}">&times</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                {{-- end color card --}}
                <div class="card p-4 mt-2">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <h4 class="box_check">بسته ها</h4>
                        <div class="dropup">
                            <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle"
                                data-toggle="dropdown">
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
                            <button type="button" class="btn btn-sm btn-dark box_add" data-content="">افزودن بسته
                                +</button>
                        </div>
                    </div>
                    <div class="box_board">
                        <?php
                        $box_names = [];
                        foreach($product->boxes as $box){
                            array_push($box_names,$box['name']);
                        }
                        $box_names = array_unique($box_names);
                        ?>
                        @foreach ($box_names as $box)
                        <div class="d-flex mb-2 justify-content-between align-items-center box_row"
                            id="b{{$loop->iteration}}">
                            <input type="text" disabled class="form-control w-100 mr-2 box_input" name="boxs[{{$box}}]"
                                placeholder="بسته" id="b{{$loop->iteration}}" value="{{$box}}" data-sql-id='yes'>
                            <span class="w-60 btn btn-light border border-black" data-toggle="dropup"
                                title="درصورت حذف بسته موجودی آن حذف میشود">دارای موجودی</span>
                            <div>
                                <button data-sql-id='yes' data-sql-name='{{$box}}' type="button"
                                    class="box_remove btn btn-outline-danger" id="b{{$loop->iteration}}">&times</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="card p-4">
                    <div class="container">
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
                    <button type="submit" class="btn_submit btn btn-block  btn-dark">ثبت تغییر</button>
                </div>
                <div class="card p-4">
                    <h4 class="mb-2 text-right d-block border-bottom pb-2">تصویر</h4>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group">
                                <span class="btn btn-dark btn-block mb-2 btn-file">
                                    انتخاب عکس <input type="file" class="custom-file-input" name="picture" id="picture">
                                </span>
                            </span>
                            <input type="text" id="image_name" class="form-control w-100" dir="ltr"
                                value="{{$product->image}}" readonly>
                        </div>
                        <img id='img-upload' src='{{asset("upload/$product->image")}}' />
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
                                        value="{{ $category->id }} ">
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
    @section('product_edit_js')

    {{-- form UI  --}}
    <script>
        var product = {};
        var product_new = {};
        var product_update = {};
        var product_delete = {};


        product.image = 'default/product.png';
        $(document).on('change', '#picture', function () {
            uploadImage();
        })
        //size
        var sizes = [];
        var size_row_id = 100;
        var size_value;
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
        var color_row_id = 100;
        var color_value;
        $('.color_add').click(function () {
            color_value = $(this).attr('data-content');
            color_row_id++;
            color_row =
                `<div class="d-flex mb-2 justify-content-between align-items-center color_row" id="i` +
                color_row_id + `" >
                    <input  data-sql-id="no" type="text" class="form-control w-100 mr-2 color_input" name="colors[]" placeholder="رنگ" id="` +
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
        var box_row_id = 100;
        var box_value;
        $('.box_add').click(function () {
            box_value = $(this).attr('data-content');
            box_row_id++;
            box_row =
                `<div class="d-flex mb-2 justify-content-between align-items-center box_row" id="b` + box_row_id + `" >
                <input data-sql-id="no" type="number" class="form-control w-100 mr-2 box_input" name="boxs[]" placeholder="بسته" id="` +
                box_row_id + `" value="` + box_value + `">
                <div><button type="button" class="box_remove btn btn-outline-dark" id="b` + box_row_id + `">&times</button></div>
                </div>`;
            $('.box_board').append($(box_row));
        });
        $('.box_board').on('click', '.box_remove', function () {
            $('.box_row#' + $(this).attr('id')).remove();
        });
    </script>

    {{-- Generate FormData Stucture--}}
    <script>
        $('input[name="category_id"]').each(function(){
        parseInt($(this).val()) == '{{$product->category_id}}' ? $(this).prop('checked',true) : '';
    })
    var sql_boxes=[];
    var sql_colors=[];
    var removed_colors =[];
    var removed_boxes =[]
    $('.box_remove').each(function(){
        if($(this).attr('data-sql-id') != 'no'){
            sql_boxes.push({
               id:$(this).attr('data-sql-id'),
               name:$(this).attr('data-sql-name'),
            })
        }
    });
    $('.color_remove').each(function(){
        if($(this).attr('data-sql-id') != 'no'){
            sql_colors.push({
                id:$(this).attr('data-sql-id'),
                name:$(this).attr('data-sql-color'),
            })
        }
    });
    var updated_colors =[];
    var updated_boxes = [];
    var dom_colors=[];
    var dom_boxes=[];
    var new_colors=[];
    var new_boxes=[];
    var dom_color_names =[];
    
    function dom_generator(){
        dom_colors=[];
        dom_boxes=[];
        //detect repeated nadarim bayad addkonim
        $('.color_input').each(function(){
            if(!isEmptyOrSpaces($(this).val())){
                dom_colors.push({
                'id' : $(this).attr('data-sql-id'),
                'name' : $(this).val(),
            })    
            }
        })
        $('.box_input').each(function(){
            if(!isEmptyOrSpaces($(this).val())){
            dom_boxes.push({
                'id' : $(this).attr('data-sql-id'),
                'name' : $(this).val(),
            })
        }
        })
        dom_colors = _.uniqWith(dom_colors, _.isEqual);
        dom_boxes = _.uniqWith(dom_boxes, _.isEqual);

        dom_boxes = _.uniqBy(dom_boxes, 'name');
        dom_colors = _.uniqBy(dom_colors, 'name');

        
    }
    function new_generator(){
        new_colors=[];
        new_boxes=[];
        $('.color_input').each(function(){
            if(!isEmptyOrSpaces($(this).val())){
                //too sql ham nabashe
                if($(this).attr('data-sql-id') == "no"){
                new_colors.push({
                'name' : $(this).val(),
                'id' : $(this).attr('data-sql-id'),
                'row' : $(this).attr('id'),
                })
            }   
            }
        })
        $('.box_input').each(function(){
            if(!isEmptyOrSpaces($(this).val())){
                if($(this).attr('data-sql-id') == "no"){
                new_boxes.push({
                'name' : $(this).val(),
                'id' : $(this).attr('data-sql-id'),
                })
        }   
        }
        }) 
        dom_colors = _.uniqWith(dom_colors, _.isEqual);
        dom_colors = _.uniqWith(dom_colors, _.isEqual);
        new_boxes = _.uniqWith(new_boxes, _.isEqual);
        new_colors = _.uniqWith(new_colors, _.isEqual);

        dom_colors = _.uniqWith(dom_colors, _.isEqual);
        dom_boxes = _.uniqWith(dom_boxes, _.isEqual);

        new_boxes = _.uniqBy(new_boxes, 'name');
        new_colors = _.uniqBy(new_colors, 'name');
        
        new_boxes = _.uniqBy(new_boxes,sql_boxes, 'name');
        new_colors = _.differenceBy(new_colors,sql_colors,'name');


    }


    // function deference_generator(){
        
    // }
    

    $('.color_remove').click(function(){
        var this_id = $(this).attr('data-sql-id');
            removed_colors.push({
                id:$(this).attr('data-sql-id'),
                name:$(this).attr('data-sql-color'),
            })
            updated_colors = $.grep(updated_colors, function(e){ 
            return e.id != this_id; 
            });
            dom_colors = $.grep(dom_colors, function( element, index ) {
            return element.id != this_id;
            }, true );
    });
    $('.color_input_sql').keyup(function(){
        var this_val = $(this).val();
        var this_id = $(this).attr('data-sql-id');
        updated_colors = $.grep(updated_colors, function(e){ 
        return e.id != this_id; 
        });
        updated_colors.push({
                    color_value : this_val,
                    id : this_id
        })
    })
    function get_box_value(color_id,box_name){
            $.ajax({
                type: "get",
                url: "/products/get_box_value",
                async:false,
                data: {
                    product_id : '{{$product->id}}',
                    color_id : color_id,
                    box_name : box_name,
                },
                success: function (data) {
                    result = data;
                },
            });
            return result;
        }
    $('.items_submit').click(function () {
        dom_generator();
        new_generator();
        // deference_generator();

        var i = 0;
        var b = 0;
        $('.items_tab').empty();
        $('.items_tab_content').empty();
        
    $.each(dom_colors, function () {
        if (i == 0)
        var active = 'active';
        var item_row = `<li class="nav-item item_row"  id=` + i +
            `><a class="nav-link item_link " data-toggle="tab" href="#m` + i + `"
             data-color="` + dom_colors[i].name + `">` + dom_colors[i].name + `  ` + `</a></li>`;
        $('.items_tab').append(item_row);

        var items_tab_pane = `
            <div id="m` + i + `" class="items_tab_pane tab-pane"  data-color-id="` + dom_colors[i].id + `"  data-color="` + dom_colors[i].name + `">
            </div>
            `;
        $('.items_tab_content').append(items_tab_pane);
        i++;
    });
    $.each(dom_boxes, function (e,i) {
        ////////////////////
        if(i.id == 'no'){
            var box_item_row = `
            <div class="row box_item_row mt-2" id="` + b + `">
                <div class="col-6"><span class=" d-block pr-1 pt-2"> بسته ` + dom_boxes[b].name + ` تایی</span> </div>
                <div class="col-6">
                    <div class="form-group">
                        <input name="boxs[1]"  type="number" class="form-control w-100 item_value item_value_new"  id="v` + b +
            `"data-name="` + dom_boxes[b].name + `" >
                    </div>
                </div>
            </div>`;
        }else{
            var box_item_row = `
            <div class="row box_item_row mt-2" id="` + b + `">
                <div class="col-6"><span class=" d-block pr-1 pt-2"> بسته ` + dom_boxes[b].name + ` تایی [موجود]</span> </div>
                <div class="col-6">
                    <div class="form-group">
                        <input name="boxs[1]"  type="number" class="form-control w-100 item_value item_value_sql"  id="v` + b +
            `"data-name="` + dom_boxes[b].name + `" >
                    </div>
                </div>
            </div>`;
        }
      
   
        $('.items_tab_pane').append(box_item_row);
        b++
    });


            ///ye rahesh ineke sql-pack shode haro generate kone + new



        $(".item_link").first().click(); //select a tab!
        $('.items_tab_pane').each(function () {
            $(this).find(".item_value").attr('data-color',$(this).attr('data-color'));
            $(this).find(".item_value").attr('data-color-id',$(this).attr('data-color-id'));
        });
     
    $('.item_value_sql').each(function(){
            $(this).val(get_box_value($(this).attr('data-color-id'),$(this).attr('data-name')));
        })
    })
    </script>
    <script>

    $('.items_submit').click();
    $("#product_update_form").on('submit', function (e) {
    e.preventDefault();
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



    product.category_id = $("input[name='category_id']:checked").val();
    product.code = $("input[name='code']").val();
    product.name = $("input[name='name']").val();
    product.price = $("input[name='price']").val();
    product.price_financial = $("input[name='price_financial']").val();



    product_new.colors = []; 
    $.each(new_colors,function(i,v){
        product_new.colors.push(
            {
            color_name: v.name,
            color_id: v.id,
            color_row:v.row,
            }
            );
    })

    product_new.boxes = []; 
    $('.item_value_new').each(function(){
        product_new.boxes.push(
            {
            color_name: $(this).attr('data-color'),
            color_id: $(this).attr('data-color-id'),
            box_name:$(this).attr('data-name'),
            box_value:$(this).val(),
            }
            );
    })

  
    // if ((item_is_valid && input_is_valid && color_is_valid && size_is_valid && box_is_valid) ||true ) {
        console.log(product);
        // return false;
        // $.ajax({
        //     type: "POST",
        //     url: "/products/store",
        //     data: product,
        //     dataType: "json",
        //     success: function (data) {
        //         console.log(data);
        //         $('.alert-success').show();
        //         setTimeout(
        //             function () {
        //                 location.reload(true);
        //             }, 1500);
        //     },
        //     error: function (xhr, ajaxOptions, thrownError) {
        //         console.log(xhr.status);
        //         console.log(thrownError);
        //     }
        // })
    // } else {
        // alert('فیلد هارا بررسی کنید');
    // }



});

$("#product_update_form").submit();
    </script>
    @endsection