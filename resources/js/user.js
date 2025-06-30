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
            if (data.status === "success") {
                window.location.reload();
            } else if (data.status === "error") {
                window.location.reload();
            }
        },
        error: function (xhr, status, error) {
            // Log error details to console for debugging
            console.log("Error:", error);
            console.log("Status:", status);
            console.log("XHR:", xhr);

            // Show specific error message
            let errorMessage =
                xhr.responseJSON?.message ||
                `Error: ${xhr.status} ${xhr.statusText}`;
            notyf.error(errorMessage);
        },
    });
});

$(document).on("submit", ".shopping_cart_form", function (e) {
    e.preventDefault();
    console.log("Form submitted"); // Debug: Check if the event is triggered

    let formData = $(this).serialize();

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: config.routes.addToCart,
        type: "POST",
        data: formData,
        success: function (data) {
            console.log("Success:", data); // Debug: Log the response
            if (data.status === "success") {
                getCartCount(); // Call the function to update cart count
                notyf.success(data.message);
            } else if (data.status === "stockout") {
                notyf.error(data.message);
            } else if (data.status === "qty_error") {
                notyf.error(data.message);
            }
        },
        error: function (xhr, status, error) {
            console.log("Error:", xhr, status, error); // Debug: Log the error
            notyf.error(xhr.responseJSON?.message || "An error occurred");
        },
    });
});

// Move getCartCount outside the submit handler
function getCartCount() {
    $.ajax({
        url: config.routes.cartCount,
        type: "GET",
        success: function (data) {
            console.log("Cart Count:", data); // Debug: Log the response
            if (data.status === "success") {
                $(".cart_count").text(data.count);
            }
        },
        error: function (xhr, status, error) {
            console.log("Cart Count Error:", xhr, status, error); // Debug: Log the error
            notyf.error("Failed to fetch cart count");
        },
    });
}

$(document).on("click", ".increment-btn", function (e) {
    e.preventDefault();
    let input = $(this).siblings(".qty-input");
    let qty = parseInt(input.val()) + 1;
    input.val(qty);
    let rowid = input.data("rowid");
    //alert(rowid);
    //console.log(rowid);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: config.routes.updateQty,
        method: "POST",
        data: {
            qty: qty,
            rowid: rowid,
        },

        success: function (data) {
            if (data.status === "success") {
                //console.log(data.productTotal);
                let productId = "#" + rowid;
                $(productId).text(
                    config.icon.currency_icon + data.productTotal
                );
                getSubTotal();
                couponCalculation();
                notyf.success(data.message);
            }
        },
        error: function (xhr, status, error) {
            console.log("Error:", xhr, status, error); // Debug: Log the error
            notyf.error(
                xhr.responseJSON?.message ||
                    "An error occurred while updating quantity"
            );
        },
    });
});

$(document).on("click", ".decrement-btn", function (e) {
    e.preventDefault();
    let input = $(this).siblings(".qty-input");
    let qty = parseInt(input.val()) - 1;
    input.val(qty);

    if (qty < 1) {
        notyf.error("Quantity cannot be less than 1");
        input.val(1); // Reset input value to 1
        return; // Exit the function to prevent AJAX call
    }

    let rowid = input.data("rowid");
    //alert(rowid);
    //console.log(rowid);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: config.routes.updateQty,
        method: "POST",
        data: {
            qty: qty,
            rowid: rowid,
        },

        success: function (data) {
            if (data.status === "success") {
                //console.log(data.productTotal);
                let productId = "#" + rowid;
                $(productId).text(
                    config.icon.currency_icon + data.productTotal
                );
                getSubTotal();
                couponCalculation();
                notyf.success(data.message);
            }
        },
        error: function (xhr, status, error) {
            console.log("Error:", xhr, status, error); // Debug: Log the error
            notyf.error(
                xhr.responseJSON?.message ||
                    "An error occurred while updating quantity"
            );
        },
    });
});

function getSubTotal() {
    $.ajax({
        url: config.routes.subTotal,
        method: "GET",
        success: function (data) {
            if (data.status === "success") {
                $(".sub_total").text(config.icon.currency_icon + data.subTotal);
                //console.log(data.subTotal);
            }
        },
        error: function (xhr, status, error) {
            console.log("Error:", xhr, status, error); // Debug: Log the error
            notyf.error(
                xhr.responseJSON?.message ||
                    "An error occurred while fetching cart count"
            );
        },
    });
}

$(document).on("submit", ".coupon_form", function (e) {
    e.preventDefault();
    let formData = $(this).serialize();
    //alert(formData);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: config.routes.applyCoupon,
        method: "POST",
        data: formData,
        success: function (data) {
            if (data.status === "error") {
                notyf.error(data.message);
            } else if (data.status === "success") {
                couponCalculation();
                notyf.success(data.message);
            }
        },
        error: function (xhr, status, error) {
            console.log("Error:", xhr, status, error); // Debug: Log the error
            notyf.error(
                xhr.responseJSON?.message ||
                    "An error occurred while applying coupon"
            );
        },
    });
});

function couponCalculation() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: config.routes.couponCalculation,
        method: "POST",
        success: function (data) {
            if (data.status === "success") {
                $(".discount").text(
                    "(-)" + config.icon.currency_icon + data.discount
                );
                $(".cart_total").text(
                    config.icon.currency_icon + data.cart_total
                );
            }
        },
        error: function (data) {},
    });
}

$(document).on("click", ".shipping_address_id", function () {
    let shipping_address_id = $(this).data("id");
    //alert(shipping_address_id);
    $("#shipping_address_id").val(shipping_address_id);
});

$(document).on("click", ".shipping_rule_id", function () {
    // alert('ppppp');
    let shipping_rule_id = $(this).val();
    //alert(shipping_rule_id);
    $("#shipping_rule_id").val(shipping_rule_id);

    let shipping_fee = $(this).data("id");
    $(".shipping_fee").text("(+)" + config.icon.currency_icon + shipping_fee);
    // alert(shipping_fee);
    let total_cost = $(".total_cost").data("id");
    // alert(total_cost)
    let final_cost = total_cost + shipping_fee;
    //alert(final_cost);
    $(".final_cost").text(config.icon.currency_icon + final_cost);
});

$(document).on("click", ".checkoutForm", function (e) {
    e.preventDefault();
    let formData = $(".checkoutForm").serialize();
    //console.log(formData);
    let shipping_rule_id = $("#shipping_rule_id").val();
    let shipping_address_id = $("#shipping_address_id").val();

    if (shipping_rule_id === "") {
        notyf.error("Please select a shipping rule");
        return;
    } else if (shipping_address_id === "") {
        notyf.error("Please select a shipping address");
        return;
    } else {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: config.routes.chckoutFormSubmit,
            method: "POST",
            data: formData,
            success: function (data) {
                if(data.status === 'success'){
                    window.location.href = data.redirect_url;
                }else{
                    console.log(data.message);
                }
            },
            error: function (xhr, status, error) {
                console.log("Error:", xhr, status, error); // Debug: Log the error
                notyf.error(
                    xhr.responseJSON?.message ||
                        "An error occurred during checkout"
                );
            },
        });
    }
});

$(document).on('click', '.add_wishlist', function(e){
    e.preventDefault();
    //alert('aaaaaaaaaa');
    let id = $(this).data('id');

            $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });


    $.ajax({
        url: config.routes.wishlist,
        method: 'POST',
        data: {
            id: id,
        },
        success: function(data){
            if(data.status === 'success'){
                notyf.success(data.message);
                getWisCount();
            }else if(data.status === 'error'){
                window.location.reload();
            }
        },
        error: function(xhr, status, error) {
            console.log("Error:", xhr, status, error); // Debug: Log the error
            notyf.error(
                xhr.responseJSON?.message ||
                "An error occurred while adding to wishlist"
            );
        }
    })
})

function getWisCount(){
              $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

    $.ajax({
        url: config.routes.wishlistCount,
        type: 'POST',
        success: function(data){
            if(data.status === 'success'){
                $('.wishlist_count').text(data.count);
            }
        },
        error: function(xhr, status, error) {
            console.log("Error:", xhr, status, error); // Debug: Log the error
            notyf.error(
                xhr.responseJSON?.message ||
                "An error occurred while fetching wishlist count"
            );
        }
    });
}