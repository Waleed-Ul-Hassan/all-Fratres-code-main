jQuery(document).ready(function () {


    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).on("click", ".block", function () {
    var id = jQuery(this).attr('data-block');



    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
    });




    jQuery.ajax({
        type: "post",
        url: '/admin/block-seekers/' + id,
        success: function (response) {
            console.log(response.status)
            if (response.status == "active") {

                Toast.fire({
                    icon: 'success',
                    title: 'Seeker is Activated'
                })
                $(function () {
                    setTimeout(function () {
                        window.location.href = "/admin/seekers";

                    }, 1000);
                });

            } else if(response.status == "block") {

                Toast.fire({
                    icon: 'success',
                    title: 'Seeker is Blocked'
                })
                $(function () {
                    setTimeout(function () {
                        window.location.href = "/admin/seekers";

                    }, 1000);
                });
            }
        },
        error: function (response) {

            Toast.fire({
                icon: 'warning',
                title: 'Seeker is not Blocked yet'
            })
            return false;

        }
    });


});
