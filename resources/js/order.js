
//table
$('#table_order').DataTable({
    dom: 'Pflrtip',
    language: {
        "emptyTable": "هیچ داده ای جهت نمایش وجود ندارد",
        "info": "نمایش _START_ تا _END_ از _TOTAL_ رکود",
        "infoEmpty": "نمایش 0 تا 0 از 0 رکود",
        "search": "جستجو",
        "lengthMenu": "نمایش _MENU_",
        "processing": " درحال پردازش ...",
        "paginate": {
            "first": "اولین",
            "last": "آخرین",
            "next": "بعدی",
            "previous": "قبلی"
        },
    },
    processing: true,
    serverSide: true,
    ajax: {
        url: "/orders/table",
    },
    columns: [{
            class:"align-middle",
            data: 'id',
            name: 'id'
        },
        {
            class:"align-middle",
            data: 'returned',
            name: 'returned',
            render: function (data, type, row, meta) {
                var status_text;
                switch (data) {
                    case 0:
                        status_text = "خرید"
                        break;
                    case 1:
                        status_text = "مرجوعی"
                        break;

                }
                return status_text;
            },
        },
        {

            class:"align-middle",
            data: 'client',
            name: 'client'
        },
        {
            class:"align-middle",
            data: 'user',
            name: 'user'
        },
        {
            class:"align-middle",
            data: 'type',
            name: 'type',
            render: function (data, type, row, meta) {
                var status_text;
                switch (data) {
                    case 0:
                        status_text = "نقدی"
                        break;
                    case 1:
                        status_text = "چک + نقد"
                        break;
                    case 2:
                        status_text = "حساب باز"
                        break;
                        case 3:
                            status_text = "مرجوع شده"
                            break;
                }
                return status_text;
            },
        },
        {
            class:"align-middle",
            data: 'amount',
            name: 'amount'
        },
        {
            class:"align-middle",
            data: 'amount_financial',
            name: 'amount_financial'
        },
        {
            class:"align-middle",
            data: 'amount_returned',
            name: 'amount_returned'
        },
        {
            class:"align-middle",
            data: 'discount',
            name: 'discount'
        },
        {
            class:"align-middle",
            data: 'pos',
            name: 'pos'
        },
        {
            class:"align-middle",
            data: 'cheque',
            name: 'cheque'
        },
        {
            class:"align-middle",
            data: 'cash',
            name: 'cash'
        },
        {
            class:"align-middle",
            data: 'updated_at',
            name: 'updated_at'
        },
        {
            class:"align-middle",
            data: 'date_manual',
            name: 'date_manual'
        },
        {
            class:"align-middle",
            data: 'maali_status',
            name: 'maali_status',
            render: function (data, type, row, meta) {
                var status_text;
                switch (data) {
                    case 0:
                        status_text = "<i class='fas  fa-hourglass-start text-secondary'></i>"
                        break;
                    case 1:
                        status_text = "<i class='fas fa-check-circle text-success'></i>"
                        break;

                }
                return status_text;
            },
        },
        {
            class:"align-middle",
            data: 'anbaar_status',
            name: 'anbaar_status',
            render: function (data, type, row, meta) {
                var status_text;
                switch (data) {
                    case 0:
                        status_text = "<i class='fas  fa-hourglass-start text-secondary'></i>"
                        break;
                    case 1:
                        status_text = "<i class='fas fa-check-circle text-success'></i>"
                        break;

                }
                return status_text;
            },
            
        },
        {
            class:"align-middle",
            data: 'foroosh_status',
            name: 'foroosh_status',
            render: function (data, type, row, meta) {
                var status_text;
                switch (data) {
                    case 0:
                        status_text = "<i class='fas fa-hourglass-start text-secondary'></i>"
                        break;
                    case 1:
                        status_text = "<i class='fas fa-check-circle text-success'></i>"
                        break;

                }
                return status_text;
            },
        },
        {
            class:"align-middle",
            data: 'action',
            name: 'action'
        },

    ]
})
//table_order_anbaar
//table
$('#table_order_anbaar').DataTable({
    dom: 'Pflrtip',
    language: {
        "emptyTable": "هیچ داده ای جهت نمایش وجود ندارد",
        "info": "نمایش _START_ تا _END_ از _TOTAL_ رکود",
        "infoEmpty": "نمایش 0 تا 0 از 0 رکود",
        "search": "جستجو",
        "lengthMenu": "نمایش _MENU_",
        "processing": " درحال پردازش ...",
        "paginate": {
            "first": "اولین",
            "last": "آخرین",
            "next": "بعدی",
            "previous": "قبلی"
        },
    },
    processing: true,
    serverSide: true,
    ajax: {
        url: "/orders/table",
    },
    columns: [{
            class:"align-middle",
            data: 'id',
            name: 'id'
        },
        {
            class:"align-middle",
            data: 'returned',
            name: 'returned',
            render: function (data, type, row, meta) {
                var status_text;
                switch (data) {
                    case 0:
                        status_text = "خرید"
                        break;
                    case 1:
                        status_text = "مرجوعی"
                        break;

                }
                return status_text;
            },
        },
        {

            class:"align-middle",
            data: 'client',
            name: 'client'
        },
        {
            class:"align-middle",
            data: 'user',
            name: 'user'
        },
        {
            class:"align-middle",
            data: 'maali_status',
            name: 'maali_status',
            render: function (data, type, row, meta) {
                var status_text;
                switch (data) {
                    case 0:
                        status_text = "<i class='fas  fa-hourglass-start text-secondary'></i>"
                        break;
                    case 1:
                        status_text = "<i class='fas fa-check-circle text-success'></i>"
                        break;

                }
                return status_text;
            },
        },
        {
            class:"align-middle",
            data: 'anbaar_status',
            name: 'anbaar_status',
            render: function (data, type, row, meta) {
                var status_text;
                switch (data) {
                    case 0:
                        status_text = "<i class='fas  fa-hourglass-start text-secondary'></i>"
                        break;
                    case 1:
                        status_text = "<i class='fas fa-check-circle text-success'></i>"
                        break;

                }
                return status_text;
            },
            
        },
        {
            class:"align-middle",
            data: 'foroosh_status',
            name: 'foroosh_status',
            render: function (data, type, row, meta) {
                var status_text;
                switch (data) {
                    case 0:
                        status_text = "<i class='fas fa-hourglass-start text-secondary'></i>"
                        break;
                    case 1:
                        status_text = "<i class='fas fa-check-circle text-success'></i>"
                        break;

                }
                return status_text;
            },
        },
        {
            class:"align-middle",
            data: 'action',
            name: 'action'
        },

    ]
})


$('#table_order_foroosh').DataTable({
    dom: 'Pflrtip',
    language: {
        "emptyTable": "هیچ داده ای جهت نمایش وجود ندارد",
        "info": "نمایش _START_ تا _END_ از _TOTAL_ رکود",
        "infoEmpty": "نمایش 0 تا 0 از 0 رکود",
        "search": "جستجو",
        "lengthMenu": "نمایش _MENU_",
        "processing": " درحال پردازش ...",
        "paginate": {
            "first": "اولین",
            "last": "آخرین",
            "next": "بعدی",
            "previous": "قبلی"
        },
    },
    processing: true,
    serverSide: true,
    ajax: {
        url: "/orders/table_foroosh",
    },
    columns: [{
            class:"align-middle",
            data: 'id',
            name: 'id'
        },
        {
            class:"align-middle",
            data: 'returned',
            name: 'returned',
            render: function (data, type, row, meta) {
                var status_text;
                switch (data) {
                    case 0:
                        status_text = "خرید"
                        break;
                    case 1:
                        status_text = "مرجوعی"
                        break;

                }
                return status_text;
            },
        },

        {
            class:"align-middle",
            data: 'type',
            name: 'type',
            render: function (data, type, row, meta) {
                var status_text;
                switch (data) {
                    case 0:
                        status_text = "نقدی"
                        break;
                    case 1:
                        status_text = "چک + نقد"
                        break;
                    case 2:
                        status_text = "حساب باز"
                        break;
                        case 3:
                            status_text = "مرجوع شده"
                            break;
                }
                return status_text;
            },
        },


        {
            class:"align-middle",
            data: 'client',
            name: 'client'
        },
        {
            class:"align-middle",
            data: 'updated_at',
            name: 'updated_at'
        },
        {
            class:"align-middle",
            data: 'maali_status',
            name: 'maali_status',
            render: function (data, type, row, meta) {
                var status_text;
                switch (data) {
                    case 0:
                        status_text = "<i class='fas  fa-hourglass-start text-secondary'></i>"
                        break;
                    case 1:
                        status_text = "<i class='fas fa-check-circle text-success'></i>"
                        break;

                }
                return status_text;
            },
        },
        {
            class:"align-middle",
            data: 'anbaar_status',
            name: 'anbaar_status',
            render: function (data, type, row, meta) {
                var status_text;
                switch (data) {
                    case 0:
                        status_text = "<i class='fas  fa-hourglass-start text-secondary'></i>"
                        break;
                    case 1:
                        status_text = "<i class='fas fa-check-circle text-success'></i>"
                        break;

                }
                return status_text;
            },
            
        },
        {
            class:"align-middle",
            data: 'foroosh_status',
            name: 'foroosh_status',
            render: function (data, type, row, meta) {
                var status_text;
                switch (data) {
                    case 0:
                        status_text = "<i class='fas fa-hourglass-start text-secondary'></i>"
                        break;
                    case 1:
                        status_text = "<i class='fas fa-check-circle text-success'></i>"
                        break;

                }
                return status_text;
            },
        },
        {
            class:"align-middle",
            data: 'action',
            name: 'action'
        },

    ]
})


//table_temporary
$('#table_order_temporary').DataTable({
    dom: 'Pflrtip',
    language: {
        "emptyTable": "هیچ داده ای جهت نمایش وجود ندارد",
        "info": "نمایش _START_ تا _END_ از _TOTAL_ رکود",
        "infoEmpty": "نمایش 0 تا 0 از 0 رکود",
        "search": "جستجو",
        "lengthMenu": "نمایش _MENU_",
        "processing": " درحال پردازش ...",
        "paginate": {
            "first": "اولین",
            "last": "آخرین",
            "next": "بعدی",
            "previous": "قبلی"
        },
    },
    processing: true,
    serverSide: true,
    ajax: {
        url: "/orders/table_temporary",
    },
    columns: [{
            class:"align-middle",
            data: 'id',
            name: 'id'
        },
        {

            class:"align-middle",
            data: 'client',
            name: 'client'
        },

        {
            class:"align-middle",
            data: 'action',
            name: 'action'
        },

    ]
})
//table_pre_invoice
$('#table_pre_invoice').DataTable({
    dom: 'Pflrtip',
    language: {
        "emptyTable": "هیچ داده ای جهت نمایش وجود ندارد",
        "info": "نمایش _START_ تا _END_ از _TOTAL_ رکود",
        "infoEmpty": "نمایش 0 تا 0 از 0 رکود",
        "search": "جستجو",
        "lengthMenu": "نمایش _MENU_",
        "processing": " درحال پردازش ...",
        "paginate": {
            "first": "اولین",
            "last": "آخرین",
            "next": "بعدی",
            "previous": "قبلی"
        },
    },
    processing: true,
    serverSide: true,
    ajax: {
        url: "/orders/table_pre_invoice",
    },
    columns: [{
            class:"align-middle",
            data: 'id',
            name: 'id'
        },
        {

            class:"align-middle",
            data: 'client',
            name: 'client'
        },
        {
            class:"align-middle",
            data: 'user',
            name: 'user'
        },
        {
            class:"align-middle",
            data: 'amount',
            name: 'amount'
        },
        {
            class:"align-middle",
            data: 'updated_at',
            name: 'updated_at'
        },
        {
            class:"align-middle",
            data: 'action',
            name: 'action'
        },

    ]
})

//fetch
$('.client_name').on('click select', function () {
    $(this).val('');
    $('.client_id').val('');

})



$('.client_name').keyup(function () {
    var query = $(this).val();
    var _token = $('input[name="_token"]').val();
    if (query != '') {
        $.ajax({
            url: '/orders/fetch',
            method: "POST",
            data: {
                query: query,
                _token: _token
            },
            success: function (data) {
                $('#clientList').fadeIn();
                $('#clientList').html(data);
            }
        });
    }
});

$(document).on('click', '.client_li', function () {
    $('.client_name').val($(this).text());
    $('.client_id').val($(this).attr('id'));

    $('#clientList').fadeOut();
});


//uploadinvoice 
$(document).on('change', '#invoice', function () {
    uploadInvoice();
})

//product select --

$(document).on('click', '.product_select', function () {
    $("#product_code").val($(this).attr('data-code'))
    $('.select_color').click();
})

$('.select_color').click(function (e) {
            e.preventDefault();
            $.ajax({
                    url: "/products/select",
                    data: {
                        "code": $('#product_code').val(),
                    },

                    success: function (reslut) {

                        var image = "http://" + window.location.hostname + '/upload/' + reslut.product_image;
                        var colors = $.map(reslut.product_colors, function (e) {
                            return [{
                                "id": e.id,
                                "color": e.name
                            }];
                        });
                        var boxes = $.map(reslut.product_boxes, function (e) {
                            return [{
                                "box_id": e.id,
                                "color_id": e.color_id,
                                "name": e.name,
                                "value": e.value
                            }];
                        });

                        var products = boxes.map(b => {
                            colors.forEach(c => {
                                if (c.id === b.color_id)
                                    for (key in c) {
                                        key !== 'id' ? (b[key] = c[key]) : null
                                    }
                            })
                            return b
                        })

                        $('.colors').empty();
                        $('.boxes').empty();
                        $('.colors').append("<option value='-1' id='-1'> انتخاب نشده </option>")


                        //ino bayad bebaram too edit product ham copyh konam bara var dadan be itema

                        $.each(colors, function (index, value) {
                            $('.colors').append("<option id='" + value.id + "'>" + value.color + "</option>")
                        })

                        $('.colors').on('change', function (e) {
                            $('.boxes').empty();
                            $.each(products, function (index, value) {
                                if (value.color == $('.colors').val())
                                    $('.boxes').append(
                                        `<div class="form-inline">` +
                                        `<span class="ml-2 "> بسته  ` + value.name + `تایی : </span>` +
                                        `<input type="number" min="0" max="` + value.value + `"   class="form-control box_item w-100" placeholder="موجودی : ` + value.value + `" name="item[` + value.box_id + `]">` +
                                        `</div>`
                                    );
                            })
                        });

                        $('.procut_image').attr('src', image)


                        $(document).on('keydown click keyup keypress', '.box_item', function () {
                                if (parseInt($(this).val()) > parseInt($(this).attr('max'))) {
                                        $(this).val($(this).attr('max'))
                                    }

                                    if (parseInt($(this).val()) <= 0 ) {
                                        $(this).val('')
                                    }
                                });
                        }
                    }).fail(function () {
                    alert('محصولی با این کد وجود ندارد');
                })
            })




        $('.order_create_submit').click(function (e) {
            e.preventDefault();
            var form_is_valid = 1;
            if ($("#product_code").val() == "") {
                $("#product_code").addClass('is-invalid');
                form_is_valid = 0;
            } else {
                $("#product_code").removeClass('is-invalid');
            }
            if ($(".client_name").val() == "" || $('.client_id').val() == "") {
                $(".client_name").addClass('is-invalid');
                form_is_valid = 0;
            } else {
                $(".client_name").removeClass('is-invalid');
            }
            if ($(".colors").children("option:selected").val() == '-1') {
                $(".colors").addClass('is-invalid');
                form_is_valid = 0;

            } else {
                $(".colors").removeClass('is-invalid');
            }
            if ($(".colors").children("option:selected").val() == '-1') {
                form_is_valid = 0;
                $(".colors").addClass('is-invalid');
            }
            var items = [];
            $("input[name*='item']").each(function () {
                if ($(this).val() !== "" && $(this).val() !== " " && $(this).val()*2 !== 0) {
                    items.push($(this).val());
                }
            })
            if (items.length == 0) {
                $("input[name*='item']").addClass('is-invalid');
                form_is_valid = 0;
            } else {
                $("input[name*='item']").removeClass('is-invalid');
            }

            if (form_is_valid == 1) {
                $('.order_store').submit();
            }

        })
       
//codelivecheck
$('.js-code-new').on('keyup',function(){

    $.ajax({
        type: "get",
        url: "/products/code_exists_check",
        data: {code:$(this).val()},
        success: function (response) {
            if(response.result == 1){
                $('input[name="code"]').addClass('is-invalid');
                $('.js-code-exist').show();
            }else{
                $('input[name="code"]').removeClass('is-invalid');
                $('.js-code-exist').hide(); 
            }
        }
    });
})