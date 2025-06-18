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
            }else if(data.status === 'error'){
                 window.location.reload();
            }
        },
error: function (xhr, status, error) {
    // Log error details to console for debugging
    console.log('Error:', error);
    console.log('Status:', status);
    console.log('XHR:', xhr);

    // Show specific error message
    let errorMessage = xhr.responseJSON?.message || `Error: ${xhr.status} ${xhr.statusText}`;
    notyf.error(errorMessage);
}
    });
});


$(document).on('submit', '.shopping_cart_form', function(e) {
    e.preventDefault();
    console.log('Form submitted'); // Debug: Check if the event is triggered

    let formData = $(this).serialize();

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
       url: config.routes.addToCart,
        type: 'POST',
        data: formData,
        success: function(data) {
            console.log('Success:', data); // Debug: Log the response
            if (data.status === 'success') {
                getCartCount(); // Call the function to update cart count
                notyf.success(data.message);
            } else if(data.status === 'stockout') {
                notyf.error(data.message);
            }else if(data.status === 'qty_error') {
                notyf.error(data.message);
            }
        },
        error: function(xhr, status, error) {
            console.log('Error:', xhr, status, error); // Debug: Log the error
            notyf.error(xhr.responseJSON?.message || 'An error occurred');
        }
    });
});

// Move getCartCount outside the submit handler
function getCartCount() {
    $.ajax({
        url: config.routes.cartCount,
        type: "GET",
        success: function(data) {
            console.log('Cart Count:', data); // Debug: Log the response
            if (data.status === 'success') {
                $('.cart_count').text(data.count);
            }
        },
        error: function(xhr, status, error) {
            console.log('Cart Count Error:', xhr, status, error); // Debug: Log the error
            notyf.error('Failed to fetch cart count');
        }
    });
}