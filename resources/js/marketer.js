    $('#table_marketer').DataTable({
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
            url: "/marketers/table",
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
                data: 'username',
                name: 'username'
            },
            {
                data: 'phone',
                name: 'phone'
            },
            {
                data: 'actions',
                name: 'actions'
            },
        ]
    })
    $(document).on('click', '.btn-marketer-modal', function () {

        if ($(this).attr('data-action') == 'add') {
            $('.edit-show').hide();
            $('.modal-title').html('افزودن مشتری');
            $('.marketer-modal-form').attr('action', '/marketers/store');
            $('#marketer-modal').modal();
        }

        if ($(this).attr('data-action') == 'edit') {
            $('.edit-show').show();
            $('.modal-title').html('ویرایش مشتری');
            $('.marketer-modal-form').attr('action', '/marketers/update');
            $.ajax({
                url: "/marketers/edit/" + $(this).attr('id'),
                dataType: "json",
                success: function (data) {
                    $("#username").val(data.result[0].username);
                    $("#name").val(data.result[0].name);
                    $("#lastname").val(data.result[0].lastname);
                    $("#phone").val(data.result[0].phone);
                    $("#marketer_hidden_id").val(data.result[0].id);
                }
            });
            $('#marketer-modal').modal();
        }
        if ($(this).attr('data-action') == 'delete') {
            $('.modal-title').html('حذف مشتری');
            $('.hidden_delete_id').val($(this).attr('id'));
            $('.marketer-modal-form').attr('action', '/marketers/destroy');
            $('.marketer-modal-form').attr('method', 'get');
            $('#marketer-modal-delete').modal();
        }
    })
