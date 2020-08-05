<?php

    include('config/db_connect.php');
    //write query for pizzas

    $sql = 'SELECT id, title, ingredient FROM pizzas';

    //make query and get result
    $result = mysqli_query($conn, $sql);
    
    //fretch resulting rows as array
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //free result from memory
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php')?>

<h4 class="text-center text-secondary mt-4">Pizzas!</h4>

<div class="container">

    <div class="row">

        <?php foreach($pizzas as $pizza){ ?>

        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mt-4 mb-4">
                <img src="img/pizza.svg" class="pizza">
                <div class="card-body text-center text-secondary">
                    <h6><?php echo htmlspecialchars($pizza['title']);?></h6>
                    <div><?php echo htmlspecialchars($pizza['ingredient']);?></div>
                </div>
                <div class="card-footer text-right">
                    <a class="brand-text pr-2" href="details.php?id=<?php echo $pizza['id'] ?>">more info</a>
                </div>
            </div>
        </div>

        <?php } ?>

    </div>

</div>

<?php include('templates/footer.php')?>

</html>