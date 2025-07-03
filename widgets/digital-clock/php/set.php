<?php
require_once(__DIR__ . '/data.php');

function val($value_name,$basic_value){
	global $defval;
	return isset($_GET[$value_name]) && $_GET[$value_name] !== '' ? $_GET[$value_name] : $basic_value;
}

function inurl($value, $def_val, $value_name) {
	if ($value !== $def_val) {
		return $value_name . "=" . $value . "&";
	}
	return "";
}

$t_colo = val('color', 'black');
$b_radi = val('border_radius', "0");
$b_r_un = val('border_radius_unit', "px");
$b_widt = val('border_width', "0");
$b_unit = val('border_unit',  "px");
$b_styl = val('border_style', "solid");
$b_colo = val('border_color', 'black');
$c_font = val('font', "Monoton");
$font_s = val('font_size', "5");
$fo_s_u = val('font_size_unit', "rem");
$padd_t = val('padding_top', "30");
$pa_t_u = val('padding_top_unit', "px");
$padd_b = val('padding_bottom', "30");
$pa_b_u = val('padding_bottom_unit', "px");
$padd_r = val('padding_right', "50");
$pa_r_u = val('padding_right_unit', "px");
$padd_l = val('padding_left', "50");
$pa_l_u = val('padding_left_unit', "px");
$hours  = val('hours', "true");
$minute = val('minutes', "true");
$second = val('second', "false");
$f_weig = val('font_weight', "200"); 
$f_styl = val('font_style', "0");
$bg_col = val('background_color', 'transparent');



$url = 'index.php?' .
	inurl($t_colo, "black", "color") .
	inurl($b_radi . $b_r_un, "0px", "border-radius") .
	inurl($b_widt . $b_unit . " " . $b_styl . " " . $b_colo, "0px solid black", "border") .
	inurl($c_font, "Monoton", "font-family") .
	inurl($f_weig, "200", "f-weight") .
	inurl($f_styl, "0", "font-style") .
	inurl($font_s.$fo_s_u, "5rem", "font-size") .
	inurl($padd_t.$pa_t_u, "30px", "padding-top") .
	inurl($padd_r.$pa_r_u, "50px", "padding-right") .
	inurl($padd_b.$pa_b_u, "30px", "padding-bottom") .
	inurl($padd_l.$pa_l_u, "50px", "padding-left") .
	inurl($bg_col, "transparent", "background-color") .
	inurl($hours, "true", "hour-show") .
	inurl($minute, "true", "minute-show") .
	inurl($second, "false", "second-show");

$url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
$form_submitted = !empty($_GET);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Générateur d'Horloge</title>
    <link rel="stylesheet" href="setstyles.scss" />
    <style>
        .card div {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
    </style>
</head>
<body>
    <h1>Générateur d'Horloge</h1>
    <div class="flex">
        <div>
            <form method="GET" action="">
				<div class="responsive-grid">

					<!-- Rayon de bordure -->
					<div class="card">
						<label for="border_radius">Rayon de bordure :</label>
						<div>
							<input min="0" type="number" id="border_radius" name="border_radius" value="<?= htmlspecialchars($b_radi) ?>" />
							<input list="units" name="border_radius_unit" value="<?= htmlspecialchars($b_r_un) ?>" style="flex: 0.5"/>
						</div>
					</div>

					<!-- Couleur de fond -->
					<div class="card">
						<label for="color">Couleur :</label>
						<div><input list="colors" id="color" name="color" value="<?= htmlspecialchars($t_colo) ?>" /></div>
					</div>

					<!-- Bordure -->
					<div class="card">
						<label for="border_width">Bordure :</label>
						<div>
							<input min="0" type="number" id="border_width" name="border_width" min="0" value="<?= htmlspecialchars($b_widt) ?>" />
							<input list="units" name="border_unit" value="<?= htmlspecialchars($b_unit) ?>"  style="flex: 0.5"/>
							<input list="border_styles" name="border_style" value="<?= htmlspecialchars($b_styl) ?>"/>
							<input list="colors" id="border_color" name="border_color" value="<?= htmlspecialchars($b_colo) ?>"/>
						</div>
					</div>

					<!-- Police -->
					<div class="card">
						<label for="font">Police :</label>
						<div>
							<input list="fonts" id="font" name="font" value="<?= htmlspecialchars($c_font) ?>" />
							<input min="0" type="number" id="font_size" name="font_size" value="<?= htmlspecialchars($font_s) ?>"/>
							<input list="units" id="font_size_unit" name="font_size_unit" value="<?= htmlspecialchars($fo_s_u) ?>" style="flex: 0.5"/>
							<label for="background_color">Couleur de fond :</label>
							<input list="colors" id="background_color" name="background_color" value="<?= htmlspecialchars($bg_col) ?>"/>
						</div>
					</div>
					
					<!-- Gras -->
					<div class="card">
						<label for="font_weight">Gras :</label>
						<div>
							<input type="number" id="font_weight" name="font_weight" min="100" max="900" step="100" value="<?= htmlspecialchars($f_weig) ?>" />
						</div>
					</div>

					<!-- Oblique -->
					<div class="card">
						<label for="font_style">Inclinaison (oblique) :</label>
						<div>
							<input type="number" id="font_style" name="font_style" min="-90" max="90" value="<?= htmlspecialchars($f_styl) ?>" />
						</div>
					</div>


					<!-- Padding haut -->
					<div class="card">
						<label for="padding_top">Padding haut :</label>
						<div>
							<input min="0" type="number" id="padding_top" name="padding_top" value="<?= htmlspecialchars($padd_t) ?>"/>
							<input list="units" name="padding_top_unit" value="<?= htmlspecialchars($pa_t_u) ?>" style="flex: 0.5"/>
						</div>
					</div>

					<!-- Padding droite -->
					<div class="card">
						<label for="padding_right">Padding droite :</label>
						<div>
							<input min="0" type="number" id="padding_right" name="padding_right" value="<?= htmlspecialchars($padd_r) ?>"/>
							<input list="units" name="padding_right_unit" value="<?= htmlspecialchars($pa_r_u) ?>" style="flex: 0.5"/>
						</div>
					</div>

					<!-- Padding bas -->
					<div class="card">
						<label for="padding_bottom">Padding bas :</label>
						<div>
							<input min="0" type="number" id="padding_bottom" name="padding_bottom" value="<?= htmlspecialchars($padd_b) ?>"/>
							<input list="units" name="padding_bottom_unit" value="<?= htmlspecialchars($pa_b_u) ?>" style="flex: 0.5"/>
						</div>
					</div>

					<!-- Padding gauche -->
					<div class="card">
						<label for="padding_left">Padding gauche :</label>
						<div>
							<input min="0" type="number" id="padding_left" name="padding_left" value="<?= htmlspecialchars($padd_l) ?>"/>
							<input list="units" name="padding_left_unit" value="<?= htmlspecialchars($pa_l_u) ?>" style="flex: 0.5"/>
						</div>
					</div>

					<!-- Heures / Minutes / Secondes -->
					<div class="card check-card">
						<label for="hours">Heures :</label>
						<input type="checkbox" id="hours" name="hours" value="true" <?= $hours === "true" ? 'checked' : '' ?> />
					</div>
					<div class="card check-card">
						<label for="minutes">Minutes :</label>
						<input type="checkbox" id="minutes" name="minutes" value="true" <?= $minute === "true" ? 'checked' : '' ?> />
					</div>
					<div class="card check-card">
						<label for="s">Secondes :</label>
						<input type="checkbox" id="second" name="second" value="true" <?= $second === "true" ? 'checked' : '' ?> />
					</div>

				</div>

				<!-- Datalists partagées -->
				<datalist id="colors">
					<?php foreach ($cssColors as $cssc): ?>
						<option value="<?= htmlspecialchars($cssc) ?>"></option>
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
                    <button type="submit">Générer l'Horloge</button>
                </div>
            </form>

            <label for="url">Lien de la ressource :</label>
            <input id="url" type="url" value="<?php echo (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/' . $url; ?>" readonly />
        </div>
        <iframe src="<?= $url ?>" style="border:none;"></iframe>
    </div>
</body>
</html>
