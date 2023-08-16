jQuery(document).ready(function () {


    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
});


function save() {

    var name = jQuery('#name').val();

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
    });


    jQuery.ajax({
        url: "/admin/add-package-feature                                                                                               ",
        method: 'post',
        data: {
            name: name,
        },

        success: function (response) {
            if (response.status == 1) {

                Toast.fire({
                    icon: 'success',
                    title: 'Added Package Successfully'
                })
                $(function () {
                    setTimeout(function () {
                        window.location.href = "/admin/package-feature";

                    }, 1000);
                });

            } else {

                Toast.fire({
                    icon: 'warning',
                    title: 'Packages is not Added Changed yet'
                })
            }
        },
        error: function (response) {

            Toast.fire({
                icon: 'warning',
                title: 'Packages is Incorrect'
            })
            return false;
        }
    });
}


function update() {

    var name = jQuery('#name').val();
    var id = jQuery('#id').val();

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
    });


    jQuery.ajax({
        url: "/admin/update-package-feature                                                                                               ",
        method: 'post',
        data: {
            id:id,
            name: name,
        },

        success: function (response) {
            if (response.status == 1) {

                Toast.fire({
                    icon: 'success',
                    title: 'Added Packages Successfully'
                })
                $(function () {
                    setTimeout(function () {
                        window.location.href = "/admin/package-feature";

                    }, 1000);
                });

            } else {

                Toast.fire({
                    icon: 'warning',
                    title: 'Packages is not Added Changed yet'
                })
            }
        },
        error: function (response) {

            Toast.fire({
                icon: 'warning',
                title: 'Packages is Incorrect'
            })
            return false;
        }
    });
}

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
        url: '/admin/delete-package-feature/' + id,
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
                            title: 'User is Deleted'
                        })
                        $(function () {
                            setTimeout(function () {
                                window.location.href = "/admin/package-feature";

                            }, 1000);
                        });
                    }
                })


            } else {

                Toast.fire({
                    icon: 'warning',
                    title: 'Packages is not Blocked yet'
                })
            }
        },
        error: function (response) {

            Toast.fire({
                icon: 'warning',
                title: 'Package is not Blocked yet'
            })
            return false;

        }
    });


});