<?php
require_once __DIR__ . '/_auth.php';           
require_once __DIR__ . '/../common/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
</head>
<body>
  <h1>Welcome to the Dashboard</h1>
  <p>This is a protected area of the website.</p>

  <?php
  if (isset($_SESSION['username'])) {
      echo "<p>Hello, " . htmlspecialchars($_SESSION['name'] . ' ' . $_SESSION['lastName']) . "!</p>";
  } else {
      header("Location: ../index.php"); // ruta relativa desde /pages/
      exit();
  }
  ?>

  <p><a href="../actions/logout.php">Logout</a></p>

  <?php
  // Listado de usuarios
  $sql = "SELECT id, name, lastName, username, role FROM usuarios";
  $result = $conn->query($sql);

  echo "<h2>Users</h2>";

  if ($result && $result->num_rows > 0) {
      echo "<table border='1'>
              <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Last Name</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Actions</th>
              </tr>";
      while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>" . (int)$row['id'] . "</td>
                  <td>" . htmlspecialchars($row['name']) . "</td>
                  <td>" . htmlspecialchars($row['lastName']) . "</td>
                  <td>" . htmlspecialchars($row['username']) . "</td>
                  <td>" . htmlspecialchars($row['role']) . "</td>
                  <td>
                      <a href=\"editUser.php?id=" . (int)$row['id'] . "\">Edit</a> |
                      <a href=\"../actions/deleteUser.php?id=" . (int)$row['id'] . "\" onclick=\"return confirm('Are you sure?')\">Delete</a>
                  </td>
                </tr>";
      }
      echo "</table>";
  } else {
      echo "<p>No users found.</p>";
  }

  ?>
</body>
</html>
