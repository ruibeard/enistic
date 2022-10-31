<?php

require 'QueryBuilder.php';
require 'Price.php';
require 'Setting.php';

$query = new QueryBuilder();

$listOfPrices = $query->fetchAll('prices', Price::class);

$settingValue = $query->fetchAll('setting', Setting::class);

require 'index.view.php';
