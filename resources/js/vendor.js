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
