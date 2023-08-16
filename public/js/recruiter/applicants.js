


$(document).on("click", ".interested", function () {

    var value = $(this).attr("data-val");
    var id = $(this).attr("data-id");
    $(this).siblings('.interested').removeClass('active');
    $(this).addClass('active');

    $.ajax({
        url: "/recruiter/applicant/shortlist/"+id+"?status="+value,
        type:'GET',
        processData: false,
        contentType:false,
        success: function(data) {
            console.log(data);
            window.location.reload();
        }
    });

});

$(document).on("change", ".jobs_search_applicant", function () {

    if( $(this).val() != '' ){
        var job_string = $(this).val();
        window.location.href = '/recruiter/applicants/'+job_string;
    }

});

