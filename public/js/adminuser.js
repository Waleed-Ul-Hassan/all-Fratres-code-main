jQuery(document).ready(function () {


    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
});

function login() {

    var email = jQuery('#email').val();
    var password = jQuery('#password').val();

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
    });


    jQuery.ajax({
        url: "/admin/login",
        method: 'post',
        data: {
            email: email,
            password: password,
        },

        success: function (response) {
            if (response == 'success') {
                Toast.fire({
                    icon: 'success',
                    title: 'Logged in Successfully'
                })
                $(function () {
                    setTimeout(function () {
                        window.location.href = "/admin/home";

                    }, 1000);
                });

            } else {
                Toast.fire({
                    icon: 'warning',
                    title: 'Your Email or Password is Incorrect'
                })
                return false;
            }


        },
        error: function (response) {

            Toast.fire({
                icon: 'warning',
                title: 'Your Email or Password is Incorrect'
            })
            return false;
        }
    });
}

function save() {

    var name = jQuery('#name').val();
    var email = jQuery('#email').val();
    var password = jQuery('#password').val();
    var type = jQuery('#type').val();

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
    });


    jQuery.ajax({
        url: "/admin/add-users                                                                                                ",
        method: 'post',
        data: {
            name: name,
            email: email,
            password: password,
            type: type,
        },

        success: function (response) {
            if (response.status == 1) {

                Toast.fire({
                    icon: 'success',
                    title: 'Added User Successfully'
                })
                $(function () {
                    setTimeout(function () {
                        window.location.href = "/admin/users";

                    }, 1000);
                });

            } else {

                Toast.fire({
                    icon: 'warning',
                    title: 'Password is not Changed yet'
                })
            }
        },
        error: function (response) {

            Toast.fire({
                icon: 'warning',
                title: 'Your Email or Password is Incorrect'
            })
            return false;
        }
    });
}


function update() {

    var id = jQuery('#id').val();
    var name = jQuery('#name').val();
    var email = jQuery('#email').val();
    var password = jQuery('#password').val();
    var type = jQuery('#type').val();

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
    });


    jQuery.ajax({
        url: "/admin/update-users                                                                                                ",
        method: 'post',
        data: {
            id: id,
            name: name,
            email: email,
            password: password,
            type: type,
        },

        success: function (response) {
            if (response.status == 1) {

                Toast.fire({
                    icon: 'success',
                    title: 'Updated User Successfully'
                })
                $(function () {
                    setTimeout(function () {
                        window.location.href = "/admin/users";

                    }, 1000);
                });

            } else {

                Toast.fire({
                    icon: 'warning',
                    title: 'User Updated not Changed yet'
                })
            }
        },
        error: function (response) {

            Toast.fire({
                icon: 'warning',
                title: 'User Updated not Changed yet'
            })
            return false;
        }
    });
}


function changePassword() {

    var old_pass = jQuery('#old_pass').val();
    var new_pass = jQuery('#new_pass').val();
    var confirm_pass = jQuery('#confirm_pass').val();

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
    });

    jQuery.ajax({
        url: "/admin/change-password",
        method: 'post',
        data: {
            old_pass: old_pass,
            new_pass: new_pass,
            confirm_pass: confirm_pass,
        },

        success: function (response) {
            if (response.status == 1) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Password Changed Successfully'
                })
                $(function () {
                    setTimeout(function () {
                        window.location.href = "/admin/home";

                    }, 1000);
                });

            } else {

                Toast.fire({
                    icon: 'warning',
                    title: 'Password is not Changed yet'
                })
            }
        },
        error: function (response) {

            Toast.fire({
                icon: 'warning',
                title: 'Password is not Changed yet'
            })
            return false;
        }
    });
}

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
        url: '/admin/block-users/' + id,
        success: function (response) {
            console.log(response)
            if (response.status == 1) {

                Toast.fire({
                    icon: 'success',
                    title: 'User is Blocked'
                })
                $(function () {
                    setTimeout(function () {
                        window.location.href = "/admin/users";

                    }, 1000);
                });

            } else {

                Toast.fire({
                    icon: 'warning',
                    title: 'User is not Blocked yet'
                })
            }
        },
        error: function (response) {

            Toast.fire({
                icon: 'warning',
                title: 'UserPassword is not Blocked yet'
            })
            return false;

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
        url: '/admin/delete-users/' + id,
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
                                window.location.href = "/admin/users";

                            }, 1000);
                        });
                    }
                })


            } else {

                Toast.fire({
                    icon: 'warning',
                    title: 'User is not Blocked yet'
                })
            }
        },
        error: function (response) {

            Toast.fire({
                icon: 'warning',
                title: 'UserPassword is not Blocked yet'
            })
            return false;

        }
    });


});