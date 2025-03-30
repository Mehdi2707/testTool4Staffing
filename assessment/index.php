<?php
if (!isset($_COOKIE['client'])) {
    setcookie('client', 'clienta', time() + 3600, '/');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tool4cars</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="assets/js/script.js" defer></script>
</head>
<body>

    <button class="change-client" data-client="clienta">Client A</button>
    <button class="change-client" data-client="clientb">Client B</button>
    <button class="change-client" data-client="clientc">Client C</button>

    <button class="change-module" data-module="cars" data-script="list">Voitures</button>
    <button class="change-module" id="btn-garages" data-module="garages" data-script="list" style="display:none;">Garages</button>

    <div class="dynamic-div" data-module="cars" data-script="ajax"></div>
</body>
</html>