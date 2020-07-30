
$('#table_category').DataTable({
    dom: 'Pflrtip',
    language: {
        "emptyTable":"هیچ داده ای جهت نمایش وجود ندارد",
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
        url: "/categories/table",
    },
    columns: [
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'parent',
            name: 'parent'
        },
        {
            data: 'action',
            name: 'action'
        },
    ]
});


var category_id;

$(document).on('click', '.cat_delete', function () {
    category_id = $(this).attr('id');
    $("#cat_delete_modal").modal();
})
$('.cat_delete_ok').click(function () {
    $.ajax({
        type: "GET",
        url: "/categories/destroy/" + category_id,
        beforeSend: function () {
            $('.cat_delete_ok').text('...درحال حذف');
        },
        success: function (data) {
            setTimeout(function () {
                $('.cat_delete_ok').text('بله حذف کن');
                $('#cat_delete_modal').modal('hide');
                location.reload();
            }, 1000);
        }
    });
})

$(document).on('click', '.cat_edit', function () {
    category_id = $(this).attr('id');
    $("#cat_edit_modal").modal();
    $.ajax({
        url: "/categories/edit/" + category_id,
        dataType: "json",
        success: function (data) {
            $("#category_name").val(data.result[0].name);
            $("#category_hidden_id").val(data.result[0].id);
            $("#category_parrent").val(data.result[0].parent_id);

            $("option").each(function () {
                if ($(this).html() == data.result[0].name)
                    $(this).addClass('d-none');
                else
                    $(this).removeClass('d-none');
            })
        }
    })
})


$('#category_edit_form').on('submit', function (event) {
    console.log($(this).serialize());
    event.preventDefault();
    $.ajax({
        url: "/categories/update",
        method: "POST",
        data: $(this).serialize(),
        dataType: "json",
        success: function (data) {
            location.reload();
            $("#cat_edit_modal").modal('hide');

        }
    });
});