(function ($) {
    console.log("jquery is working");
    $(document).on('click','#UpLoad',()=>{
        $("#image").click();
    });

    $(document).on('change','#image',()=>{
        const $file = $('#image').prop('files')[0];
        const $type = $file['type'].split('/')[0];
        const $ext = $file['type'].split('/')[1];
        const $formData = new FormData();
        $formData.append('image',$('#image').prop('files'));
        console.log($formData);


        console.log('before');
        if(($file['size']/(1024*1024) < 5) && ($type == 'image') && ($ext == 'jpg' || $ext == 'png') ){
        
            console.log("after");
            $.ajax({
                type: "post",
                url: "profile_process.php",
                data: $formData,
                contentType: false,
                processData: false,
                beforeSend: () => {
                    $("#UpLoad").html("<i class='fa fa-spinner rotating fs-4 fw-600'></i>");
                },
                success: (response) => {
                    console.log(response)
                    setTimeout(() => {
                        if(response == 'seccuss'){
                            $("#UpLoad").html("<i class='fa fa-check fs-4 fw-600' style='color: green;'></i>");
                            
                        }else{
                            $("#UpLoad").html("<i class='fa fa-times fs-4 fw-600' style='color: red;'></i>");
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
