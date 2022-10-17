<?php 
    require '../components/header-movies.php'; 
    session_start();
    //$name = $path = $image = $summary = "";
        
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
      $id = trim($_GET["id"]);
      $sql = "SELECT * FROM movie WHERE id =".$id;
      try {
          $statement = $connect->prepare($sql);
          //$statement->execute([$id]);
          $result = $connect -> query($sql) -> fetchAll();
          foreach($result as $fields) {
              $_SESSION['name'] = $fields["name"];
              $_SESSION['path'] = $fields["path"];
              $_SESSION['summary'] = $fields["summary"];
          }
          
      } catch(PODException $e) {
          echo "Cannot get feedback into database. " .$e->getMessage();
      }
    }

?>
<section class="bg-dark py-3">
      <div class="name-movie rounded">
        <p class="text-white ms-3 h3"><?php echo $_SESSION['name']?></p>
      </div>
      <iframe src="<?php echo $_SESSION['path'] ?>" class="m-auto py-3" width="75%" height="440"></iframe>
      <div class="mx-4 my-3">
        <p style="color:#ff9601;font-size:28px;"><?php echo $_SESSION['name']?></p>
        <div class="desc py-2 text-secondary">
          <p><?php echo $_SESSION['summary'] ?></p>
        </div>
      </div>

      <div class="bg-white container rounded px-4 pb-2">
        <p class="h5 pt-2">Hope you will continue to support</p>
        <?php 
          $sql = "SELECT * from comment ORDER BY id DESC LIMIT 5;";
          try {
                $statement = $connect->prepare($sql);
                $statement->execute();
                $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
                $feedbacks = $statement->fetchAll();
                $count = count($feedbacks);
                
                foreach($feedbacks as $feedback) {
                  $username = $feedback['username'] ?? '';
                  $image = $feedback['image'] ?? '';
                  $comment = $feedback['comment'] ?? '';
                  $date = $feedback['date'];
                  $id = $feedback['id'];
                  $email = $feedback['email'];
                  echo "<div class='mb-2 list-comment'>
                          <div class='d-flex align-items-center'>
                            <img src='".$image."' alt='".$username."' class='rounded-circle' style='width:32px;height:32px;'>
                            <div class='comments'>
                              <p class='h6 m-0'>$username</p>
                              <p>$comment</p>
                            </div>
                            <span class='handle-cmt ms-1'>$date</span>
                          </div>";
                  if($email == $_SESSION['email']){
                    echo "<div class='ms-4'>
                            <a href='./comment-movie/edit-cmt.php?id=".$id."' class='bg-white handle-cmt ms-3 p-1'>Edit</a>
                            <a href='./comment-movie/delete-cmt.php?id=".$id."' class='bg-white handle-cmt ms-3 p-1'>Delete</a>
                          </div>";
                  }
                  echo "</div>";
                }
              } catch (PODException $e){
                
              }
              if(isset($_POST['edit'])) {
                
              } 
              if(isset($_POST['delete'])) {
                $sql = "DELETE FROM comment WHERE id=?";
                $statement = $connect->prepare($sql);
                try {
                    $statement->execute([$id]);
                } catch (PODException $e) {
                  echo "Cannot delete feedback into database. " .$e->getMessage();
                }
  
              }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id='form-comment'>
          <div class="mb-2 input-comments">
            <div class="d-flex">
              <img src="<?php echo $_SESSION['image'] ?>" alt="<?php echo $_SESSION['username'] ?>" class="rounded-circle" style="width:32px;height:32px;">
              <input type="text" placeholder="Comment here . . ." name="comment" class="w-100" id='comment'>
            </div>
            <div class='ms-4'>
                <input type='submit' class='bg-white handle-cmt ms-3 p-1' name='add' value='Add'>
            </div>
          </div>
        </form>
        <?php 
          if(isset($_POST['add'])) {
            if(isset($_SESSION['email']) && isset($_SESSION['image']) && isset($_SESSION['username'])) {
              $date = date('Y-m-d H:i:s');
              $comment = htmlspecialchars($_POST['comment']);
              $sql = "INSERT INTO comment(username, email, image, date, comment) VALUES(?,?,?,?,?)";
              try {
                $statement = $connect->prepare($sql);
                $statement->bindParam(1, $_SESSION['username']);
                $statement->bindParam(2, $_SESSION['email']);
                $statement->bindParam(3, $_SESSION['image']);
                $statement->bindParam(4, $date);
                $statement->bindParam(5, $comment);
                $statement->execute();
                
              } catch(PODException $e) {
                  echo "Cannot insert feedback into database. " .$e->getMessage();
              }
            }
          } 
      
        ?>
    </div>
      <?php 
          $sql = "SELECT id, name, image from movie ORDER BY RAND() limit 10;";
          if($connect != null) {
            try {
                  $statement = $connect->prepare($sql);
                  $statement->execute();
                  $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
                  $movies = $statement->fetchAll();
                  echo "<div class='bg-dark' id='content'>";
                  echo "<p class='mb-3 h6 text-white'>MAY BE YOU ALSO WANT TO SEE</p>";
                  echo "<ul class='list-poster'>";
                  foreach($movies as $movie) {
                    $name = $movie['name'] ?? '';
                    $image = $movie['image'] ?? '';
                    $id = $movie['id'] ?? '';
                    echo "<li class='text-white poster-movie'>
                            <a href='watch.php?id=".$id."'>
                              <img src=".$image." alt=".$name." class='w-100 rounded touch'>
                              <p class='mt-2 movie-name'>$name</p>
                            </a>
                          </li>";
                  }
                  echo "</ul>
                        </div>";
            } catch (PDOException $e) {
              echo "Cannot query data. Error: " . $e->getMessage();
            }
          }
      ?>
</section>

<?php include '../components/footer.php'; ?>