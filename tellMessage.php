<?php
    session_start();
    if(isset($_SESSION['message'])){
        ?>
        <div class="fixed-top container message">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Hey ! </strong> <?= $_SESSION['message'] ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                document.querySelector('.btn-close').addEventListener('click' ,() =>{
                    document.querySelector('.message').style = 'display: none';
                });
            </script>
        </div>
        <?php
        unset($_SESSION['message']);
    }
?>