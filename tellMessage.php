<?php
    session_start();
    if(isset($_SESSION['message'])){
        ?>
        <div class="fixed-top container message text-center" style="z-index: 9999;">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Oups !! </strong> <?= $_SESSION['message'] ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                document.querySelector('.btn-close').addEventListener('click' ,() =>{
                    document.querySelector('.message').style = 'display: none; position: absolute; top: -1000rem;';
                });
                setTimeout(()=>{
                    document.querySelector('.message').style = 'display: none; position: absolute; top: -1000rem;';
                },2000);
            </script>
        </div>
        <?php
        unset($_SESSION['message']);
    }
?>