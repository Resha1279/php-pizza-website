<?php

include('config/db_connect.php');

$title = $email = $ingredients = '';
$errors = array('email'=>'', 'title'=>'', 'ingredients'=>'');

  if(isset($_POST['submit'])){

    //check email
    if(empty($_POST['email'])){
        $errors['email'] = 'An email is required <br/>';
    }else{
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'email must be a valid email address';
        }
    }

    //check title
    if(empty($_POST['title'])){
        $errors['title'] = 'title is required <br/>';
    }else{
        $title = $_POST['title'];
        if(!preg_match('/^[a-zA-Z\s]+$/',$title)){
            $errors['title'] =  'title must be letter and spaces only';
        }
    }

    //check ingredients
    if(empty($_POST['ingredients'])){
        $errors['ingredients'] =  'at least one ingredient is required <br/>';
    }else{
        $ingredients = $_POST['ingredients'];
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-z\s]*)*$/',$ingredients)){
            $errors['ingredients'] =  'ingredients must be letter and spaces only';
        }
    }

    if(!array_filter($errors)){

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        $sql = "INSERT INTO pizzas(title, email, ingredient)
                VALUES('$title','$email','$ingredients')";

        //save to db

        if(mysqli_query($conn, $sql)){

            header('Location: index.php');

        }else{
            echo 'query error: ' . mysqli_error($conn);
        }

      
    }

  }//end of post check
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php')?>

<section>
    <h4 class="text-center mt-4 text-secondary">Add a Pizza</h4>
    <div class="container bg-white form-group text-secondary">
        <form action="add.php" method="POST">
            <label>Your Email:</label>
            <input type="text" name="email" value="<?php echo $email ?>" class="form-control">
            <div class="text-danger mb-3"><?php echo $errors['email']; ?></div>
            <label>Pizza Title:</label>
            <input type="text" name="title" value="<?php echo $title ?>" class="form-control">
            <div class="text-danger mb-3"><?php echo $errors['title']; ?></div>
            <label>Ingredients (comma separated):</label>
            <input type="text" name="ingredients" value="<?php echo $ingredients ?>" class="form-control">
            <div class="text-danger mb-3"><?php echo $errors['ingredients']; ?></div>
            <div class="text-center mt-2">
                <input type="submit" name="submit" value="submit" class="btn brand text-white">
            </div>
        </form>

    </div>
</section>

<?php include('templates/footer.php')?>

</html>