<?php
require('includes/conn.php');

if (isset($_POST['update_recipe'])) {
  $recipe_id = $_POST['recipe_id'];
  $food_name = $_POST['food_name'];
  $food_description = $_POST['food_description'];

  $updateQuery = "UPDATE recipe_desc SET food_name = '$food_name', food_description = '$food_description' WHERE recipe_id = '$recipe_id'";
  mysqli_query($conn, $updateQuery);

  if (isset($_POST['ingredients'])) {
    $ingredients = $_POST['ingredients'];
    $numIngredients = count($ingredients);

    $deleteQuery = "DELETE FROM tbl_ingredients WHERE recipe_id = '$recipe_id'";
    mysqli_query($conn, $deleteQuery);

    for ($i = 0; $i < $numIngredients; $i++) {
      $ingredient = mysqli_real_escape_string($conn, $ingredients[$i]);
      $insertQuery = "INSERT INTO tbl_ingredients (recipe_id, ingredient) VALUES ('$recipe_id', '$ingredient')";
      mysqli_query($conn, $insertQuery);
    }
  }

  if ($_FILES['food_image']['error'] === UPLOAD_ERR_OK) {
    $tmpName = $_FILES['food_image']['tmp_name'];
    $imageName = $_FILES['food_image']['name'];
    $imagePath = 'uploads/' . $imageName;
    move_uploaded_file($tmpName, $imagePath);

    $updateImageQuery = "UPDATE recipe_desc SET food_image = '$imagePath' WHERE recipe_id = '$recipe_id'";
    mysqli_query($conn, $updateImageQuery);
  }

  header('Location: dashboard.php');
  exit();
}
?>
