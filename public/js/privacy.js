jQuery(document).ready(function () {


    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
});


function save() {

    var privacy = jQuery('#privacy').val();
    var terms = jQuery('#terms').val();
    var about = jQuery('#about').val();

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
    });


    jQuery.ajax({
        url: "/admin/add-pages                                                                                               ",
        method: 'post',
        data: {
            privacy: privacy,
            terms:terms,
            about:about
        },

        success: function (response) {
            if (response.status == 1) {

                Toast.fire({
                    icon: 'success',
                    title: 'Added Privacy Successfully'
                })
                $(function () {
                    setTimeout(function () {
                        window.location.href = "/admin/pages";

                    }, 1000);
                });

            } else {

                Toast.fire({
                    icon: 'warning',
                    title: 'Privacy is not Added yet'
                })
            }
        },
        error: function (response) {

            Toast.fire({
                icon: 'warning',
                title: 'Privacy is Incorrect'
            })
            return false;
        }
    });
}


function update() {

    var privacy = jQuery('#privacy').val();
    var terms = jQuery('#terms').val();
    var about = jQuery('#about').val();
    var id = jQuery('#id').val();


    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
    });


    jQuery.ajax({
        url: "/admin/update-pages                                                                                               ",
        method: 'post',
        data: {
            id:id,
            privacy: privacy,
            terms:terms,
            about:about
        },

        success: function (response) {
            if (response.status == 1) {

                Toast.fire({
                    icon: 'success',
                    title: 'Added Privacy Successfully'
                })
                $(function () {
                    setTimeout(function () {
                        window.location.href = "/admin/pages";

                    }, 1000);
                });

            } else {

                Toast.fire({
                    icon: 'warning',
                    title: 'Privacy is not Added yet'
                })
            }
        },
        error: function (response) {

            Toast.fire({
                icon: 'warning',
                title: 'Privacy is Incorrect'
            })
            return false;
        }
    });
}
