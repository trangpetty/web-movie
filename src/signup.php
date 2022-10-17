<?php 
  include './configuration/database.php';
  session_start();
  ob_start();
  
  $username = $password = $image = "";
  $email_err = $username_err = $image_err = $password_err = $password_suc = $email_suc = $username_suc = $image_suc = "";
    if(isset($_POST['email'])) {
        $input_email = trim($_POST["email"]);
        $sql = "SELECT * FROM account WHERE email='$input_email'";
        if($connect != null) {
          try {
            $statement = $connect->prepare($sql);
            $statement->execute();
            $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
            $movies = $statement->fetchAll();
            if($movies) {
              $email_err = "Sorry... email already taken!!!";
            }              
          } catch(PODException $e) {
              echo "Cannot insert account into database. " .$e->getMessage();
          }
      }
        if(empty($input_email)) {
          $email_err = "Please enter account's email!!!";
        }   else {
            $email = $input_email;
            $email_suc = '';
        }
    }
      if(isset($_POST['password'])){
        $input_password = trim($_POST["password"]);
        if(empty($input_password)) {
            $password_err = "Please enter account's password!!!";
        }   else {
            $number = preg_match('@[0-9]@', $input_password);
            $uppercase = preg_match('@[A-Z]@', $input_password);
            $lowercase = preg_match('@[a-z]@', $input_password);
            $specialChars = preg_match('@[^\w]@', $input_password);
            
            if(strlen($input_password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
            $password_err = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
            } else {
              $password_suc = "Your password is strong.";
              $password = $input_password;
            }
        }
      }
      if(isset($_POST['username'])) {
        $input_username = trim($_POST["username"]);
        if(empty($input_username)) {
          $username_err = "Please enter account's username!!!";
        }   else {
          $username = $input_username;
        }
      }
      if(isset($_POST['image'])){
        $input_image = trim($_POST["image"]);
        if(empty($input_image)) {
            $image_err = "Please enter account's image link!!!";
        }   else {
            $image = $input_image;
        }
      }
        $role = 0;
        
        $validate_success = empty($username_err) && empty($email_err) && empty($image_err) && empty($password_err);
        if(isset($_POST['signup'])){
          $sql = "INSERT INTO account(email,password,username,image,role) VALUES(?,?,?,?,?);";
          if($connect != null) {
              try {
                  $statement = $connect->prepare($sql);
                  $statement->bindParam(1, $email);
                  $statement->bindParam(2, $password);
                  $statement->bindParam(3, $username);
                  $statement->bindParam(4, $image);
                  $statement->bindParam(5, $role);
                  $statement->execute();
                 
                  
              } catch(PODException $e) {
                  echo "Cannot insert account into database. " .$e->getMessage();
              }
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
    <link rel="stylesheet" href="../assets/sign-up.css">
    <link rel="stylesheet" href="../assets/bootstrap-5.2.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/tailwind.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.2.0-web/css/all.min.css">
    <title>Disney Princess</title>
</head>
<body>
  <nav class="navbar w-100 navbar-expand-sm d-flex justify-content-between" id="navbar-signup">
    <a class="navbar-brand" style="max-width:15%;" href="index.php">
        <img src="../assets/img/logo-dark.png" alt="">
    </a>
    <a href='sign-in.php' id='sign-in' class='btn'>
      Sign In
  </a>
  </nav>
  <div class="container-simple w-100">
    <div class="container-center">
      <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
        <div class="form-signup">
          <div class="header-form">
            <h1 style="font-weight:700;font-size: 32px;">Fill informations to start your membership</h1>
          </div>
          <div class="content-form">
            <div class="mb-2">
              <input type="email" placeholder="Add a email" class="w-100 form-control input-field <?php echo $email_err ? 'is-invalid' :  ''; echo $email_suc ? 'is-valid' : '' ?>" name='email' value='<?php if(isset($_SESSION['email_signup'])) echo $_SESSION['email_signup']  ?>'>
              <p class='text-danger'><?php echo $email_err; ?></p>
              
            </div>
            <div class="mb-2">
              <input type="password" placeholder="Add a password" class="position-relative w-100 form-control input-field <?php echo $password_err ? 'is-invalid' :  ''; echo $password_suc ? 'is-valid' : '' ?>" name='password' value=' '>
              <p class='text-danger'><?php echo $password_err; ?></p>
              <p class='text-success'><?php echo $password_suc; ?></p>
            </div>
            <div class="mb-2">
              <input type="text" placeholder="Add a username" class="w-100 form-control input-field <?php echo $username_err ? 'is-invalid' :  ''; echo $username_suc ? 'is-valid' : '' ?>" name='username' value=''>
              <p class='text-danger'><?php echo $username_err; ?></p>
             
            </div>
            <div class="mb-2">
              <input type="text" placeholder="Add a image's link" class="w-100 form-control input-field <?php echo $image_err ? 'is-invalid' :  ''; echo $image_suc ? 'is-valid' : '' ?>" name='image'>
              <p class='text-danger'><?php echo $image_err; ?></p>
              
            </div>
          </div>
          <div class="submit-form">
            <input type="submit" name="signup" class="btn-submit w-100 text-white" value="Sign Up">
          </div>
        </div>
      </form>
    </div>
  </div>
<?php include '../components/footer.php' ?>