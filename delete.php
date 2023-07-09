<?php

require('includes/conn.php');

if (isset($_GET['recipe_id'])) {
  $recipe_id = $_GET['recipe_id'];

  $deleteQuery = "DELETE FROM recipe_desc WHERE recipe_id = '$recipe_id'";
  $deleteResult = mysqli_query($conn, $deleteQuery);


  if ($deleteResult) {

    header("Location: dashboard.php");
    exit();
  } else {

    echo "Error deleting recipe: " . mysqli_error($conn);
  }
}
?>
