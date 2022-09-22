<?php
    session_start();
    include('./admin/config/databaseConfig.php');

    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['rememberme'])){

        $Email = mysqli_real_escape_string($connection ,$_POST['email']);
        $Pass = mysqli_real_escape_string($connection ,$_POST['password']);
        $rememberme = $_POST['rememberme'];


        if($Email === '' || $Pass === ''){
            echo "failure";
            exit(0);
        }


        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            echo "failure";
            exit(0);
        }

        $encPass = crypt($Pass,"dev-bay");

        $Query = "select * from users where email = '$Email' and password = '$encPass'";
        $Result = mysqli_query($connection, $Query);

        if(mysqli_num_rows($Result) > 0){

            if($rememberme == "on"){
                setcookie("log-in-email",$Email,time()+(60*60*24));
                setcookie("log-in-password",$Pass,time()+(60*60*24));
            }else{
                if(isset($_COOKIE['log-in-email'])){
                    unset($_COOKIE['log-in-email']);
                    setcookie("log-in-email",'',time()-3600);
                }
                if(isset($_COOKIE['log-in-password'])){
                    unset($_COOKIE['log-in-password']);
                    setcookie("log-in-password",'',time()-3600);
                }
            }

            $user = null;
            foreach($Result as $data){
                $user = $data;
            }
            $_SESSION['user_auth'] = true; 
            $_SESSION['user_Role'] = $user["role_as"];
            $_SESSION['user'] = [
                'name' => $user['firstname']." ".$user['lastname'],
                'firstname' => $user['firstname'],
                'lastname' => $user['lastname'],
                'id' => $user['id'],
                'email' => $user['email'],
                'image' => $user['image'],
            ];

            if($_SESSION['user_Role'] == '1'){
                $_SESSION['message'] = [
                    'content' => "Welcome To DashBoard :)",
                    'type' => 'seccuss',
                ];
                echo "seccuss-admin";
                exit(0);
            }elseif($_SESSION['user_Role'] == '0'){
                $_SESSION['message'] = [
                    'content' => "You Are Loged in Seccussfully :)",
                    'type' => 'seccuss',
                ];
                echo "seccuss-user";
                exit(0);
            }else{
                echo "failure";
                exit(0);
            }

        }else{
            $_SESSION['message'] = [
                'content' => "email or password is incorrect :)",
                'type' => 'alert',
            ];
            echo "failure";
            exit(0);
        }

    }else{
        echo "<script type='text/javascript'>  window.location='./Errors/404.php'; </script>";
        exit(0);
    }

?>