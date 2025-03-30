<?php
$cars = json_decode(file_get_contents(__DIR__ . '/../../../../data/cars.json'), true);
$clientCars = array_filter($cars, fn($car) => $car['customer'] === 'clientc');

echo "<h2>Mes Voitures</h2>";

foreach ($clientCars as $car) {
    echo "<div class='car' data-id='{$car['id']}' style='cursor:pointer; border:1px solid #ccc; padding:10px; margin-bottom:10px;'>";
    echo "<strong style='background-color: {$car['colorHex']}'> {$car['modelName']}</strong><br>";
    echo "Marque : {$car['brand']}<br>";
    echo "Année : " . date("Y", $car['year']) . "<br>";
    echo "Puissance : {$car['power']} ch";
    echo "</div><hr>";
}
