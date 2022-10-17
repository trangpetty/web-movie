<?php 
    require '../components/header-movies.php';
    $sql = "SELECT id, name, image from movie;";
    if($connect != null) {
      try {
        $statement = $connect->prepare($sql);
            $statement->execute();
            $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
            $movies = $statement->fetchAll();
            echo "<div class='bg-dark' id='content'>";
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

    include '../components/footer.php';
?>