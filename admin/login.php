<?php
session_start();
require_once('../db.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the submitted username and password
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Prepare and execute the SQL query
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();

  // Retrieve the result
  $result = $stmt->get_result();

  // Check if a matching user is found
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();


    // Verify the password
    // if (password_verify($password, $row['password'])) {
    if ($password === $row['password']) {
      // Successful login
      $_SESSION['username'] = $username;
      header("Location: index.php");
      exit();
    } else {
      // Invalid password
      echo '<p style="text-align: center; color: red;">Жарамсыз құпия сөз.</p>';
    }
  } else {
    // Invalid username
    echo '<p style="text-align: center; color: red;">Жарамсыз аты.</p>';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <title>Login</title>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="mt-5 mb-3">Login</h2>
        <form action="login.php" method="POST">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required />
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required />
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>