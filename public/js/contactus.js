jQuery(document).ready(function () {


    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).on("click", ".delete", function () {
    var id = jQuery(this).attr('data-delete');



    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
    });




    jQuery.ajax({
        type: "post",
        url: '/admin/delete-contact-us/' + id,
        success: function (response) {
            console.log(response)
            if (response.status == 1) {

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Message is Deleted'
                        })
                        $(function () {
                            setTimeout(function () {
                                window.location.href = "/admin/contact-us";

                            }, 1000);
                        });
                    }
                })


            } else {

                Toast.fire({
                    icon: 'warning',
                    title: 'Message is not Deleted yet'
                })
            }
        },
        error: function (response) {

            Toast.fire({
                icon: 'warning',
                title: 'Message is not Deleted yet'
            })
            return false;

        }
    });


});