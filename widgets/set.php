<?php
require_once(__DIR__ . '/data.php');

function val($name, $default) {
    return isset($_GET[$name]) && $_GET[$name] !== '' ? $_GET[$name] : $default;
}

function inurl($value, $default, $key) {
    return $value !== $default ? "{$key}=" . urlencode($value) . "&" : "";
}

// Paramètres généraux
$size = val('size', '300');
$border_width = val('border_width', '10');
$border_unit = val('border_unit', 'px');
$border_style = val('border_style', 'solid');
$border_color = val('border_color', '#000');
$border_radius = val('border_radius', '50');
$border_radius_unit = val('border_radius_unit', '%');
$bg_color = val('background_color', '#fff');

// Aiguilles
$hour_show = val('hour_show', 'true');
$hour_width = val('hour_width', '6');
$hour_length = val('hour_length', '80');
$hour_color = val('hour_color', '#000');
$hour_radius = val('hour_radius', '3');

$minute_show = val('minute_show', 'true');
$minute_width = val('minute_width', '4');
$minute_length = val('minute_length', '110');
$minute_color = val('minute_color', '#444');
$minute_radius = val('minute_radius', '2');

$second_show = val('second_show', 'true');
$second_width = val('second_width', '2');
$second_length = val('second_length', '130');
$second_color = val('second_color', 'red');
$second_radius = val('second_radius', '1');

// Nombres
$show_small = val('show_small', 'true');
$show_big = val('show_big', 'true');

$num_font = val('num_font', 'Arial');
$num_size = val('num_size', '1');
$num_unit = val('num_unit', 'rem');
$num_weight = val('num_weight', 'normal');
$num_color = val('num_color', '#000');
$num_oblique = val('num_oblique', '0');

$big_font = val('big_font', 'Impact');
$big_size = val('big_size', '1.5');
$big_unit = val('big_unit', 'rem');
$big_weight = val('big_weight', 'bold');
$big_color = val('big_color', 'blue');
$big_oblique = val('big_oblique', '10');

$url = "index.php?" .
    inurl($size, '300', 'size') .
    inurl("{$border_width}{$border_unit} {$border_style} {$border_color}", '10px solid #000', 'border') .
    inurl("{$border_radius}{$border_radius_unit}", '50%', 'border-radius') .
    inurl($bg_color, '#fff', 'background-color') .

    inurl($hour_show, 'true', 'hour-show') .
    inurl($hour_width, '6', 'hour-width') .
    inurl($hour_length, '80', 'hour-length') .
    inurl($hour_color, '#000', 'hour-color') .
    inurl($hour_radius, '3', 'hour-radius') .

    inurl($minute_show, 'true', 'minute-show') .
    inurl($minute_width, '4', 'minute-width') .
    inurl($minute_length, '110', 'minute-length') .
    inurl($minute_color, '#444', 'minute-color') .
    inurl($minute_radius, '2', 'minute-radius') .

    inurl($second_show, 'true', 'second-show') .
    inurl($second_width, '2', 'second-width') .
    inurl($second_length, '130', 'second-length') .
    inurl($second_color, 'red', 'second-color') .
    inurl($second_radius, '1', 'second-radius') .

    inurl($show_small, 'true', 'show-small') .
    inurl($show_big, 'true', 'show-big') .

    inurl($num_font, 'Arial', 'num-font') .
    inurl("{$num_size}{$num_unit}", '1rem', 'num-size') .
    inurl($num_weight, 'normal', 'num-weight') .
    inurl($num_color, '#000', 'num-color') .
    inurl($num_oblique, '0', 'num-oblique') .

    inurl($big_font, 'Impact', 'big-font') .
    inurl("{$big_size}{$big_unit}", '1.5rem', 'big-size') .
    inurl($big_weight, 'bold', 'big-weight') .
    inurl($big_color, 'blue', 'big-color') .
    inurl($big_oblique, '10', 'big-oblique');

$url = htmlspecialchars($url);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Générateur d'Horloge Analogique</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <h1>Générateur d'Horloge Analogique</h1>
	<div class="flex">
		<div>
			<form method="GET">
				<div class="responsive-grid">

					<!-- Taille de l'horloge -->
					<div class="card">
						<label for="size">Taille (px) :</label>
						<input type="number" name="size" min="100" value="<?= $size ?>">
					</div>

					<!-- Bordures -->
					<div class="card">
						<label>Bordure :</label>
						<input type="number" name="border_width" value="<?= $border_width ?>" min="0" />
						<input list="units" name="border_unit" value="<?= $border_unit ?>" />
						<input list="border_styles" name="border_style" value="<?= $border_style ?>" />
						<input list="colors" name="border_color" value="<?= $border_color ?>" />
					</div>

					<!-- Rayon des bords -->
					<div class="card">
						<label>Border Radius :</label>
						<input type="number" name="border_radius" value="<?= $border_radius ?>" />
						<input list="units" name="border_radius_unit" value="<?= $border_radius_unit ?>" />
					</div>

					<!-- Couleur de fond -->
					<div class="card">
						<label for="background_color">Fond :</label>
						<input list="colors" name="background_color" value="<?= $bg_color ?>" />
					</div>

					<!-- Aiguilles -->
					<fieldset class="card">
						<legend>Aiguilles</legend>
						<?php
						$hands = ['hour' => 'Heures', 'minute' => 'Minutes', 'second' => 'Secondes'];
						foreach ($hands as $k => $label):
							$show = ${$k . '_show'};
							$width = ${$k . '_width'};
							$length = ${$k . '_length'};
							$color = ${$k . '_color'};
							$radius = ${$k . '_radius'};
						?>
						<div>
							<label><?= $label ?> :</label>
							<input type="checkbox" name="<?= $k ?>_show" value="true" <?= $show === 'true' ? 'checked' : '' ?>>
							L: <input type="number" name="<?= $k ?>_length" value="<?= $length ?>" style="width:60px" />
							W: <input type="number" name="<?= $k ?>_width" value="<?= $width ?>" style="width:50px" />
							R: <input type="number" name="<?= $k ?>_radius" value="<?= $radius ?>" style="width:50px" />
							C: <input list="colors" name="<?= $k ?>_color" value="<?= $color ?>" />
						</div>
						<?php endforeach; ?>
					</fieldset>

					<!-- Affichage des nombres -->
					<div class="card check-card">
						<label><input type="checkbox" name="show-small" value="true" <?= $show_small === 'true' ? 'checked' : '' ?>> Nombres petits</label>
						<label><input type="checkbox" name="show-big" value="true" <?= $show_big === 'true' ? 'checked' : '' ?>> Nombres grands</label>
					</div>

					<!-- Style des nombres -->
					<div class="card">
						<label>Nombres (petits):</label>
						<input list="fonts" name="num_font" value="<?= $num_font ?>" />
						<input type="number" name="num_size" value="<?= $num_size ?>" />
						<input list="units" name="num_unit" value="<?= $num_unit ?>" />
						<input list="colors" name="num_color" value="<?= $num_color ?>" />
						<input type="number" name="num_weight" value="<?= $num_weight ?>" />
						<input type="number" name="num_oblique" value="<?= $num_oblique ?>" />
					</div>

					<div class="card">
						<label>Nombres (grands):</label>
						<input list="fonts" name="big_font" value="<?= $big_font ?>" />
						<input type="number" name="big_size" value="<?= $big_size ?>" />
						<input list="units" name="big_unit" value="<?= $big_unit ?>" />
						<input list="colors" name="big_color" value="<?= $big_color ?>" />
						<input type="text" name="big_weight" value="<?= $big_weight ?>" />
						<input type="number" name="big_oblique" value="<?= $big_oblique ?>" />
					</div>

				</div>

				<!-- Datalists partagées -->
				<datalist id="colors">
					<?php foreach ($cssColors as $color): ?>
						<option value="<?= htmlspecialchars($color) ?>"></option>
					<?php endforeach; ?>
				</datalist>

				<datalist id="fonts">
					<?php foreach ($fonts as $font): ?>
						<option value="<?= htmlspecialchars($font) ?>"></option>
					<?php endforeach; ?>
				</datalist>

				<datalist id="units">
					<?php foreach ($cssUnits as $unit): ?>
						<option value="<?= htmlspecialchars($unit) ?>"></option>
					<?php endforeach; ?>
				</datalist>

				<datalist id="border_styles">
					<?php foreach ($borderStyles as $style): ?>
						<option value="<?= htmlspecialchars($style) ?>"></option>
					<?php endforeach; ?>
				</datalist>

				<div class="button-container">
					<button type="submit">Générer l'horloge</button>
				</div>
			</form>

			<label for="url">Lien de l'horloge :</label>
			<input id="url" type="url" value="<?= (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/' . $url ?>" readonly />
		</div>
		<iframe src="<?= $url ?>" style="width: 100%; height: 500px; border: none;"></iframe>
	</div>
</body>
</html>
