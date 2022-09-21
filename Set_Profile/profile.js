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
})(jQuery);
