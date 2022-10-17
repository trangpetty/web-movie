<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap-5.2.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/tailwind.css">
    <link rel="stylesheet" href="../../assets/fontawesome-free-6.2.0-web/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <title>Disney Movie</title>
</head>
<body>
<?php 
    require '../configuration/database.php';

    $comment = $date = "";
    $comment_err = $date_err = "";
    $id = trim($_GET["id"]);
    if(isset($_POST['edit'])) {
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
        $validate_success = empty($comment_err) && empty($date_err);
        if($validate_success) {
            $sql = "UPDATE comment SET date=?, comment=? WHERE id=?";
            if($statement = $connect->prepare($sql)) {
            try {                    
                    if($statement->execute([$date, $comment, $id])) {
                        header("Location: ../watch.php");
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

            $sql = "SELECT date, comment FROM comment WHERE id =".$id;
            try {
                $statement = $connect->prepare($sql);
                //$statement->execute([$id]);
                $result = $connect -> query($sql) -> fetchAll();
                foreach($result as $fields) {
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
                <input type="datetime-local" class="form-control" name="date" value="<?php echo $date; ?>">
                <p class='text-danger'><?php echo $date_err; ?></p>
            </div>
            <div class="mb-3">
                <textarea cols="30" rows="10" class="form-control" name="comment"><?php echo $comment; ?></textarea>
                <p class='text-danger'><?php echo $comment_err; ?></p>
            </div>
            <div class="mb-3">
                <input type="submit" value="Edit" class="btn btn-success bg-success" name="edit">
                <a href="../watch.php" class="btn btn-danger">Cancel</a>
            </div>
            
        </form>
</div>
</body>
</html>
