$(document).ready(function () {

    $('#workexpfratres , #projectsratres , #edu_jobeefratresmain , #certificationfratres').on('shown.bs.modal', function () {
        $('.errors').html('')
    })

    $(document).on("click",".save_account_info", function () {

        var form = $('#update-account')[0];
        console.log(form);

        $.ajax({
            url: "/seeker/cv-maker/update_account",
            type:'POST',
            data: new FormData(form),
            processData: false,
            contentType:false,
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){

                    $(".print-error-msg").css('display','none');
                    $(".print-success-msg").css('display','block');
                    $(".success-para").html(data.success);
                    location.reload();
                }else{
                    console.log(data);
                    printErrorMsg(data.error);

                }
            }
        });

    });

    $(document).on("click",".save_summary", function () {

        tinyMCE.triggerSave();
        var form = $('#update-summary')[0];
        console.log(form);

        $.ajax({
            url: "/seeker/cv-maker/update_account",
            type:'POST',
            data: new FormData(form),
            processData: false,
            contentType:false,
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){

                    $(".print-error-msg").css('display','none');
                    $(".print-success-msg").css('display','block');
                    $(".success-para").html(data.success);
                    location.reload();
                }else{
                    console.log(data);
                    printErrorMsg(data.error);

                }
            }
        });

    });

    $(document).on("click",".save_experience", function () {

        tinyMCE.triggerSave();
        var form = $('#save_experience')[0];
        console.log(form);

        $.ajax({
            url: "/seeker/cv-maker/save_experience",
            type:'POST',
            data: new FormData(form),
            processData: false,
            contentType:false,
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){

                    $(".print-error-msg").css('display','none');
                    $(".print-success-msg").css('display','block');
                    $(".success-para").html(data.success);
                    location.reload();
                }else{
                    console.log(data);
                    printErrorMsg(data.error);

                }
            }
        });

    });

    $(document).on("click",".edit_experience", function () {

        var experience_id = $(this).attr("data-id");

        $.ajax({
            url: "/seeker/cv-maker/get_experience/"+experience_id,
            type:'GET',
            processData: false,
            contentType:false,
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){

                    $("input[name=job_title]").val(data.job_title);
                    $("input[name=company]").val(data.company);
                    $("input[name=reference_email]").val(data.reference_email);
                    $("input[name=reference_number]").val(data.reference_number);
                    $("input[name=date_start]").val(data.date_start);
                    $("input[name=date_end]").val(data.date_end);
                    $("input[name=job_city]").val(data.job_city);
                    $("input[name=job_country]").val(data.job_country);
                    tinyMCE.get('description_experience').setContent(data.description);
                    $(".experience_id").val(data.id);

                }else{
                    console.log(data);
                    printErrorMsg(data.error);

                }
            }
        });

    });

    $('#workexpfratres').on('hidden.bs.modal', function () {
        $(".experience_id").val('');
        $('#save_experience').trigger("reset");

    });

    $(document).on("click",".save_project", function () {

        var projectIS = $(this);
        projectIS.attr("disabled", true);
        tinyMCE.triggerSave();
        var form = $('#save_project')[0];
        // console.log(form);


        $.ajax({
            url: "/seeker/cv-maker/save_project",
            type:'POST',
            data: new FormData(form),
            processData: false,
            contentType:false,
            success: function(data) {
                // console.log(data);
                if($.isEmptyObject(data.error)){

                    $('#save_project').trigger("reset");
                    $("#projectsratres").modal('hide');
                    $(this).attr("disabled", false);

                    $(".print-error-msg").css('display','none');
                    $(".print-success-msg").css('display','block');
                    $(".success-para").html(data.success);
                    location.reload();
                }else{
                    projectIS.attr("disabled", false);
                    // console.log(data);
                    printErrorMsg(data.error);

                }
            }
        });

    });

    $(document).on("click",".edit_project", function () {

        var project_id = $(this).attr("data-id");

        $.ajax({
            url: "/seeker/cv-maker/get_project/"+project_id,
            type:'GET',
            processData: false,
            contentType:false,
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){

                    $("input[name=project_title]").val(data.project_title);
                    $("input[name=company]").val(data.company);
                    $("input[name=project_url]").val(data.project_url);
                    $("input[name=client_name]").val(data.client_name);
                    $("input[name=date_start]").val(data.date_start);
                    $("input[name=date_end]").val(data.date_end);
                    $("input[name=client_url]").val(data.client_url);

                    tinyMCE.get('description_project').setContent(data.description);
                    $(".project_id").val(data.id);

                }else{
                    console.log(data);
                    printErrorMsg(data.error);

                }
            }
        });

    });

    $('#projectsratres').on('hidden.bs.modal', function () {
        $(".project_id").val('');
        $('#save_project').trigger("reset");
    });


    //certification
$(document).on("click",".save_certification", function () {

        tinyMCE.triggerSave();
        var form = $('#save_certification')[0];
        console.log(form);

        $.ajax({
            url: "/seeker/cv-maker/save_certification",
            type:'POST',
            data: new FormData(form),
            processData: false,
            contentType:false,
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){

                    $(".print-error-msg").css('display','none');
                    $(".print-success-msg").css('display','block');
                    $(".success-para").html(data.success);
                    location.reload();
                }else{
                    console.log(data);
                    printErrorMsg(data.error);

                }
            }
        });

    });

    $(document).on("click",".edit_certification", function () {

        var certification_id = $(this).attr("data-id");
        $(".certification_id").val(certification_id);


        $.ajax({
            url: "/seeker/cv-maker/get_certification/"+certification_id,
            type:'GET',
            processData: false,
            contentType:false,
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){

                    $("input[name=certification_name]").val(data.certification_name);
                    $("input[name=license_number]").val(data.license_number);
                    $("input[name=certification_authority]").val(data.certification_authority);
                    $("input[name=certification_url]").val(data.certification_url);
                    $("input[name=completion_date]").val(data.completion_date);
                    $("input[name=end_date]").val(data.end_date);


                }else{
                    console.log(data);
                    printErrorMsg(data.error);

                }
            }
        });

    });

    $('#projectsratres').on('hidden.bs.modal', function () {
        $(".certification_id").val('');
        $('#save_certification').trigger("reset");
    });


//delete experience

    $(document).on("click",".delete-experience", function (e) {
        e.preventDefault();
        var result = confirm("You want to delete this record? This will not be able to recover in future");
        if (result) {
        var record_id = $(this).attr("data-id");
        $.ajax({
            url: "/seeker/cv-maker/delete_experience/"+record_id,
            type:'GET',
            processData: false,
            contentType:false,
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){
                        location.reload();
                }else{
                    alert(data.error);
                }
            }
        });
        }
    });

    //delete Project

    $(document).on("click",".delete-project", function (e) {
        e.preventDefault();
        var result = confirm("You want to delete this record? This will not be able to recover in future");
        if (result) {
        var record_id = $(this).attr("data-id");
        $.ajax({
            url: "/seeker/cv-maker/delete_project/"+record_id,
            type:'GET',
            processData: false,
            contentType:false,
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){
                        location.reload();
                }else{
                    alert(data.error);
                }
            }
        });
        }
    });

    //delete Certification

    $(document).on("click",".delete-certification", function (e) {
        e.preventDefault();
        var result = confirm("You want to delete this record? This will not be able to recover in future");
        if (result) {
        var record_id = $(this).attr("data-id");
        $.ajax({
            url: "/seeker/cv-maker/delete_certification/"+record_id,
            type:'GET',
            processData: false,
            contentType:false,
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){
                        location.reload();
                }else{
                    alert(data.error);
                }
            }
        });
        }
    });


    $(document).on("click",".save_skills", function () {

        // tinyMCE.triggerSave();
        var form = $('#save_skills')[0];
        console.log(form);

        $.ajax({
            url: "/seeker/cv-maker/save_skills",
            type:'POST',
            data: new FormData(form),
            processData: false,
            contentType:false,
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){

                    $(".print-error-msg").css('display','none');
                    $(".print-success-msg").css('display','block');
                    $(".success-para").html(data.success);
                    location.reload();
                }else{
                    console.log(data);
                    printErrorMsg(data.error);

                }
            }
        });

    });

    $(document).on("click",".save_hobbies", function () {

        tinyMCE.triggerSave();
        var form = $('#save_hobbies')[0];
        console.log(form);

        $.ajax({
            url: "/seeker/cv-maker/save_hobbies",
            type:'POST',
            data: new FormData(form),
            processData: false,
            contentType:false,
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){

                    $(".print-error-msg").css('display','none');
                    $(".print-success-msg").css('display','block');
                    $(".success-para").html(data.success);
                    location.reload();
                }else{
                    console.log(data);
                    printErrorMsg(data.error);

                }
            }
        });

    });

    $(document).on("click",".save_language", function () {

        tinyMCE.triggerSave();
        var form = $('#save_language')[0];
        console.log(form);

        $.ajax({
            url: "/seeker/cv-maker/save_language",
            type:'POST',
            data: new FormData(form),
            processData: false,
            contentType:false,
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){

                    $(".print-error-msg").css('display','none');
                    $(".print-success-msg").css('display','block');
                    $(".success-para").html(data.success);
                    location.reload();
                }else{
                    console.log(data);
                    printErrorMsg(data.error);

                }
            }
        });

    });

    $(document).on("click",".save_reference", function () {

        tinyMCE.triggerSave();
        var form = $('#save_reference')[0];
        console.log(form);

        $.ajax({
            url: "/seeker/cv-maker/save_reference",
            type:'POST',
            data: new FormData(form),
            processData: false,
            contentType:false,
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){

                    $(".print-error-msg").css('display','none');
                    $(".print-success-msg").css('display','block');
                    $(".success-para").html(data.success);
                    location.reload();
                }else{
                    console.log(data);
                    printErrorMsg(data.error);

                }
            }
        });

    });


    $(document).on("click",".delete-referece", function (e) {
        e.preventDefault();
        var result = confirm("You want to delete this record? This will not be able to recover in future");
        if (result) {
            var record_id = $(this).attr("data-id");
            $.ajax({
                url: "/seeker/cv-maker/delete_reference/"+record_id,
                type:'GET',
                processData: false,
                contentType:false,
                success: function(data) {
                    console.log(data);
                    if($.isEmptyObject(data.error)){
                        location.reload();
                    }else{
                        alert(data.error);
                    }
                }
            });
        }
    });

    $(document).on("change",".seeking_job", function (e) {
        e.preventDefault();
        var value = $(this).val();
        $.ajax({
            url: "/seeker/cv-maker/seeking_job/",
            type:'GET',
            processData: false,
            contentType:false,
            success: function(data) {

            }
        });

    });

    
    //education
    //certification
    $(document).on("click",".save_education", function () {

        tinyMCE.triggerSave();
        var form = $('#save_education')[0];
        console.log(form);

        $.ajax({
            url: "/seeker/cv-maker/save_education",
            type:'POST',
            data: new FormData(form),
            processData: false,
            contentType:false,
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){

                    $(".print-error-msg").css('display','none');
                    $(".print-success-msg").css('display','block');
                    $(".success-para").html(data.success);
                    location.reload();
                }else{
                    console.log(data);
                    printErrorMsg(data.error);

                }
            }
        });

    });

    $(document).on("click",".edit_education", function () {

        var education_id = $(this).attr("data-id");
        $(".education_id").val(education_id);

        $.ajax({
            url: "/seeker/cv-maker/get_education/"+education_id,
            type:'GET',
            processData: false,
            contentType:false,
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){

                    $("input[name=school]").val(data.school);
                    $("input[name=degree]").val(data.degree);
                    $("input[name=grade]").val(data.grade);
                    $("input[name=location]").val(data.location);
                    $("input[name=study_field]").val(data.study_field);
                    $("#year").val(data.year);


                }else{
                    console.log(data);
                    printErrorMsg(data.error);

                }
            }
        });

    });

    $(document).on("click",".delete-education", function (e) {
        e.preventDefault();
        var result = confirm("You want to delete this record? This will not be able to recover in future");
        if (result) {
            var record_id = $(this).attr("data-id");
            $.ajax({
                url: "/seeker/cv-maker/delete_education/"+record_id,
                type:'GET',
                processData: false,
                contentType:false,
                success: function(data) {
                    console.log(data);
                    if($.isEmptyObject(data.error)){
                        location.reload();
                    }else{
                        alert(data.error);
                    }
                }
            });
        }
    });

    $(document).on("click",".check_availability", function () {
        var input_val = $(".username_input").val();
        var input_val = convertToSlug(input_val);
        $.ajax({
            url: "/seeker/cv-maker/check-availability/"+input_val,
            type:'GET',
            processData: false,
            contentType:false,
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){

                    $(".print-error-msg").css('display','none');
                    $(".print-success-msg").css('display','block');
                    $(".success-para").html(data.success);
                    location.reload();

                }else{
                    console.log(data);
                    $(".print-error-msg").css('display','block');
                    $(".print-success-msg").css('display','none');
                    $(".error-para").html(data.error);

                }
            }
        });

    });

    $(document).on("keyup",".username_input", function () {
        var input_val = $(this).val();
        $(".username").html(convertToSlug(input_val));

    });

function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-success-msg").css('display','none');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
}

});