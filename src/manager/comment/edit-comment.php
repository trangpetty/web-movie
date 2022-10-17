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

    $email = $username = $image = $comment = $date = "";
    $email_err = $username_err = $image_err = $comment_err = $date_err = "";
    $id = trim($_GET["id"]);
    if(isset($_POST['edit'])) {
        
        $input_email = trim($_POST["email"]);
        if(empty($input_email)) {
            $email_err = "Please enter account's email!!!";
        }   else {
            $email = $input_email;
        }
        $input_username = trim($_POST["username"]);
        if(empty($input_username)) {
            $username_err = "Please enter account's username!!!";
        }   else {
            $username = $input_username;
        }
        $input_image = trim($_POST["image"]);
        if(empty($input_image)) {
            $image_err = "Please enter account's image link!!!";
        }   else {
            $image = $input_image;
        }
        $input_comment = trim($_POST["comment"]);
        if(empty($input_comment)) {
            $comment_err = "Please enter account's comment!!!";
        }   else {
            $comment = $input_comment;
        }
        $input_date = trim($_POST["date"]);
        if(empty($input_date)) {
            $date_err = "Please enter comment's date!!!";
        }   else {
            $date = $input_date;
        }
        $validate_success = empty($email_err) && empty($username_err) && empty($image_err) && empty($comment_err) && empty($date_err);
        if($validate_success) {
            $sql = "UPDATE comment SET username=?, email=?, image=?, date=?, comment=? WHERE id=?";
            if($statement = $connect->prepare($sql)) {
            try {                    
                    if($statement->execute([$username, $email, $image, $date, $comment, $id])) {
                        header("Location: comment.php");
                        exit();
                    }   else {
                        echo "Error";
                    }
                    echo "<script>alert('Comment edited successfully!!!');</script>";
                }   catch(PODException $e) {
                echo "<script>alert('Cannot edit comment into database: .$e->getMessage()')</script>";
                }
            }
            
        }
        
    }   else {
        if(isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
            $id = trim($_GET["id"]);

            $sql = "SELECT * FROM comment WHERE id =".$id;
            try {
                $statement = $connect->prepare($sql);
                //$statement->execute([$id]);
                $result = $connect -> query($sql) -> fetchAll();
                foreach($result as $fields) {
                    $username = $fields["username"];
                    $email = $fields["email"];
                    $image = $fields["image"];
                    $date = $fields["date"];
                    $comment = $fields["comment"];
                }
                
            } catch(PODException $e) {
                echo "Cannot get comment into database. " .$e->getMessage();
            }
        }
    }
    
?>
<div class="container my-3">
        <h1 class='h1'>Edit movie here</h1>
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
            <div class="mb-3">
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                <p class='text-danger'><?php echo $email_err; ?></p>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                <p class='text-danger'><?php echo $username_err; ?></p>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="image" value="<?php echo $image; ?>">
                <p class='text-danger'><?php echo $image_err; ?></p>
            </div>
            <div class="mb-3">
                <input type="datetime-local" class="form-control" name="date" value="<?php echo $date; ?>">
                <p class='text-danger'><?php echo $date_err; ?></p>
            </div>
            <div class="mb-3">
                <textarea cols="30" rows="10" class="form-control" name="comment"><?php echo $comment; ?></textarea>
                <p class='text-danger'><?php echo $comment_err; ?></p>
            </div>
            <div class="mb-3">
                <input type="submit" value="Edit" class="btn btn-success bg-success" name="edit">
                <a href="movie.php" class="btn btn-danger">Cancel</a>
            </div>
            
        </form>
</div>
</body>
</html>
