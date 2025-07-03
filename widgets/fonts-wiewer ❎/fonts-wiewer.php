<?php
require_once(__DIR__ . '/../fonts.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Font Viewer</title>
    <style>
    <?php foreach ($fonts as $font): ?>
		@import url('https://fonts.googleapis.com/css2?family=<?= rawurlencode($font) ?>&display=swap');
    <?php endforeach; ?>
	
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .font-sample {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
			font-size: 3em;
        }
    </style>
</head>
<body>
    <h1>Aperçu des polices</h1>
    <?php foreach ($fonts as $font): ?>
        <div class="font-sample" style="font-family: '<?php echo $font; ?>';">
            <?php echo $font; ?> - Exemple de texte
        </div>
    <?php endforeach; ?>
</body>
</html>
