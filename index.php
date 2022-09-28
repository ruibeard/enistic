<?php
require 'QueryBuilder.php';
require 'Price.php';

$query = new QueryBuilder();

$listOfPrices = $query->fetchAll('prices', Price::class);

require 'index.view.php';
