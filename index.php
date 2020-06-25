<?php require "includes/bd.php"; ?>
    <?php
    $query ="SELECT * FROM `sessions`";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    while($row = mysqli_fetch_row($result)){

        echo $row[0], $row[1];
    }
    mysqli_close($link);
    ?>