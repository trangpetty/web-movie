<?php 
  require './configuration/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/bootstrap-5.2.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/tailwind.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.2.0-web/css/all.min.css">
    <title>Disney Princess</title>
</head>
<body>
    
    <section class="position-relative">
        <nav class="navbar w-100 navbar-expand-sm position-absolute d-flex justify-content-between" id="navbar">
            <a class="navbar-brand ps-2 pt-3" style="max-width:15%;" href="index.php">
                <img src="../assets/img/logo.png" alt="">
            </a>
            <div class="text-white d-flex">
                <div class="select-language">
                    <i class="fa-solid fa-globe icon-select"></i>
                    <select name="language" id="select">
                        <option value="english" class="text-dark">English</option>
                        <option value="english" class="text-dark">VietNam</option>
                    </select>
                </div>
                <?php 
                  session_start();
                  ob_start();
                  if(isset($_SESSION['email'])) {
                    echo "<a href='logout.php' id='sign-in' class='btn text-white' style='background-color: #e50914;font-weight:400;border-radius:3px;'>
                              Logout
                              <i class='fas fa-right-to-bracket'></i>
                          </a>";
                  }
                  else {
                    echo "<a href='sign-in.php' id='sign-in' class='btn text-white' style='background-color: #e50914;font-weight:400;border-radius:3px;'>
                              Sign In
                          </a>";
                  }
                  $email_err = '';
                  if(isset($_POST['add_email'])) {
                    $input_email = $_POST['email_signup'];
                    if(empty($input_email)) {
                      $email_err = "Please enter account's email!!!";
                    }   else {
                        $_SESSION['email_signup'] = $input_email;
                        header('Location: signup.php');
                    }
                  }
                ?>
            </div>
        </nav>
        <div>
            <img src="../assets/img/header.jpg" alt="" id="img-header">
            <div class="bg"></div>
        </div>
        <div class="text-center" id="text-header">
            <p class="text-desc-header mx-auto">Unlimited movies, shows, and more of Disney.</p>
            <p class="text-under-header" style="font-weight:400;">Watch anywhere. Cancle anytime.</p>
            <p class="text-welcome">Ready to watch? Enter your email to create or restart your membership.</p>
              <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method='post'>
                <div class="form-email d-flex justify-content-center">
                    <div class="position-relative">
                        <input type="email" class="input-email" name="email_signup">
                        <label for="email" class="label-input">Email address</label>                        
                    </div>
                    <button class="add-btn">
                      <input type="submit" name='add_email' value='Get started' class='w-100'>
                        <span class="chervon-icon"><i class="fas fa-chevron-right"></i></span>
                    </button>                    
                </div>
            </form>
            <p style='color:#e87c03;'><?php echo $email_err; ?></p>
        </div>
        

    </section>
</body>
</html>

    <!--  -->
    <div style="background-color:#f1f2f3;" id="about">
      <?php 
          if(isset($_SESSION['email'])){
            echo "<a href='movies.php' class='mb-2 btn btn-dark'>More Movies
            <i class='fas fa-caret-right'></i></a>";
          }else {
            echo "<a href='sign-in.php' class='mb-2 btn btn-dark'>More Movies
            <i class='fas fa-caret-right'></i></a>";
          }                      
      ?>
      <div class="row">
      <?php 
          $sql = "SELECT id, name, image from movie ORDER BY id ASC limit 4;";
          if($connect != null) {
            try {
                  $statement = $connect->prepare($sql);
                  $statement->execute();
                  $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
                  $movies = $statement->fetchAll();
                  foreach($movies as $movie) {
                    $name = $movie['name'] ?? '';
                    $image = $movie['image'] ?? '';
                    $id = $movie['id'] ?? '';
                    echo "<div class='col bg-white mx-2 p-0'>";
                    echo "<img src=".$image." alt=".$name." class='w-100'>
                        <div class='text-poster'>
                          <p class='h5'>$name</p>
                          <p class='mb-2'>Coming soon on 22th September 2022.</p>";
                          if(isset($_SESSION['email'])){
                            echo "<a href='watch.php?id=".$id."' class='h6' style='text-decoration:underline;'>";
                          }else {
                            echo "<a href='sign-in.php'  class='h6' style='text-decoration:underline;'>";                      
                          }
                          echo "<b>STREAM NOW</b></a>
                        </div>
                      </div>";
                  }
            } catch (PDOException $e) {
              echo "Cannot query data. Error: " . $e->getMessage();
            }
          }
      ?>
        
      </div>
    </div>
<!--  -->
    <div style="background-color: #0A193C;" class="text-center text-white trending">
      <h1 style="font-size: 32px;font-weight:400;" class="mb-5">Trending on Disney</h1>
      <div class="row">
          <div class="col">
            <?php 
                    if(isset($_SESSION['email'])){
                      echo "<a href='movies.php'>";
                    }else {
                      echo "<a href='sign-in.php'>";
                    }                      
            ?>
              <img src="../assets/img/super.jpeg" alt="" class="w-100">
              <div class="py-3 px-2">
                <p class="mt-3 mb-2 h5">New on Disney</p>
                <p class="px-4 mb-3">Experience the natural world as never before in <i>Super/Natural</i>, from James Cameron and narrateed by Benedict Cumberbatch, now streaming on Disney.</p>
                <?php 
                    if(isset($_SESSION['email'])){
                      echo "<a href='movies.php' style='text-decoration:underline;font-size:14px;'>";
                    }else {
                      echo "<a href='sign-in.php' style='text-decoration:underline;font-size:14px;'>";
                    }                      
                ?><b>STREAM NOW</b></a>
              </div>
            </a>
          </div>
          <div class="col">
                  <?php 
                    if(isset($_SESSION['email'])){
                      echo "<a href='movies.php'>";
                    }else {
                      echo "<a href='sign-in.php'>";
                    }                      
                  ?>
              <img src="../assets/img/thor.jpeg" alt="" class="w-100">
              <div class="py-3 px-2">
                <p class="mt-3 mb-2 h5"><i>Marvel Studio's Thor: Love ad Thunder</i></p>
                <p class="px-4 mb-3">Watch Thor's latest adventure in IMAX Enhanced Expanded Aspect Ratio! Subscription required. ©2022 MARVEL</p>
                <?php 
                    if(isset($_SESSION['email'])){
                      echo "<a href='movies.php' style='text-decoration:underline;font-size:14px;'>";
                    }else {
                      echo "<a href='sign-in.php' style='text-decoration:underline;font-size:14px;'>";
                    }                      
                  ?>
                <b>STREAM NOW</b></a>
              </div>
            </a>
          </div>
        </div>
      </div>
      
    </div>

    <!--  -->
    <div class="more-movie">
      <p style="font-size:32px;" class="mb-5 text-center">Hispanic and Latin American Stories on Disney</p>
      <div class="row">
    <?php 
          $sql = "SELECT id, name, image from movie ORDER BY id ASC limit 5,5;";
          if($connect != null) {
            try {
                  $statement = $connect->prepare($sql);
                  $statement->execute();
                  $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
                  $movies = $statement->fetchAll();
                  foreach($movies as $movie) {
                    $name = $movie['name'] ?? '';
                    $image = $movie['image'] ?? '';
                    $id = $movie['id'] ?? '';
                    echo "<div class='col'>";
                    if(isset($_SESSION['email'])){
                      echo "<a href='watch.php?id=".$id."'>";
                    }else {
                      echo "<a href='sign-in.php'>";                      
                    }
                        echo "<img src=".$image." alt=".$name." class='rounded touch'>
                              <p class='mt-2 movie-name'>$name</p>
                            </a>
                          </div>";
                  }
            } catch (PDOException $e) {
              echo "Cannot query data. Error: " . $e->getMessage();
            }
          }
      ?>
      </div>
    </div>
    <!-- COMING SOON -->
    <div class="coming-soon">
      <p style="font-size:32px;" class="mb-4 text-center">Coming Soon to Disney</p>
      <div class="row">
      <?php 
          $sql = "SELECT id, name, image from movie ORDER BY id DESC limit 5;";
          if($connect != null) {
            try {
                  $statement = $connect->prepare($sql);
                  $statement->execute();
                  $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
                  $movies = $statement->fetchAll();
                  foreach($movies as $movie) {
                    $name = $movie['name'] ?? '';
                    $image = $movie['image'] ?? '';
                    $id = $movie['id'] ?? '';
                    echo "<div class='col'>";
                    if(isset($_SESSION['email'])){
                      echo "<a href='watch.php?id=".$id."'>";
                    }else {
                      echo "<a href='sign-in.php'>";                      
                    }
                        echo "<img src=".$image." alt=".$name." class='rounded touch'>
                              <p class='mt-2 h6 mb-0' style='font-size:18px;'>$name</p>
                            </a>
                            <p style='font-size:14px;'>Coming Soon</p>
                          </div>";
                  }
            } catch (PDOException $e) {
              echo "Cannot query data. Error: " . $e->getMessage();
            }
          }
      ?>
      </div>
    </div>
    <!-- FOOTER -->

<?php include '../components/footer.php'; ?>