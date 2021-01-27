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
                data: 'role',
                name: 'role',
                render: function (data, type, row, meta) {
                    var status_text;
                    switch (data) {
                        case 3:
                            status_text = "فروشنده"
                            break;
                        case 1:
                            status_text = "مالی"
                            break;
                        case 2:
                            status_text = "انبار"
                            break;

                    }
                    return status_text;
                }
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
       

        switch ($(this).attr('data-user-role')) {
            case '3':
                $('.maali').hide();
                $('.anbaar').hide();
                $('.foroosh').show();
            break;
            case '2':
                $('.maali').hide();
                $('.anbaar').show();
                $('.foroosh').show();
            break;
            case '1':
                $('.maali').show();
                $('.anbaar').show();
                $('.foroosh').show();
            break;

        }
    
  



    if ($(this).attr('data-action') == 'add') {
        $('.edit-show').hide();
        $('.modal-title').html('افزودن کاربر');
        $('.marketer-modal-form').attr('action', '/marketers/store');
        $('#marketer-modal').modal();


    }

    if ($(this).attr('data-action') == 'edit') {
        $('.edit-show').show();
        $('.modal-title').html('ویرایش کاربر');
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
                $('#role option[value="' + data.result[0].role + '"]').prop('selected', true);

                ///accesses
                var no_access_object;
                if (data.result[0].no_access !== "") {
                    no_access_object = JSON.parse(data.result[0].no_access);
                } else {
                    no_access_object = {
                        "view_user": 1,
                        "view_clients": 0,
                        "view_category": 0,
                        "view_products": 0,
                        "view_orders": 0
                    }
                }
                console.log(no_access_object)
                if (no_access_object.view_category == 1) {
                    $('[name ="view_category"]').filter(function () {
                        return (this.value == 1)
                    }).prop("checked", true);
                } else {
                    $('[name ="view_category"]').filter(function () {
                        return (this.value == 0)
                    }).prop("checked", true);
                }

                if (no_access_object.view_clients == 1) {
                    $('[name ="view_clients"]').filter(function () {
                        return (this.value == 1)
                    }).prop("checked", true);
                } else {
                    $('[name ="view_clients"]').filter(function () {
                        return (this.value == 0)
                    }).prop("checked", true);
                }

                if (no_access_object.view_products == 1) {
                    $('[name ="view_products"]').filter(function () {
                        return (this.value == 1)
                    }).prop("checked", true);
                } else {
                    $('[name ="view_products"]').filter(function () {
                        return (this.value == 0)
                    }).prop("checked", true);
                }

                if (no_access_object.view_orders == 1) {
                    $('[name ="view_orders"]').filter(function () {
                        return (this.value == 1)
                    }).prop("checked", true);
                } else {
                    $('[name ="view_orders"]').filter(function () {
                        return (this.value == 0)
                    }).prop("checked", true);
                }

                if (no_access_object.view_user == 1) {
                    $('[name ="view_user"]').filter(function () {
                        return (this.value == 1)
                    }).prop("checked", true);
                } else {
                    $('[name ="view_user"]').filter(function () {
                        return (this.value == 0)
                    }).prop("checked", true);
                }





            }
        });
        $('#marketer-modal').modal();
    }
    if ($(this).attr('data-action') == 'delete') {
        $('.modal-title').html('حذف کاربر');
        $('.hidden_delete_id').val($(this).attr('id'));
        $('.marketer-modal-form').attr('action', '/marketers/destroy');
        $('.marketer-modal-form').attr('method', 'get');
        $('#marketer-modal-delete').modal();
    }
    })
