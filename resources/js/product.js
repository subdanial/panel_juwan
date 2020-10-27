//table
$('#table-products').DataTable({
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
        url: "/products/table",
    },
    columns: [{
            class:"align-middle",
            data: 'code',
            name: 'code'
        },
        {
            class:"align-middle",
            data: "name",
            name: "name",

            render: function (data, type, row, meta) {
                return '<a data-caption="' + data + ' | کد : ' + row.code + '" data-fancybox="gallery" href="/upload/' + row.image + '" target="_blank" class="d-flex text-dark  text-dark align-items-center">\n<img class="border bordar-dark ml-3 mr-2" src="/upload/' + row.image + '" width="64">\n  <span>' + data + "</span>\n </a>"
            }
        },



        {
            class:"align-middle",
            data: 'category',
            name: 'category'
        },
        {
            class:"align-middle",
            data: 'price',
            name: 'price'
        },
        {
            class:"align-middle",
            data: 'price_financial',
            name: 'price_financial'
        },
        {
            class:"align-middle",
            data: 'sizes',
            name: 'sizes'
        },
        {
            class:"align-middle",
            data: 'colors',
            name: 'colors'
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
});

$('#table-products-anbaar').DataTable({
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
        url: "/products/table",
    },
    columns: [{
            class:"align-middle",
            data: 'code',
            name: 'code'
        },
        {
            class:"align-middle",
            data: "name",
            name: "name",
            render: function (data, type, row, meta) {
                return '<a  data-caption="' + data + ' | کد : ' + row.code + '" data-fancybox="gallery" href="/upload/' + row.image + '" target="_blank" class="text-dark d-block">'+data+'</a>';

            }
        },
        {
            class:"align-middle",
            data: 'category',
            name: 'category'
        },
        {
            class:"align-middle",
            data: 'price',
            name: 'price'
        },
        {
            class:"align-middle",
            data: 'colors',
            name: 'colors',
            render:function(data, type, row, meta){
              string = `<span class="badge p-2 rounded-0 badge-dark" tabindex="0" data-toggle="tooltip" title="`+data+`">مشاهده</span>`
              return string;
            }
        },
        {
            class:"align-middle",
            data: 'sizes',
            name: 'sizes',
            render:function(data, type, row, meta){
                string = `<span class="badge p-2 rounded-0 badge-dark" tabindex="0" data-toggle="tooltip" title="`+data+`">مشاهده</span>`
                return string;
              }
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
});


$('#table-products-order').DataTable({
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
        url: "/products/table_order",
    },
    columns: [{
            class: "align-middle",
            data: 'code',
            name: 'code'
        },
        {
            class: "align-middle",
            data: "name",
            name: "name",
            render: function (data, type, row, meta) {
                // return '<a href="/upload/' + row.image + '" target="_blank" >' + data + '</a>';
                return data;
            }
        },

        {
            class: "align-middle",
            data: "name",
            name: "name",
            render: function (data, type, row, meta) {
                return '<a  data-caption="' + data + ' | کد : ' + row.code + '" data-fancybox="gallery" href="/upload/' + row.image + '" target="_blank" class="text-dark d-block">\n<img class="border border-dark mr-2" src="/upload/' + row.image + '" width="64">\n  </a>';
            }
        },
        {
            class: "align-middle",
            data: 'category',
            name: 'category'
        },
        // {
        //     data: 'price',
        //     name: 'price'
        // },

        // {
        //     data: 'sizes',
        //     name: 'sizes'
        // },
        // {
        //     data: 'colors',
        //     name: 'colors'
        // },

        {
            class: "align-middle",
            data: 'action',
            name: 'action'
        },
    ]
});



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
        qrcode.clear();
        qrcode.makeCode($(this).attr('data-code'));
  

})