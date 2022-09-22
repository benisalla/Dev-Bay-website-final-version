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
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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



    <?php
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $IP = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $IP = $_SERVER['REMOTE_ADDR'];
    }
    $ipdat = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip='$IP'"));
    $city = $ipdat->geoplugin_regionName;
    $country = $ipdat->geoplugin_countryName;
    $continent = $ipdat->geoplugin_continentName;


    if (!isset($_SESSION['visitor'])) {
        $_SESSION['visitor'] = '1';
        $num_of_visitors = 0;
        $Query = "select * from visitors_counter where visitor_ip = '$IP' and visitor_country = '$country'";
        $Result = mysqli_query($connection, $Query);
        if (mysqli_num_rows($Result) == 0) {
            $insertQuery = "INSERT INTO visitors_counter (visitor_ip, visitor_country,visitor_region , visitor_continent) VALUES ('$IP','$country','$city','$continent')";
            $insertResult = mysqli_query($connection, $insertQuery);
        }
    }
    ?>