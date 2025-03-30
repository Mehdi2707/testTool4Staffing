<?php
$cars = json_decode(file_get_contents(__DIR__ . '/../../../../data/cars.json'), true);
$garages = json_decode(file_get_contents(__DIR__ . '/../../../../data/garages.json'), true);

$garageNames = [];
foreach ($garages as $garage) {
    $garageNames[$garage['id']] = $garage['title'];
}

$clientCars = array_filter($cars, fn($car) => $car['customer'] === 'clientb');

echo "<h2>Mes Voitures</h2>";

foreach ($clientCars as $car) {
    echo "<div class='car' data-id='{$car['id']}' style='cursor:pointer; border:1px solid #ccc; padding:10px; margin-bottom:10px;'>";
    echo strtolower("{$car['modelName']}<br>");
    echo "Marque : {$car['brand']}<br>";
    $garageName = $garageNames[$car['garageId']] ?? 'Garage inconnu';
    echo "Garage : {$garageName}";
    echo "</div><hr>";
}
