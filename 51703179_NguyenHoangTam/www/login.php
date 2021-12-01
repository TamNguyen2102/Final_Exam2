<?php

session_start();

// Check if have login, can not accessed to login page
if(isset($_SESSION['isLogin'])){
    header('Location: index.php');
}

if(isset($_POST['submit'])){
    // Connect to database
    require_once('./api/connection.php');

    $sql = "SELECT * from Accounts";
    $result = $conn->query($sql);
    
    // Check value of request from method POST 
    if (!isset($_POST['email']) || !isset($_POST['password'])) {
      die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }
    
    $errorMessage = '';
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        if ($email == $row['Email']) {
          if ($password == $row['Password']) {
            $_SESSION['isLogin'] = $email;

            // Check user type
            $_SESSION['userType'] = 'admin'; 

            // Set cookie when click remember me
            if(isset($_POST['remember'])){
                $hour = time() + 3600 * 24 * 30;
                setcookie('email_remember',$email,$hour);
                setcookie('password_remember',$password,$hour);
            }

            header('Location: ./index.php');
          } else {
            $errorMessage = 'Sai mật khẩu';
          }
        }else{
          $errorMessage = 'Email không tồn tại';
        }
      }
    } else {
      $errorMessage = 'Không tìm thầy dữ liệu tài khoản của bạn';
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="./main.js" defer></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="./style.css" />
    <title>Document</title>
</head>

<body>
    <div class="login-page">
        <!-- The less blue background -->
        <div class="background-filter"></div>
        <div class="container">
            <!-- Navigation -->
            <nav class="navbar">
                <div class="navbar__logo">
                    <img src="./images/LogoSample_ByTailorBrands.jpg" alt="" />
                </div>
                <div class="navbar__menu">
                    <ul>
                        <li>
                            <img src="./images/person-circle.svg" alt="" />

                            <a href="./register.html">Register</a>
                        </li>
                        <li>
                            <img src="./images/key-fill.svg" alt="" />
                            <a href="./index.php">Login</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Section -->
            <section class="main-section">
                <div class="main-section__header">
                    <h1 class="title">Welcome!</h1>
                    <h4 class="sub-title">
                        Use these awesome forms to login or create new account in your
                        project for free.
                    </h4>
                </div>

                <div class="main-section__login">
                    <!-- Form -->
                    <form id="loginForm" class="login__form" action="login.php" method="POST">
                        <h3>Sign in</h3>
                        <div>
                            <div class="login__form__item">
                                <img src="./images/envelope-fill.svg" />
                                <input type="email" placeholder="Email" id="email" name="email" value="<?php if(isset($_COOKIE['email_remember']))
                                        {echo $_COOKIE['email_remember'];}?>" />
                                <span class="focus-border">
                                    <i> </i>
                                </span>
                            </div>
                            <div class="login__form__item">
                                <img src="./images/lock-fill.svg" />
                                <input id="password" type="password" name="password" placeholder="Password" value="<?php if(isset($_COOKIE['password_remember']))
                                        {echo $_COOKIE['password_remember'];}?>" />
                                <span class="focus-border">
                                    <i></i>
                                </span>
                            </div>
                            <div>
                                <input type="checkbox" name="remember" value="" />
                                <label for="">Remember me</label>
                            </div>
                        </div>
                        <div id="loginError" class="errorMessage text-danger">
                            <?php
                                if(isset($errorMessage)){
                                    echo $errorMessage;
                                }            
                            ?>
                        </div>
                        <button class="btn-signin" name="submit" type="submit">Sign in</button>
                    </form>
                </div>
            </section>

            <!-- Footer -->
            <footer class="footer">
                <div>About us</div>
                <div>©2021 Creator: <bold>TamNguyen-VinhKhang-Son</bold>
                </div>
            </footer>
        </div>
    </div>



</body>

</html>