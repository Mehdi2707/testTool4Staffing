<?php
$cars = json_decode(file_get_contents(__DIR__ . '/../../data/cars.json'), true);
$garages = json_decode(file_get_contents(__DIR__ . '/../../data/garages.json'), true);

$carId = isset($_GET['id']) ? intval($_GET['id']) : 0;

$selectedCar = null;
foreach ($cars as $car) {
    if ($car['id'] === $carId) {
        $selectedCar = $car;
        break;
    }
}

echo "<h2>Détails</h2>";

if (!$selectedCar) {
    echo "<p style='color:red;'>Voiture introuvable.</p>";
    exit;
}

$garageId = $selectedCar['garageId'] ?? null;

$selectedGarage = null;
if ($garageId) {
    foreach ($garages as $garage) {
        if ($garage['id'] === $garageId) {
            $selectedGarage = $garage;
            break;
        }
    }
}
?>

<div class="car-details" style="border:1px solid #ccc; padding:15px; background:#f9f9f9;">
    <h2><?= htmlspecialchars($selectedCar['modelName']) ?></h2>
    <p><strong>Marque :</strong> <?= htmlspecialchars($selectedCar['brand']) ?></p>
    <p><strong>Année :</strong> <?= htmlspecialchars(date("Y", $selectedCar['year'])) ?></p>
    <p><strong>Puissance :</strong> <?= htmlspecialchars($selectedCar['power']) ?> chevaux</p>
    <p><strong>Couleur :</strong> <span style="display:inline-block; width:20px; height:20px; background:<?= htmlspecialchars($selectedCar['colorHex'] ?? '#FFFFFF') ?>;"></span></p>
    
    <?php if ($selectedGarage): ?>
        <h3>Garage</h3>
        <p><strong>Nom :</strong> <?= htmlspecialchars($selectedGarage['title']) ?></p>
        <p><strong>Adresse :</strong> <?= htmlspecialchars($selectedGarage['address']) ?></p>
    <?php else: ?>
        <p style="color:gray;"><i>Aucun garage associé</i></p>
    <?php endif; ?>

    <button class="back-to-list">Retour à la liste</button>
</div>

<script>
    $('.back-to-list').click(function() {
        $('.dynamic-div').load('customs/<?= $_COOKIE['client'] ?>/modules/cars/list.php');
    });
</script>
