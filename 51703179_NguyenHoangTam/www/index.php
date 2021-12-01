<?php
  session_start();

  $isAdmin = false;
  if(!isset($_SESSION['isLogin'])){
    header('Location: login.php');
  }else{
      if($_SESSION['userType'] === 'admin'){
          $isAdmin = true;
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
    <link rel="stylesheet" href="./style.css" />
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    <!--===== Sidebar ===== -->
    <div class="sidebar">
        <div class="logo-details">
            <i class="bx bxl-c-plus-plus icon"></i>
            <div class="logo_name">TKSLab</div>
            <i class="bx bx-menu" id="btn"></i>
        </div>

        <!-- Sidebar menu -->
        <ul class="nav-list">
            <li>
                <i class="bx bx-search"></i>
                <input type="text" placeholder="Search..." />
                <span class="tooltip">Search</span>
            </li>
            <?php
                if($isAdmin){
                  echo '
                  <!-- Department -->
                  <li>
                      <a href="#">
                          <i class="bx bx-grid-alt"></i>
                          <span class="links_name">Department</span>
                      </a>
                      <span class="tooltip">Department</span>
                  </li>
                  <!-- Staff management -->
                  <li>
                      <a href="#">
                          <i class="bx bx-street-view"></i>
                          <span class="links_name">Staff management</span>
                      </a>
                      <span class="tooltip">Staff management</span>
                  </li>
                  <!-- Tasks -->
                  <li>
                      <a href="#">
                          <i class="bx bx-task"></i>
                          <span class="links_name">Tasks</span>
                      </a>
                      <span class="tooltip">Tasks</span>
                  </li>
                  <!-- User profile -->
                  <li>
                      <a href="#">
                          <i class="bx bxs-user"></i>
                          <span class="links_name">User profile</span>
                      </a>
                      <span class="tooltip">User profile</span>
                  </li>
                  ';
                }else{
                    echo '
                    <!-- User profile -->
                    <li>
                        <a href="#">
                            <i class="bx bxs-user"></i>
                            <span class="links_name">User profile</span>
                        </a>
                        <span class="tooltip">User profile</span>
                    </li>
                    ';
                }
            ?>


            <!-- Bottom of sidebar -->
            <li class="profile">
                <div class="profile-details">
                    <img src="./images/profile-cover.jpg" alt="profileImg" />
                    <div class="name_job">
                        <div class="name">Tam Nguyen</div>
                        <div class="job">Web developer</div>
                    </div>
                </div>
                <!-- Log out  -->
                <form id="logOutForm" action="./api/logout.php" method="POST">
                    <button name="isLoggedOut" class="bx bx-log-out" id="log_out"></button>
                </form>

            </li>
        </ul>
    </div>

    <!--====== Main section ===== -->
    <section class="home-section">
        <!-- User Profile -->
        <div class="user-profile">
            <div class="profile-cover"></div>
            <div class="user-profile__wrapper">
                <!-- Navigation of user profile -->
                <nav class="navbar">
                    <div>USER PROFILE</div>
                    <div>Hello Tam Nguyen</div>
                </nav>

                <!-- Introduction -->
                <article class="introduction">
                    <h1 class="title">Hello Tam Nguyen</h1>
                    <p class="text">
                        This is your profile page. You can see the progress you've made
                        with your work and manage your projects or assigned tasks
                    </p>
                    <button>Edit profile</button>
                </article>

                <div class="main-section">
                    <div class="user-info-aside">
                        <img src="./images/profile-cover.jpg" alt="" />
                        <div class="first-info">
                            <div>
                                <i class="bx bxs-user-badge"></i>
                                <div class="label">Gender:</div>
                                <div class="gender">Male</div>
                            </div>

                            <div>
                                <i class="bx bxs-directions"></i>
                                <div class="label">Position:</div>
                                <div class="position">Staff</div>
                            </div>
                        </div>
                        <div class="second-info">
                            <div class="name">Nguyen Hoang Tam</div>
                        </div>
                        <div class="third-info">
                            <div>
                                <div class="label">Phone:</div>
                                <div class="phone">0929657825</div>
                            </div>
                            <button>Contact me</button>
                        </div>
                    </div>
                    <div class="user-task-aside">Task</div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>