(function ($) {
    $(document).on('click','#log_in_btn', ()=>{
        var $email = $('#log_in_email').val();
        var $password = $("#log_in_password").val();

        $.ajax({
            type: "post",
            url: "loginProcess.php",
            data: {
                email: $email,
                password: $password
            },
            beforeSend:function(){
                $("#send_request").html("<i class='fa fa-spinner rotating fs-2 fw-600'></i>");
            },
            success: function (response) {
                setTimeout(function() {
                    if(response == 'seccuss'){
                        $("#send_request").html("<i class='fa fa-check fs-2 fw-600' style='color: green;'></i>");
                    }else{
                        $("#send_request").html("<i class='fa fa-times fs-2 fw-600' style='color: red;'></i>");
                    }
                },2000);
                setTimeout(function() {
                    $("#send_request").html("Send");
                },3400);
            }
        });
        
    });

})(jQuery);



