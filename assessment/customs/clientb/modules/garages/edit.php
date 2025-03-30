<?php
$client = $_COOKIE['client'] ?? '';

if ($client !== 'clientb') {
    http_response_code(403);
    exit;
}

$garages = json_decode(file_get_contents(__DIR__ . '/../../../../data/garages.json'), true);

$garageId = isset($_GET['id']) ? intval($_GET['id']) : 0;

$selectedGarage = array_filter($garages, fn($garage) => $garage['id'] === $garageId);
$selectedGarage = reset($selectedGarage);

echo "<h2>Détails</h2>";

if (!$selectedGarage) {
    echo '<div class="garage-details" style="border:1px solid #ccc; padding:15px; background:#f9f9f9;">';
    echo '<h2><p style="color:red;">Garage introuvable.</p></h2>';
    echo '<button class="back-to-list">Retour à la liste</button>';
    echo '</div>';
}
else {
    ?>
    <div class="garage-details" style="border:1px solid #ccc; padding:15px; background:#f9f9f9;">
        <h2>Garage : <?= htmlspecialchars($selectedGarage['title']) ?></h2>
        <p><strong>Adresse :</strong> <?= htmlspecialchars($selectedGarage['address']) ?></p>

        <button class="back-to-list">Retour à la liste</button>
    </div>
    <?php
}
?>

<script>
    $('.back-to-list').click(function() {
        $('.dynamic-div').load('customs/<?= $_COOKIE['client'] ?>/modules/garages/list.php');
    });
</script>
