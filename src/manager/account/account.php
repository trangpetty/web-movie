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
    
  <div class="mx-5 py-4">
    <a href="../manager.php" class="btn btn-success mb-2">Back</a>
    <?php include '../../configuration/database.php';
    session_start();
      $sql = "SELECT * from account;";
      if($connect != null) {
          try {
              $statement = $connect->prepare($sql);
              $statement->execute();
              $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
              $accs = $statement->fetchAll();
              echo "<h2 class='h2'>List Account</h2>";
              echo "<table class='table'>";
              echo "<thead class='table-success'>
                          <tr>
                          <th>Id</th>
                          <th>Email</th>
                          <th>Password</th>
                          <th>Username</th>
                          <th>Image</th>
                          <th>Role</th>
                          <th>Action</th>
                          </tr>
                      </thead>";
              foreach($accs as $acc) {
                  $email = $acc['email'] ?? '';
                  $password = $acc['password'] ?? '';
                  $username = $acc['username'] ?? '';
                  $image = $acc['image'] ?? '';
                  $role = $acc['role'] ?? '';
                  $id = $acc['id'] ?? '';
                  echo "<tr>";
                  echo "<td>$id</td>";
                  echo "<td>$email</td>";
                  echo "<td>$password</td>";
                  echo "<td>$username</td>";
                  echo "<td style='width:10%'><image src=".$image."></td>";
                  echo "<td>$role</td>";
                  echo "<td>";
                  echo "<a href='delete-acc.php?id=". $id ."' class='btn btn-danger p-2 ms-2 mt-2'>Delete</a>";
                  echo "<a href='edit-acc.php?id=". $id ."' class='btn btn-info p-2 ms-2 mt-2'>Edit</a>";
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
            //               location.replace('delete-acc.php?id=". $id ."');
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