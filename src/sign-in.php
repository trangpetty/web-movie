<?php 
  include './configuration/database.php';
  session_start();
  ob_start();

    if((isset($_POST['signin']))) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $image = '';
    $sql = "SELECT * FROM account WHERE email='".$email."' AND password='".$password."';";
    if($connect != null) {
      try {
            $statement = $connect->prepare($sql);
            $statement->execute();
            $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
            $account = $statement->fetchAll();
            foreach ($account as $acc) {
              $_SESSION['username'] = $acc['username'];
              $_SESSION['image'] = $acc['image'];
            }
            if(count($account) > 0) $role = $account[0]['role'];
            else $role = 0;
      } catch (PDOException $e) {
        echo "Cannot query data. Error: " . $e->getMessage();
      }
    }
    $_SESSION['role'] = $role;
    $_SESSION['email'] = $email;
    if($role == 1) header('Location: manager/manager.php');
    else if($role == 0){
      header('Location: index.php');
    }
  }
  
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/sign-in.css">
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
            
        </nav>
        <div class="header">
            <div class="bg"></div>
        </div>
        <div class="signin">
          <div class="signin-form">
            <div class="signin-form-body">
              <div class="form-signin_main">
                <p class="h1 text-white" style="margin-bottom:28px;">Sign In</p>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="login-form" method="post">
                    <input type="email" name="email" placeholder="Email">
                  
                    <span id="" class="input-error">Please enter a valid email.</span>
                  
                    <input type="password" name="password" placeholder="Password">
                  
                    <span id="" class="input-error">Your password must contain between 4 and 60 characters.</span>
                    <input type='submit' name='signin' class="btn-signin text-white" value="Sign In">
                </form>
                    <div class="login-form-help">
                      <div class="d-flex">
                        <input type="checkbox" class="rememberme rounded-1" checked>
                        <label for="checkbox" class="rememberme-label">Remember me</label>
                      </div>
                      <a href="" class="login-form-link">Need help?</a>
                    </div>
              </div>
              <div class="form-signin_signup mt-5">
                <div class="login-signup-now">
                  New to Netflix?
                  <a href="index.php" class="text-white">Sign up now.</a>
                </div>
                <div class="login-signup-desc mt-2">
                  <span>This page is protected by Google reCAPTCHA to ensure you're not a bot.</span>
                  <button class="open-desc-text">Learn more.</button>
                  <div class="desc-text mt-3">
                    <span id="">The information collected by Google reCAPTCHA is subject to the Google 
                      <a href="https://policies.google.com/privacy" target="_blank" style="color: #0071eb;">Privacy Policy</a> and 
                      <a href="https://policies.google.com/terms" target="_blank" style="color: #0071eb;">Terms of Service</a>, and is used for providing, maintaining, and improving the reCAPTCHA service and for general security purposes (it is not used for personalized advertising by Google).</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        
    </section>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script>
        $(document).ready(function(){
          $(".desc-text").hide();
        $(".open-desc-text").click(function(){
          $(".desc-text").slideDown("slow");
          $(".open-desc-text").hide();
        });
      });
    </script>
<?php include '../components/footer.php' ?>