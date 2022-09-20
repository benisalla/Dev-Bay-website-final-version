(function ($) {
    $(document).on('click','#log_in_btn', ()=>{
        var $email = $('#log_in_email').val();
        var $password = $("#log_in_password").val();
        var $rememberme = $("#remember-me").val();

        console.log("email => "+$email);
        console.log("password => "+$password);
        console.log("rememberme => "+$rememberme);

        $.ajax({
            type: "post",
            url: "loginProcess.php",
            data: {
                email: $email,
                password: $password,
                rememberme: $rememberme
            },
            beforeSend:function(){
                $("#log_in_btn").html("<i class='rotating zmdi zmdi-spinner fs-1 fw-800 my-1' style='color: white;'></i>");
            },
            success: function (response) {
                setTimeout(function() {
                    if(response == 'seccuss-admin'){
                        $("#log_in_btn").html("<i class='zmdi zmdi-check fs-1 fw-800 my-1' style='color: green;'></i>");
                        setTimeout(() => {
                            $(window).attr('location','./admin/index.php');
                        }, 1400);
                    }else if(response == 'seccuss-user'){
                        $("#log_in_btn").html("<i class='zmdi zmdi-check fs-1 fw-800 my-1' style='color: green;'></i>");
                        setTimeout(() => {
                            $(window).attr('location','./index.php');
                        }, 1400);
                    }else{
                        $("#log_in_btn").html("<i class='zmdi zmdi-close fs-1 fw-800 my-1' style='color: red;'></i>");
                        setTimeout(function() {
                            $("#log_in_btn").html("Log in");
                        },1400);
                    }
                },2000);
                
            }
        });
        
    });

})(jQuery);



