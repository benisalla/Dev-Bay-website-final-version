(function ($) {

    $(document).on('click','#save_btn', ()=>{
        const $email = $("#email").val();
        const $fullname = $("#fullname").val();
        const $body = $("#body").val();

        $.ajax({
            type: "post",
            url: "testimonial_code.php",
            data: {
                email: $email,
                fullname: $fullname,
                body: $body,
            },
            beforeSend: () => {
                $("#save_btn").html("<i class='fa fa-spinner rotating fs-4 fw-600'></i>");
            },
            success: function (response) {
                setTimeout(() => {
                    if(response == "seccuss"){
                        $("#save_btn").html("<i class='fa fa-check fs-4 fw-600' style='color: green !important;'></i>");
                    }else{
                        $("#save_btn").html("<i class='fa fa-times fs-4 fw-600' style='color: red !important;'></i>");
                        if(response == "ERROR_FILL"){
                            $("#body").css("background-color","rgb(255 0 0 / 50%)");
                        }
                    }
                },2000);

                setTimeout(() => {
                    $("#save_btn").html("SAVE");
                },3500);

                setTimeout(() => {
                    $("#email").css("background-color","");
                    $("#fullname").css("background-color","");
                    $("#body").css("background-color","");
                }, 4500);
            }
        });

    });

})(jQuery);