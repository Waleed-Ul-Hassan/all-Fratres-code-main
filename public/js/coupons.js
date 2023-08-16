jQuery(document).ready(function () {


    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
});


function save() {

    var coupon_code = jQuery('#coupon_code').val();
    var start_date = jQuery('#start_date').val();
    var end_date = jQuery('#end_date').val();
    var discount = jQuery('#discount').val();

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
    });


    jQuery.ajax({
        url: "/admin/add-coupons                                                                                               ",
        method: 'post',
        data: {
            coupon_code: coupon_code, start_date: start_date, end_date: end_date, discount: discount
        },

        success: function (response) {
            if (response.status == 1) {

                Toast.fire({
                    icon: 'success',
                    title: 'Added Coupons Successfully'
                })
                $(function () {
                    setTimeout(function () {
                        window.location.href = "/admin/coupons";

                    }, 1000);
                });

            } else {

                Toast.fire({
                    icon: 'warning',
                    title: 'Coupons is not Added Changed yet'
                })
            }
        },
        error: function (response) {

            Toast.fire({
                icon: 'warning',
                title: 'Coupons is Incorrect'
            })
            return false;
        }
    });
}


function update() {

    var coupon_code = jQuery('#coupon_code').val();
    var start_date = jQuery('#start_date').val();
    var end_date = jQuery('#end_date').val();
    var discount = jQuery('#discount').val();
    var id = jQuery('#id').val();

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
    });


    jQuery.ajax({
        url: "/admin/update-coupons                                                                                               ",
        method: 'post',
        data: {
            id: id,
            coupon_code: coupon_code,start_date:start_date,end_date:end_date,discount:discount
        },

        success: function (response) {
            if (response.status == 1) {

                Toast.fire({
                    icon: 'success',
                    title: 'Added Coupons Successfully'
                })
                $(function () {
                    setTimeout(function () {
                        window.location.href = "/admin/coupons";

                    }, 1000);
                });

            } else {

                Toast.fire({
                    icon: 'warning',
                    title: 'Coupons is not Added Changed yet'
                })
            }
        },
        error: function (response) {

            Toast.fire({
                icon: 'warning',
                title: 'Coupons is Incorrect'
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
        url: '/admin/delete-coupons/' + id,
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
                            title: 'Coupons is Deleted'
                        })
                        $(function () {
                            setTimeout(function () {
                                window.location.href = "/admin/coupons";

                            }, 1000);
                        });
                    }
                })


            } else {

                Toast.fire({
                    icon: 'warning',
                    title: 'Coupons is not Deleted yet'
                })
            }
        },
        error: function (response) {

            Toast.fire({
                icon: 'warning',
                title: 'Coupons is not Deleted yet'
            })
            return false;

        }
    });


});