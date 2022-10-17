<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/bootstrap-5.2.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/css/tailwind.css">
    <link rel="stylesheet" href="../../../assets/fontawesome-free-6.2.0-web/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <title>Disney Movie</title>
</head>
<body>
    
  <div class="mx-5 py-3">
    <a href="../manager.php" class='mt-3 me-3 btn btn-success'>Back</a>
    <a href='add-movie.php' class='mt-3 btn btn-success'>Add new</a>
    <?php include '../../configuration/database.php';
    session_start();
      $sql = "SELECT * from movie;";
      if($connect != null) {
          try {
              $statement = $connect->prepare($sql);
              $statement->execute();
              $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
              $movies = $statement->fetchAll();
              echo "<h2 class='h2 mt-3'>List Movie</h2>";
              echo "<table class='table'>";
              echo "<thead class='table-success'>
                          <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Path</th>
                          <th>Image</th>
                          <th>Summary</th>
                          <th>Action</th>
                          </tr>
                      </thead>";
              foreach($movies as $movie) {
                  $name = $movie['name'] ?? '';
                  $path = $movie['path'] ?? '';
                  $image = $movie['image'] ?? '';
                  $summary = $movie['summary'] ?? '';
                  $id = $movie['id'] ?? '';
                  echo "<tr>";
                  echo "<td>$id</td>";
                  echo "<td style='width:10%'>$name</td>";
                  echo "<td class='w-25'><iframe src=".$path." width='100%'></iframe></td>";
                  echo "<td style='width:15%'><image src=".$image." width='70%' height='auto'></td>";
                  echo "<td style='width:35%'>".$summary."</td>";
                  echo "<td>";
                  echo "<a href='delete-movie.php?id=". $id ."' class='btn btn-danger p-2 ms-2 mt-2'>Delete</a>";
                  echo "<a href='edit-movie.php?id=". $id ."' class='btn btn-info p-2 ms-2 mt-2'>Edit</a>";
                  echo "</td>";
                  echo "</tr>";
              }
              if(!isset($id)) {
                  $id = 0;
              }
              echo "</table>";
              echo "</div>";
            //   echo "<script>
            //       function Delete() {
            //           let text = 'Are you sure you want to delete this record?';
            //           if (confirm(text) == true) {
            //               location.replace('delete-movie.php?id=". $id ."');
            //           }
            //       }
            //       </script>";
          } catch (PDOException $e) {
              echo "Cannot query data. Error: " . $e->getMessage();
          }
      }
    ?>
  </div>
</body>
</html>