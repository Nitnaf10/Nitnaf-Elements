<?php
$border_radius = $_GET['border-radius'] ?? '0';
$color         = $_GET['color'] ?? 'auto';
$border        = $_GET['border'] ?? '0';
$font          = $_GET['font-family'] ?? 'Monoton';
$font_size     = $_GET['font-size'] ?? '5rem';

$font_weight   = $_GET['f-weight'] ?? 'normal';
$font_style    = $_GET['font-style'] ?? 'normal';

$background_color = $_GET['background-color'] ?? 'transparent';

$padding_top    = $_GET['padding-top'] ?? '30px';
$padding_bottom = $_GET['padding-bottom'] ?? '50px';
$padding_right  = $_GET['padding-right'] ?? '30px';
$padding_left   = $_GET['padding-left'] ?? '50px';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<title>Horloge PHP</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=<?= rawurlencode($font) ?>&display=swap');

  body {
	display: grid;
    margin: 0;
    background: transparent;
    background: transparent;
    font-family: '<?= str_replace('+', ' ', $font) ?>', sans-serif;
  }

  #clock {
	place-self: center;
    color: <?= htmlspecialchars($color) ?>;
    font-size: <?= htmlspecialchars($font_size) ?>;
	background-color: <?= htmlspecialchars($background_color) ?>;
    border: <?= htmlspecialchars($border) ?>;
    border-radius: <?= htmlspecialchars($border_radius) ?>;
    text-align: center;
    box-sizing: content-box; 
	padding-top: <?= htmlspecialchars($padding_top) ?>;
	padding-right: <?= htmlspecialchars($padding_right) ?>;
	padding-bottom: <?= htmlspecialchars($padding_bottom) ?>;
	padding-left: <?= htmlspecialchars($padding_left) ?>;
    font-weight: <?= htmlspecialchars($font_weight) ?>;
    font-style: oblique <?= htmlspecialchars($font_style) ?>deg;
  }
  
  #clocktext{
	  margin: 0;
	  padding: 0;
  }
</style>
</head>
<body>
  <div id="clock">
    <p id="clocktext"></p>
  </div>
	<script>
		function updateClock() {
			const now = new Date();
			const clockText = document.getElementById('clocktext');
			if (!clockText) return;

			const urlParams = new URLSearchParams(window.location.search);

			const showHours = urlParams.has('hour-show') ? urlParams.get('hour-show') === 'true' : true;
			const showMinutes = urlParams.has('minute-show') ? urlParams.get('minute-show') === 'true' : true;
			const showSeconds = urlParams.has('second-show') ? urlParams.get('second-show') === 'true' : false;

			let timeParts = [];

			if (showHours) {
				timeParts.push(String(now.getHours()).padStart(2, '0'));
			}
			if (showMinutes) {
				timeParts.push(String(now.getMinutes()).padStart(2, '0'));
			}
			if (showSeconds) {
				timeParts.push(String(now.getSeconds()).padStart(2, '0'));
			}

			clockText.textContent = timeParts.join(':');
		}

		updateClock();
		setInterval(updateClock, 1000);
	</script>
</body>
</html>
