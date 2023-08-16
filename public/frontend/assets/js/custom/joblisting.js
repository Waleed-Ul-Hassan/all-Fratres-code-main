
//by saqlain

$(document).on("click", ".save-btn", function () {
    var job_id = $(this).attr("data-jobid");

    var element = $(this);


    $.ajax({
        url: "/save-job?job_id="+job_id,
        type:'GET',
        data: {job_id: job_id},
        processData: false,
        contentType:false,
        success: function(data) {

            var messgae = "Job is removed from saved";
            var icon = "success";
            if(data == 'login'){
                icon = "error";
                messgae = "Please Login to Continue";

            }else{
                element.toggleClass("far fas");
            }
            if(data == 'added'){
                icon = "success";
                messgae = "Job is Saved";

            }

            swal({
                position: 'top-end',
                icon: icon,
                title: messgae,
                showConfirmButton: false,
                timer: 1500
            })

        }
    });
});

//by saqlain end



$(document).ready(function(){
    $("#whattext").focus(function(){
        $('#what').hide();
        $('.what_i path').addClass("whatipath");

    });

    $("#what").click(function(){
        $('#what').hide();
    });

});



$(function() {
    $('.toggle-nav').click(function() {
        // Calling a function in case you want to expand upon this.
        toggleNav();
    });
});


/*========================================
=            CUSTOM FUNCTIONS            =
========================================*/
function toggleNav() {
    if ($('#site-wrapper').hasClass('show-nav')) {
        // Do things on Nav Close
        $('#site-wrapper').removeClass('show-nav');
    } else {
        // Do things on Nav Open
        $('#site-wrapper').addClass('show-nav');
    }

    //$('#site-wrapper').toggleClass('show-nav');
}
$(document).keyup(function(e) {
    if (e.keyCode == 27) {
        if ($('#site-wrapper').hasClass('show-nav')) {
            // Assuming you used the function I made from the demo
            toggleNav();
        }
    }
});

$(document).ready(function(){
    $('.happyemo').hide();
    $('.sademo').hide();
    $('.irr').hide();
    $('.virr').hide();
    $('.vr').hide();
    $('.emo-survey').hide();


    $("#happyimg").mouseover(function(){
        $('.happyemo').show();
    });
    $("#happyimg").mouseout(function(){
        $('.happyemo').hide();
    });

    $("#sadimg").mouseover(function(){
        $('.sademo').show();
    });
    $("#sadimg").mouseout(function(){
        $('.sademo').hide();
    });
    $("#irrelv").mouseover(function(){
        $('.irr').show();
    });
    $("#irrelv").mouseout(function(){
        $('.irr').hide();
    });
    $("#virrelv").mouseover(function(){
        $('.virr').show();
    });
    $("#virrelv").mouseout(function(){
        $('.virr').hide();
    });
    $("#vrelv").mouseover(function(){
        $('.vr').show();
    });
    $("#vrelv").mouseout(function(){
        $('.vr').hide();
    });
    $("#happyimg").click(function(){
        $('.emo-survey').show();
    });

});





