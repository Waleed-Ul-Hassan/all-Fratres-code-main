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
        url: '/admin/block-jobs/' + id,
        success: function (response) {
            console.log(response.status)
            console.log(response.status)
            if (response.status == "pending" || response.status == "paused" || response.status == "draft" || response.status == "expired") {

                Toast.fire({
                    icon: 'success',
                    title: 'Job is Active'
                })
                $(function () {
                    setTimeout(function () {
                        window.location.href = "/admin/jobs";

                    }, 1000);
                });

            } else if (response.status == "active") {

                Toast.fire({
                    icon: 'success',
                    title: 'Job is Active'
                })
                $(function () {
                    setTimeout(function () {
                        window.location.href = "/admin/jobs";

                    }, 1000);
                });
            } else if (response.status == "pause") {


                Toast.fire({
                    icon: 'success',
                    title: 'Job is pause'
                })
                $(function () {
                    setTimeout(function () {
                        window.location.href = "/admin/jobs";

                    }, 1000);
                });
            }
        },
        error: function (response) {

            Toast.fire({
                icon: 'warning',
                title: 'Recruiter is not Blocked yet'
            })
            return false;

        }
    });


});
$(document).on("click", ".reject", function () {
    var id = jQuery(this).attr('data-reject');


    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
    });

    $(document).on("click", ".rejects", function () {

        if ($('#job_reject_reason').val().length > 0) {
            var text = $('#job_reject_reason').val();

            jQuery.ajax({
                type: "post",
                url: '/admin/reject-jobs/' + id,
                data:{
                    text:text
                },

                success: function (response) {
                    console.log(response.status)


                        Toast.fire({
                            icon: 'success',
                            title: 'Job is Reject'
                        })
                        $(function () {
                            setTimeout(function () {
                                window.location.href = "/admin/jobs";

                            }, 1000);
                        });


                },
                error: function (response) {

                    Toast.fire({
                        icon: 'warning',
                        title: 'Job is not Rejected yet'
                    })
                    return false;

                }
            });

        } else {
            Toast.fire({
                icon: 'success',
                title: 'Job is dfgdfgfgfgdfggdfgdfg'
            })
        }


    });

});
