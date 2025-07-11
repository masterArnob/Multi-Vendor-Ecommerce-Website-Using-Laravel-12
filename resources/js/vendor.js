var notyf = new Notyf();

var delete_url = null;

$(document).on("click", ".delete-item", function (e) {
    e.preventDefault();

    let url = $(this).attr("href");
    delete_url = url;
    //alert(url);
    $("#modal-danger").modal("show");
});

$(document).on("click", ".delete-confirm", function (e) {
    e.preventDefault();
    //alert('aaaaaaa');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: delete_url,
        method: "DELETE",
        success: function (data) {
            if(data.status === 'success'){
                 window.location.reload();
            }
        },
        error: function (xhr, status, error) {
            notyf.error('Check Error');
        },
    });
});







$(document).on('change', '.order_status', function(){
    //alert('aaaaaaaaaaa');
    let order_id = $(this).data('id');
    // alert(order_id);
    let order_status = $(this).val();
    //alert(order_status);

        $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: config.routes.changeOrderStatus,
        method: 'POST',
        data:{
            order_id: order_id,
            order_status: order_status,
        },
        success: function(data){
            if(data.status === 'success'){
                notyf.success(data.message);
            }
        },
        error: function(xhr, status, error) {
            // Log error details to console for debugging
            console.log('Error:', error);
            console.log('Status:', status);
            console.log('XHR:', xhr);

            // Show specific error message
            let errorMessage = xhr.responseJSON?.message || `Error: ${xhr.status} ${xhr.statusText}`;
            notyf.error(errorMessage);
        }
    })
})