//table_client
    $('#table_client').DataTable({
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
        order: [[ 0, "desc" ]],

        processing: true,
        serverSide: true,
        ajax: {
            url: "/clients/table",
        },

        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'lastname',
                name: 'lastname'
            },
            {
                data: 'creator',
                name: 'creator'
            },
            {
                data: 'phone',
                name: 'phone'
            },
            {
                data: 'city',
                name: 'city'
            },
            // {
            //     data: 'address',
            //     name: 'address'
            // },
            {
                data: 'balance',
                name: 'balance'
            },
            {
                data: 'actions',
                name: 'actions'
            },
        ]
    })
    //table_client_marketer
    //table_client
    $('#table_client_marketer').DataTable({
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
        order: [[ 0, "desc" ]],

        processing: true,
        serverSide: true,
        ajax: {
            url: "/clients/table_marketer",
        },
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'lastname',
                name: 'lastname'
            },
            {
                data: 'phone',
                name: 'phone'
            },
            {
                data: 'city',
                name: 'city'
            },
            {
                data: 'balance',
                name: 'balance'
            },
            {
                data: 'actions',
                name: 'actions'
            },

        ]
    })

    $(document).on('click', '.btn-client-modal', function () {

        if ($(this).attr('data-action') == 'add') {
            $('.edit-show').hide();
            $('.modal-title').html('افزودن مشتری');
            $('.client-modal-form').attr('action', '/clients/store');
            $('#client-modal').modal();
        }

        if ($(this).attr('data-action') == 'edit') {
            $('.edit-show').show();
            $('.modal-title').html('ویرایش مشتری');
            $('.client-modal-form').attr('action', '/clients/update');
            $.ajax({
                url: "/clients/edit/" + $(this).attr('id'),
                dataType: "json",
                success: function (data) {
                    $("#name").val(data.result[0].name);
                    $("#lastname").val(data.result[0].lastname);
                    $("#city").val(data.result[0].city);
                    $("#address").html(data.result[0].address);
                    $("#phone").val(data.result[0].phone);
                    $("#balance").val(data.result[0].balance);
                    $("#client_hidden_id").val(data.result[0].id);
                }
            });
            $('#client-modal').modal();
        }


        
        if ($(this).attr('data-action') == 'delete') {
            $('.modal-title').html('حذف مشتری');
            $('.hidden_delete_id').val($(this).attr('id'));
            $('.client-modal-form').attr('action', '/clients/destroy');
            $('.client-modal-form').attr('method', 'get');
            $('#client-modal-delete').modal();
        }
    })
