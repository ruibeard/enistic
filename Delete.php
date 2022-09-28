<?php

require "QueryBuilder.php";

if (isset($_POST['id'])) {
    $id    = $_POST['id'];
    $query = new QueryBuilder();
    $query->deleteRecord('prices', $id);
}
