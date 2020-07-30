
$('.item-delete').click(function () {
    var item_id = $(this).attr('id');
    $.ajax({
        type: "get",
        url: "/orders/item_delete/" + item_id,
        success: function (response) {
            location.reload()
        }
    });
});

$('input[name=order_type]').on('change', function () {
    switch ($(this).val()) {
        case '2':
            $('#order_return_form').addClass('d-none');
            $('#order_preinvoice_form').addClass('d-none');

            $('#order_buy_form').removeClass('d-none');
            break;
        case '3':
            $('#order_buy_form').addClass('d-none');
            $('#order_preinvoice_form').addClass('d-none');

            $('#order_return_form').removeClass('d-none');
            break;
        case '4':
            $('#order_buy_form').addClass('d-none');
            $('#order_return_form').addClass('d-none');

            $('#order_preinvoice_form').removeClass('d-none');
            break;
    }   
})


    //check anbaar inventory
     $('.item_tr').each(function(){
         var item_total_count = $(this).attr('data-item-count-total');
         var item_id = $(this).attr('id');
         var box_id = $(this).attr('data-box-id');
         var box_count = null;

         $.ajax({
             type: "get",
             url: "/boxes/box_value_count/"+box_id,
             async:false,
             success: function (response) {
                box_count = response;
            }
         });
         if(parseInt(item_total_count) > parseInt(box_count)){
             $(this).addClass('bg-warning');
             $('.submit_buy_order').prop('disabled',true);
             $('.alert-inventory-error').removeClass('d-none');
         }
      
     })
     