<?php

    //connect to database
    $conn = mysqli_connect('localhost', 'resha', 'resha', 'pizza');

    //check connection
    if(!$conn){
        echo 'connection error: ' . mysqli_connect_error();
    }


?>