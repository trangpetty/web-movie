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
    $name = $path = $image = $summary= "";
    $name_err = $path_err = $image_err = $summary_err = "";
    if(isset($_POST['submit'])) {
        
        $input_name = trim($_POST["name"]);
        if(empty($input_name)) {
            $name_err = "Please enter movie's name!!!";
        }   else {
            $name = $input_name;
        }
        $input_path = trim($_POST["path"]);
        if(empty($input_path)) {
            $path_err = "Please enter movie's link!!!";
        }   else {
            $path = $input_path;
        }
        $input_image = trim($_POST["image"]);
        if(empty($input_image)) {
            $image_err = "Please enter movie's image link!!!";
        }   else {
            $image = $input_image;
        }
        $input_summary = trim($_POST["summary"]);
        if(empty($input_summary)) {
            $summary_err = "Please enter movie's summary!!!";
        }   else {
            $summary = $input_summary;
        }
        $validate_success = empty($name_err) && empty($path_err) && empty($image_err) && empty($summary_err);
        if($validate_success) {
            $sql = "INSERT INTO movie(name, path, image, summary) VALUES(?, ?, ?, ?)";
            try {
                $statement = $connect->prepare($sql);
                $statement->bindParam(1, $name);
                $statement->bindParam(2, $path);
                $statement->bindParam(3, $image);
                $statement->bindParam(4, $summary);
                $statement->execute();
                echo "<script>
                        alert('Movie inserted successfully!!!');
                        document.getElementById('form-add').reset();
                    </script>";
                echo "<script>document.getElementById('form-add').reset();</script>";
            } catch(PODException $e) {
                echo "Cannot insert movie into database. " .$e->getMessage();
            }
        }
    } 
 ?>
 
 <div class="container py-3 px-5">
        <h1 class='h1'>Enter movie here</h1>
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" id="form-add">
            <div class="mb-3">
                <input type="text" class="form-control <?php echo $name_err ? 'is-invalid' :  ''; ?>" name="name" placeholder="What is movie's name?" value="<?php echo $name; ?>">
                <p class='text-danger'><?php echo $name_err; ?></p>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="path" placeholder="Enter movie's path" value="<?php echo $path; ?>">
                <p class='text-danger'><?php echo $path_err; ?></p>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control " name="image" placeholder="Enter movie's image link" value="<?php echo $image; ?>">
                <p class='text-danger'><?php echo $image_err; ?></p>
            </div>
            <div class="mb-3">
                <textarea cols="30" rows="10" class="form-control" name="summary" placeholder="Enter movie's summary"><?php echo $summary; ?></textarea>
                <p class='text-danger'><?php echo $summary_err; ?></p>
            </div>
            <div class="mb-3">
                <input type="submit" value="Add" class="btn btn-success bg-success" name="submit">
                <a href="movie.php" class="btn btn-success">List</a>
            </div>
            
        </form>
    </div>

</body>
</html>
