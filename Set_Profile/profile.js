(function ($) {
    $(document).on('click','#UpLoad',()=>{
        $("#image").click();
    });

    $(document).on('change','#image',()=>{
        const $file = $('#image').prop('files')[0];
        const $type = $file['type'].split('/')[0];
        const $ext = $file['type'].split('/')[1];
        var formData = new FormData();
        formData.append('image',$file);
        console.log($ext.toString().toLowerCase());

        if(($file['size']/(1024*1024) < 5) 
            && ($type == 'image') 
            && ($ext.toString().toLowerCase() == 'jpeg' || $ext.toString().toLowerCase() == 'jpg' || $ext.toString().toLowerCase() == 'png') ){
        
            $.ajax({
                type: "post",
                url: "profile_process.php",
                data: formData,
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: () => {
                    $("#UpLoad").html("<i class='fa fa-spinner rotating fs-4 fw-600'></i>");
                },
                success: (response) => {
                    setTimeout(() => {
                        if(response == '__FAILURE__'){
                            $("#UpLoad").html("<i class='fa fa-times fs-4 fw-600' style='color: red;'></i>");
                        }else{
                            $("#UpLoad").html("<i class='fa fa-check fs-4 fw-600' style='color: green;'></i>");
                            $("#profile_image").attr('src', response);
                        }
                    },2000);
                    setTimeout(() => {
                        $("#UpLoad").html("<i class='fa fa-upload fs-4 fw-600' ></i>");
                    },3500);
                }
            });
        }
    });

    $(document).on('click','#save_btn', ()=>{
        const $email = $("#email").val();
        const $fname = $("#fname").val();
        const $lname = $("#lname").val();
        const $profession = $("#profession").val();
        const $password = $("#password").val();
        const $conf_password = $("#conf_password").val();

        $.ajax({
            type: "post",
            url: "profile_process.php",
            data: {
                email: $email,
                fname: $fname,
                lname: $lname,
                profession: $profession,
                password: $password,
                conf_password: $conf_password
            },
            beforeSend: () => {
                $("#save_btn").html("<i class='fa fa-spinner rotating fs-4 fw-600'></i>");
            },
            success: function (response) {
                console.log(response);
                setTimeout(() => {
                    if(response == "seccuss"){
                        $("#save_btn").html("<i class='fa fa-check fs-4 fw-600' style='color: green !important;'></i>");
                    }else{
                        $("#save_btn").html("<i class='fa fa-times fs-4 fw-600' style='color: red !important;'></i>");

                        if(response == "ERROR_LNAME"){
                            $("#lname").css("background-color","rgb(255 0 0 / 50%)");
                        }else if(response == "ERROR_FNAME"){
                            $("#fname").css("background-color","rgb(255 0 0 / 50%)");
                        }else if(response == "ERROR_PROF"){
                            $("#profession").css("background-color","rgb(255 0 0 / 50%)");
                        }else if(response == "ERROR_FILL"){
                            if($("#lname") == ''){
                                $("#lname").css("background-color","rgb(255 0 0 / 50%)");
                            }else if($("#fname") == ''){
                                $("#fname").css("background-color","rgb(255 0 0 / 50%)");
                            }else if($("#email") == ''){
                                $("#email").css("background-color","rgb(255 0 0 / 50%)");
                            }else{
                                $("#profession").css("background-color","rgb(255 0 0 / 50%)");
                            }
                        }else if(response == "ERROR_EMAIL"){
                            $("#email").css("background-color","rgb(255 0 0 / 50%)");
                        }else if(response == "ERROR_CONF_PASS"){
                            $("#conf_password").css("background-color","rgb(255 0 0 / 50%)");
                            $("#password").css("background-color","rgb(255 0 0 / 50%)");
                        }
                        
                    }
                },2000);

                setTimeout(() => {
                    $("#save_btn").html("SAVE");
                },3500);

                setTimeout(() => {
                    $("#fname").css("background-color","");
                    $("#lname").css("background-color","");
                    $("#email").css("background-color","");
                    $("#profession").css("background-color","");
                    $("#password").css("background-color","");
                    $("#conf_password").css("background-color","");
                }, 4500);
            }
        });

    });

})(jQuery);
