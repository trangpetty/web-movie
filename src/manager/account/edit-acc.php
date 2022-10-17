<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/manager.css">
    <link rel="stylesheet" href="../../../assets/bootstrap-5.2.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/css/tailwind.css">
    <link rel="stylesheet" href="../../../assets/fontawesome-free-6.2.0-web/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/jquery.flipster.min.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <title>Disney Movie</title>
</head>
<body>
<?php 
    require '../../configuration/database.php';

    $email = $password = $username = $image = $role = "";
    $email_err = $password_err = $image_err = $username_err = $role_err = "";
    $id = trim($_GET["id"]);
    if(isset($_POST['edit'])) {
        
        $input_email = trim($_POST["email"]);
        if(empty($input_email)) {
            $email_err = "Please enter account's email!!!";
        }   else {
            $email = $input_email;
        }
        $input_password = trim($_POST["password"]);
        if(empty($input_password)) {
            $password_err = "Please enter account's password!!!";
        }   else {
            $password = $input_password;
        }
        $input_image = trim($_POST["image"]);
        if(empty($input_image)) {
            $image_err = "Please enter account's image link!!!";
        }   else {
            $image = $input_image;
        }
        $input_username = trim($_POST["username"]);
        if(empty($input_username)) {
            $username_err = "Please enter account's username!!!";
        }   else {
            $username = $input_username;
        }
        $input_role = ($_POST["role"]);
        if(empty($input_role)) {
            $role_err = "Please choose account's role!!!";
        }  else $role = $input_role;
        
        $validate_success = empty($email_err) || empty($password_err) || empty($image_err) || empty($username_err) || empty($role_err);
        if($validate_success) {
            $sql = "UPDATE account SET email=?, password=?, image=?, username=?, role=? WHERE id=?";
            if($statement = $connect->prepare($sql)) {
            try {                    
                    if($statement->execute([$email, $password, $image, $username, $role, $id])) {
                        header("Location: account.php");
                        exit();
                    }   else {
                        echo "Error";
                    }
                    echo "<script>alert('Account edited successfully!!!');</script>";
                }   catch(PODException $e) {
                echo "<script>alert('Cannot edit account into database: .$e->getMessage()')</script>";
                }
            }
            
        }
        
    }   else {
        if(isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
            $id = trim($_GET["id"]);

            $sql = "SELECT * FROM account WHERE id =".$id;
            try {
                $statement = $connect->prepare($sql);
                //$statement->execute([$id]);
                $result = $connect -> query($sql) -> fetchAll();
                foreach($result as $fields) {
                    $email = $fields["email"];
                    $password = $fields["password"];
                    $image = $fields["image"];
                    $username = $fields["username"];
                    $role = $fields["role"];
                }
                
            } catch(PODException $e) {
                echo "Cannot get account into database. " .$e->getMessage();
            }
        }
    }
    
?>
<div class="container my-3">
        <h1 class='h1'>Edit account here</h1>
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
            <div class="mb-3">
                <input type="email" class="form-control"  name="email" value="<?php echo $email; ?>">
                <p class='text-danger'><?php echo $email_err; ?></p>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="password" value="<?php echo $password; ?>">
                <p class='text-danger'><?php echo $password_err; ?></p>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                <p class='text-danger'><?php echo $username_err; ?></p>
            </div>
            <div class="mb-3">
                <textarea type="text" class="form-control w-100" rows='5' name="image" ><?php echo $image; ?></textarea>
                <p class='text-danger'><?php echo $image_err; ?></p>
            </div>
            <!-- <div class="mb-3">
                <input type="text" class="form-control" name="role" value="<?php echo $role; ?>">
                <p class='text-danger'><?php echo $role_err; ?></p>
            </div> -->
            <div class="mb-3">
                Role: 
                <input type="radio" name="role" value="1">1
                <input type="radio" name="role" value="0">0
                <p class='text-danger'><?php echo $role_err; ?></p>
            </div>
            <div class="mb-3">
                <input type="submit" value="Edit" class="btn btn-success bg-success" name="edit">
                <a href="account.php" class="btn btn-danger">Cancel</a>
            </div>
            
        </form>
</div>
</body>
</html>
