<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>


  <!-- STYLESHEETS -->
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/button.css">
  <link rel="stylesheet" href="css/dashboard.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- STYLESHEETS -->


  <!-- SCRIPTS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- TinyMCE CDN -->
  <script src="https://cdn.tiny.cloud/1/67kqdporys3xqkfvujycyo7eq56jpg98gevsdbf8q7jsg3g3/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: 'textarea#editor',
    });
  </script>

  <!-- SCRIPTS -->
</head>

<body class="bg-gray-800">
  <?php
  require('includes/conn.php');
  include('includes/auth.php');

  if (isset($_POST['submit'])) {

    $username = $_SESSION['username'];
    $query_id = "SELECT id FROM users WHERE username='$username'";
    $result_id = mysqli_query($conn, $query_id);
    $row = mysqli_fetch_assoc($result_id);
    $user_id = $row['id'];

    $food_name = stripslashes($_REQUEST['foodname']);
    $food_name = mysqli_real_escape_string($conn, $food_name);

    $food_description = stripslashes($_REQUEST['food_description']);
    $food_description = mysqli_real_escape_string($conn, $food_description);

    $procedures = stripslashes($_REQUEST['procedures']);
    $procedures = mysqli_real_escape_string($conn, $procedures);

    $images = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = "uploads/" . $images;
    move_uploaded_file($image_tmp, $image_path);

    $currentDate = date('Y-m-d H:i:s');

    $query = "INSERT INTO `recipe_desc`(`user_id`, `food_name`, `food_description`, `date_created`, `food_image`) 
              VALUES ('$user_id','$food_name','$food_description','$currentDate','$image_path') ";

    $result = mysqli_query($conn, $query);

    if ($result) {
      $recipe_id = mysqli_insert_id($conn);
      $ingredients = $_POST['ingredients'];

      foreach ($ingredients as $ingredient) {
        $ingredient = mysqli_real_escape_string($conn, $ingredient);

        $ingredient_query = "INSERT INTO tbl_ingredients (recipe_id, ingredient) VALUES ('$recipe_id', '$ingredient')";
        mysqli_query($conn, $ingredient_query);
      }

      // Display success toast and clear form inputs
      echo '<div class="toast show toast-sm" role="alert" aria-live="assertive" aria-atomic="true">';
      echo '<div class="toast-header">';
      echo '<img src="https://media.tenor.com/Iqb8yXDX198AAAAi/twitch-onigiri.gif" class="rounded me-2" style="width: 20px;" alt="Image Alt Text">';
      echo '<strong class="me-auto">Bootstrap</strong>';
      echo '<small>11 mins ago</small>';
      echo '<button type="button" class="btn-close color-black-500 bg-gray-500" data-bs-dismiss="toast" aria-label="Close"></button>';
      echo '</div>';
      echo '<div class="toast-body">';
      echo 'Hello, world! This is a toast message.';
      echo '</div>';
      echo '</div>';

      $_POST = array(); // Clear POST data
      unset($_POST['foodname']);
      unset($_POST['food_description']);
      unset($_POST['procedures']);
    } else {
      echo '<script>alert("Failure")</script>';
    }
  }
  ?>
  <div class="container mx-auto px-4 sm:px-8">
    <div>
      <h1 class="text-2xl font-semibold leading-tight text-center mt-5 text-white">Welcome Back</h1>
    </div>

    <div class="py-8">
      <div class="inline">
        <h2 class="text-2xl font-semibold leading-tight text-white">My Recipes</h2>

      </div>
      <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
          <table class="min-w-full leading-normal">
            <thead>
              <tr>
                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                  Creator / Creator ID
                </th>
                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                  Food Name
                </th>
                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                  Date Created
                </th>

                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                  Start Cooking
                </th>

                <th
                  class="px-5 form-right py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                  Actions
                </th>

              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT * FROM recipe_desc";
              $result = mysqli_query($conn, $query);

              while ($row = mysqli_fetch_assoc($result)) {
                $username = $_SESSION['username'];
                $user_id = $row['user_id'];
                $food_name = $row['food_name'];
                $date_created = $row['date_created'];
                $recipe_id = $row['recipe_id'];

                echo '<tr>';
                echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">';
                echo '<div class="flex">';
                echo '<div class="ml-3">';
                echo '<p class="text-gray-900 whitespace-no-wrap">' . $username . '</p>';
                echo '<p class="text-gray-600 whitespace-no-wrap">' . $user_id . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</td>';
                echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">';
                echo '<p class="text-gray-900 whitespace-no-wrap">' . $food_name . '</p>';
                echo '</td>';
                echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">';
                echo '<p class="text-gray-900 whitespace-no-wrap">' . $date_created . '</p>';
                echo '<p class="text-gray-600 whitespace-no-wrap">Last Updated</p>';
                echo '</td>';
                echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">';
                echo '<span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">';
                echo '<span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>';
                echo '<a href="#foodie' . $recipe_id . '" data-bs-toggle="modal" data-bs-target="#foodie' . $recipe_id . '"><span class="relative">Let\'s Cook</span></a>';
                echo '</span>';
                echo '</td>';
                echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">';
                echo '<div class="btn-group float-left" role="group" aria-label="Basic example">';
                echo '<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateRecipe' . $recipe_id . '" style="color: white; background-color: #198754;">Update</button>';
                echo '<button type="button" class="btn btn-danger" onclick="Delete(' . $recipe_id . ')" style="background-color: #b02a37;">Delete</button>';
                echo '</div>';
                echo '</td>';
                echo '</tr>';

                // Modal for each recipe
                echo '<div class="modal fade" id="foodie' . $recipe_id . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">';
                echo '<div class="modal-dialog modal-dialog-scrollable">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="staticBackdropLabel">Let\'s Cook</h5>';
                echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<div class="card mb-3">';
                echo '<img src="' . $row['food_image'] . '" class="card-img-top" alt="...">';
                echo '<div class="card-body">';
                echo '<h3 class="card-title" style="text-align: center;"><b>' . $row['food_name'] . '</b></h3>';
                echo '<p class="card-text" style="text-align: justify;">' . $row['food_description'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '<div class="card mx-auto shadow-lg p-3 mb-5 bg-body rounded" style="width: 18rem;">';
                echo '<img src="https://www.shutterstock.com/image-vector/ingredients-260nw-154536692.jpg" class="card-img-top" alt="ingredients-260nw-154536692">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title"><b>Ingredients</b></h5>';
                echo '<p class="card-text">These are the checklist for the available ingredients:</p>';
                echo '<p class="card-text" style="text-align: justify;"><b class="text-bg-warning">Reminder:</b><br>';
                echo 'Missing ingredient means you won\'t be able to proceed to the cooking procedure.';
                echo '</p>';
                echo '</div>';
                echo '<ul class="list-group list-group-flush">';

                // Retrieve ingredients data from tbl_ingredients table
                $ingredientsQuery = "SELECT * FROM tbl_ingredients WHERE recipe_id = '$recipe_id'";
                $ingredientsResult = mysqli_query($conn, $ingredientsQuery);

                // Loop through each ingredient and display as list items
                while ($ingredientRow = mysqli_fetch_assoc($ingredientsResult)) {
                  echo '<li class="list-group-item" style="text-align: justify;">';
                  echo '<div class="form-check">';
                  echo '<label class="form-check-label" for="ingredient' . $ingredientRow['recipe_id'] . $ingredientRow['ingredient'] . '">' . $ingredientRow['ingredient'] . '</label>';
                  echo '<input class="form-check-input" type="checkbox" value="" id="ingredient' . $ingredientRow['recipe_id'] . $ingredientRow['ingredient'] . '">';
                  echo '</div>';
                  echo '</li>';
                }

                echo '</ul>';
                echo '</div>';
                echo '</div>';
                echo '<div class="modal-footer">';
                echo '<button type="button" class="btn btn-secondary bg-gray-500 hover:bg-gray-600" data-bs-dismiss="modal">Close</button>';
                echo '<button class="btn btn-primary bg-blue-500 hover:bg-blue-600">Understood</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';



                

                // Update Recipe Modal
                echo '<div class="modal fade" id="updateRecipe' . $recipe_id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                echo '<div class="modal-dialog modal-dialog-scrollable">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="exampleModalLabel">Update Recipe</h5>';
                echo '<button type="button" class="btn-close bg-black-200" data-bs-dismiss="modal" aria-label="Close">X</button>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<!-- FORM FOR MODAL -->';
                echo '<form method="POST" enctype="multipart/form-data" action="update_recipe.php">';
                echo '<div class="mb-3">';
                echo '<label for="foodName' . $recipe_id . '" class="form-label">Food Name</label>';
                echo '<input type="text" class="form-control" id="foodName' . $recipe_id . '" name="food_name" value="' . $row['food_name'] . '">';
                echo '</div>';
                echo '<div class="mb-3">';
                echo '<label for="foodDesc' . $recipe_id . '" class="form-label">Food Description</label>';
                echo '<textarea class="form-control" id="foodDesc' . $recipe_id . '" name="food_description">' . $row['food_description'] . '</textarea>';
                echo '</div>';

                // Ingredients
                echo '<div class="mb-3">';
                echo '<label for="ingredients' . $recipe_id . '" class="form-label">Ingredients</label>';
                echo '<div id="ingredientContainer' . $recipe_id . '">';

                // Retrieve ingredients data from tbl_ingredients table
                $ingredientsQuery = "SELECT * FROM tbl_ingredients WHERE recipe_id = '$recipe_id'";
                $ingredientsResult = mysqli_query($conn, $ingredientsQuery);

                // Loop through each ingredient and display as inputs
                while ($ingredientRow = mysqli_fetch_assoc($ingredientsResult)) {
                  echo '<div class="input-group mb-2">';
                  echo '<input type="text" class="form-control" name="ingredients[]" value="' . $ingredientRow['ingredient'] . '">';
                  echo '<button type="button" class="btn btn-danger bg-red-500" onclick="removeIngredient(this)">Remove</button>';
                  echo '</div>';
                }

                echo '</div>';
                echo '<button type="button" class="btn btn-success bg-green-500" onclick="addIngredient(' . $recipe_id . ')">Add Ingredient</button>';
                echo '</div>';

                echo '<div class="mb-3">';
                echo '<label for="procedures' . $recipe_id . '" class="form-label">Cooking Procedures</label>';
                echo '<textarea class="form-control" id="procedures' . $recipe_id . '" name="procedures"></textarea>';
                echo '</div>';
                echo '<div class="mb-3">';
                echo '<label for="foodImage' . $recipe_id . '" class="form-label">Food Image</label>';
                echo '<input type="file" class="form-control" id="foodImage' . $recipe_id . '" name="food_image">';
                echo '</div>';
                echo '<input type="hidden" name="recipe_id" value="' . $recipe_id . '">';
                echo '<button type="submit" class="btn btn-primary bg-blue-500" name="update_recipe">Update Recipe</button>';
                echo '</form>';
                echo '<!-- FORM FOR MODAL -->';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
              }
              ?>


            </tbody>

          </table>
        </div>

        <a href="#" class="button button--nina float-end px-6 pb-2 pt-2.5 bg-gray-800 hover:bg-gray-700 text-gray-300 hover:text-white relative block focus:outline-none border-2 border-solid rounded-lg text-sm text-center font-semibold uppercase tracking-widest overflow-hidden
               sm:text-xs sm:px-4 sm:pb-1 sm:pt-1.5
               md:text-base md:px-8 md:pb-2.5 md:pt-3
               md:sm\:w-10" data-text="NEW RECIPE" data-bs-toggle="modal" data-bs-target="#createNewRecipe">
          <span class="align-middle">N</span>
          <span class="align-middle">e</span>
          <span class="align-middle">w</span>
          <span class="align-middle"> </span>
          <span class="align-middle">R</span>
          <span class="align-middle">e</span>
          <span class="align-middle">c</span>
          <span class="align-middle">i</span>
          <span class="align-middle">p</span>
          <span class="align-middle">e</span>
        </a>

      </div>
    </div>
  </div>
  </div>


  <!-- MODAL FOR ADDING NEW RECIPE -->

  <div class="modal fade" id="createNewRecipe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close bg-black-200" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">

          <!-- FORM FOR MODAL   -->
          <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="foodname" class="form-label">Food Name</label>
              <input type="text" name="foodname" class="form-control" id="foodname">
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Food Description</label>
              <textarea class="form-control" name="food_description" id="description" cols="30" rows="10"></textarea>
            </div>

            <div class="mb-3" id="ingredientContainer">
              <label for="ingredients" class="form-label">Ingredients</label>
              <button type="button" class="btn mt-1.5 btn-success bg-green-500 hover:bg-green-600"
                onclick="addIngredient()">Add Ingredient</button>
            </div>

            <div class="mb-3">
              <label for="procedure" class="form-label">Cooking Procedures</label>
              <textarea name="procedures" class="form-control" id="editor"></textarea>
            </div>

            <div class="input-group mb-3">
              <label for="foodimage" class="form-label">Food Image</label>
              <input type="file" name="image" class="form-control" id="foodimage">
            </div>

            <div class="input-group mb-3">
              <button type="submit" name="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-600">Save
                changes</button>
            </div>

          </form>

          <!-- FORM FOR MODAL   -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary bg-gray-500 hover:bg-gray-600"
            data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <!-- MODAL FOR ADDING NEW RECIPE END -->

  <!-- Update Recipe Modal -->
  <div class="modal fade" id="updateRecipe'<?php echo $recipe_id ?>' " tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Recipe</h5>
          <button type="button" class="btn-close bg-black-200" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
          <!-- FORM FOR MODAL -->
          <form method="POST" enctype="multipart/form-data" action="update_recipe.php">
            <div class="mb-3">
              <label for="foodname" class="form-label">Food Name</label>
              <input type="text" name="foodname" class="form-control" id="foodname" value="<?php echo $food_name; ?>">
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Food Description</label>
              <textarea class="form-control" name="food_description" id="description" cols="30"
                rows="10"><?php echo $food_description; ?></textarea>
            </div>

            <div class="mb-3" id="ingredientContainer">
              <label for="ingredients" class="form-label">Ingredients</label>
              <button type="button" class="btn mt-1.5 btn-success bg-green-500 hover:bg-green-600"
                onclick="addIngredient()">Add Ingredient</button>
            </div>

            <div class="mb-3">
              <label for="procedure" class="form-label">Cooking Procedures</label>
              <textarea name="procedures" class="form-control" id="editor"><?php echo $procedures; ?></textarea>
            </div>

            <div class="input-group mb-3">
              <label for="foodimage" class="form-label">Food Image</label>
              <input type="file" name="image" class="form-control" id="foodimage">
            </div>

            <div class="input-group mb-3">
              <button type="submit" name="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-600">Save
                changes</button>
            </div>
          </form>
          <!-- FORM FOR MODAL -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary bg-gray-500 hover:bg-gray-600"
            data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>






</body>

</html>

<!-- Javascripts for TinyMCE -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"
  integrity="sha512-BmM0/BQlqh02wuK5Gz9yrbe7VyIVwOzD1o40yi1IsTjriX/NGF37NyXHfmFzIlMmoSIBXgqDiG1VNU6kB5dBbA=="
  crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
  integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ]
  });
</script>

<script>

  function addIngredient() {
    var container = document.getElementById("ingredientContainer");
    var ingredientInput = document.createElement("input");
    ingredientInput.type = "text";
    ingredientInput.classList.add("form-control");
    ingredientInput.classList.add("mt-1.5");
    ingredientInput.name = "ingredients[]";
    container.insertBefore(ingredientInput, container.lastElementChild);
  }


  function Delete(recipeId) {
  if (confirm("Are you sure you want to delete this recipe?")) {
    window.location.href = "delete.php?recipe_id=" + recipeId;
  }
}

</script>