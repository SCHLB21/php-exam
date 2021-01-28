<?php
$link = mysqli_connect("std-mysql", "std_924", "12345678", "std_924")
or die("Ошибка " . mysqli_error($link));
mysqli_set_charset($link, "utf8")
?>