<?php

require "QueryBuilder.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = trim($_POST["description"]);
    $price       = trim($_POST["price"]);

    $query = new QueryBuilder();

    $query->createRecord($description, $price);
}
?>
