<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dev-Bay company</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="dev_bay website" name="description">
    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="main">
    <script src="//code.tidio.co/vk6fbhcuql50xchuyw2vy7gzt9hhxixo.js" async></script>
    <!---------------------------------- message --------------------------------------->
    <?php include('./tellMessage.php'); ?>
    
    <!----------------------------------- Spinner Start ----------------------------------->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner"></div>
    </div>

    <!------------------------------------- Topbar Start ---------------------------------------->
    <?php include('./includes/navBar-top.php'); ?>

    <!----------------------------- NavBar and Carousel Start ------------------------------->
    <div class=" position-relative p-0 ">
        <!---------------------------- navbar ------------------------------->
        <?php include('./includes/navBar.php'); ?>
        <!---------------------------- Carousel ----------------------------->
        <?php include('./includes/carousel.php'); ?>
    </div>




