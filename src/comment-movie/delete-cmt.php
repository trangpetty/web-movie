<?php 
    require '../configuration/database.php';

    if($id = trim($_GET["id"])) {
        $sql = "DELETE FROM comment WHERE id=?";
        $statement = $connect->prepare($sql);
        try {
            $statement->execute([$id]);
            header("Location: ../watch.php");
            echo "<script>alert('Comment deleted successfully!!!');</script>";
        } catch(PODException $e) {
            echo "Cannot delete comment into database. " .$e->getMessage();
        }
    }

?>
                 