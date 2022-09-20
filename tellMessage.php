<?php
session_start();
?>

<?php

if (isset($_SESSION['message'])) {
    if ($_SESSION['message']['type'] == 'alert') : ?>
        <div class="fixed-top  message_1 text-center" style="z-index: 9999;margin: 1rem 3rem; text-align: center; width: auto;">
            <div class="alert alert-warning alert-dismissible fade show text-center" style="padding: 1rem 2rem; background-color: #f28f8f; border-radius: 10px;">
                <strong>Oups! </strong> <?= $_SESSION['message']['content'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                document.querySelector('.btn-close').addEventListener('click', () => {
                    document.querySelector('.message_1').style = 'display: none; position: absolute; top: -1000rem;';
                });
            </script>
        </div>
    <?php else : ?>
        <div class="message_2" style="
                z-index: 9999;text-align: center; padding: 1rem 2rem; 
                background-color: #72f49c; border-radius: 10px;
                width: fit-content;height: fit-content;position: fixed;
                top: 2rem;left: 50%;transform: translateX(-50%);
            ">
            <?= $_SESSION['message']['content'] ?>    
        </div>
    <?php endif; ?>
    <script>
        setTimeout(() => {
            document.querySelector('.message_1').style = 'display: none; position: absolute; top: -1000rem;';
        }, 6000);

        setTimeout(() => {
            document.querySelector('.message_2').style = 'display: none; position: absolute; top: -1000rem;';
        }, 1300);
    </script>

<?php
    unset($_SESSION['message']);
}
?>