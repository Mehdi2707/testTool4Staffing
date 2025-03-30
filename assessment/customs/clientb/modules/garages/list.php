<?php
$client = $_COOKIE['client'] ?? '';

if ($client !== 'clientb') {
    http_response_code(403);
    exit;
}

$garages = json_decode(file_get_contents(__DIR__ . '/../../../../data/garages.json'), true);

$clientGarages = array_filter($garages, fn($garage) => $garage['customer'] === 'clientb');

echo "<h2>Mes Garages</h2>";

foreach ($clientGarages as $garage) {
    echo "<div class='garage' data-id='{$garage['id']}' style='cursor:pointer; border:1px solid #ccc; padding:10px; margin-bottom:10px;'>";
    echo "{$garage['title']}";
    echo "</div><hr>";
}
