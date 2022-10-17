<?php 
    require '../../configuration/database.php';

    if($id = trim($_GET["id"])) {
        $sql = "DELETE FROM movie WHERE id=?";
        $statement = $connect->prepare($sql);
        try {
            $statement->execute([$id]);
            header("Location: movie.php");
            echo "<script>alert('Movie deleted successfully!!!');</script>";
        } catch(PODException $e) {
            echo "Cannot delete movie into database. " .$e->getMessage();
        }
    }

?>
                 