<?php
function param($name, $default) {
    return isset($_GET[$name]) ? $_GET[$name] : $default;
}

// GÉNÉRAL
$clockSize        = intval(param('size', 300));
$borderWidth      = param('border-width', '10px');
$borderStyle      = param('border-style', 'solid');
$borderColor      = param('border-color', '#333');
$borderRadius     = param('border-radius', '50%');
$backgroundColor  = param('background-color', 'white');

// AIGUILLES
$hands = [
    'hour' => [
        'width'  => param('hour-width', '6px'),
        'length' => intval(param('hour-length', $clockSize / 3)) . 'px',
        'color'  => param('hour-color', '#000'),
        'radius' => param('hour-radius', '3px'),
        'show'   => param('hour-show', '1') === '1'
    ],
    'minute' => [
        'width'  => param('minute-width', '4px'),
        'length' => intval(param('minute-length', $clockSize / 2.5)) . 'px',
        'color'  => param('minute-color', '#555'),
        'radius' => param('minute-radius', '2px'),
        'show'   => param('minute-show', '1') === '1'
    ],
    'second' => [
        'width'  => param('second-width', '2px'),
        'length' => intval(param('second-length', $clockSize / 2)) . 'px',
        'color'  => param('second-color', 'red'),
        'radius' => param('second-radius', '1px'),
        'show'   => param('second-show', '1') === '1'
    ],
];

// NOMBRES — par défaut
$numberFont      = param('num-font', 'Arial');
$numberSize      = param('num-size', '1rem');
$numberWeight    = param('num-weight', 'normal');
$numberColor     = param('num-color', '#000');
$numberOblique   = param('num-oblique', '0deg');

// NOMBRES GRANDS
$showSmall       = param('show-small', '1') === '1';
$showBig         = param('show-big', '1') === '1';

$bigFont         = param('big-font', $numberFont);
$bigSize         = param('big-size', '1.5rem');
$bigWeight       = param('big-weight', 'bold');
$bigColor        = param('big-color', '#000');
$bigOblique      = param('big-oblique', '0deg');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horloge Analogique</title>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
    }

    .clock {
        position: relative;
        width: <?= $clockSize ?>px;
        height: <?= $clockSize ?>px;
        background: <?= $backgroundColor ?>;
        border: <?= $borderWidth ?> <?= $borderStyle ?> <?= $borderColor ?>;
        border-radius: <?= $borderRadius ?>;
    }

    .hand {
        position: absolute;
        bottom: 50%;
        left: 50%;
        transform-origin: bottom;
        transform: translateX(-50%);
    }

    <?php foreach ($hands as $name => $props): ?>
    <?php if ($props['show']): ?>
    .<?= $name ?>-hand {
        width: <?= $props['width'] ?>;
        height: <?= $props['length'] ?>;
        background-color: <?= $props['color'] ?>;
        border-radius: <?= $props['radius'] ?>;
    }
    <?php endif; ?>
    <?php endforeach; ?>

    .center-circle {
        position: absolute;
        width: 14px;
        height: 14px;
        background: <?= $borderColor ?>;
        border-radius: 50%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 10;
    }

    .number {
        position: absolute;
        transform: translate(-50%, -50%) rotate(var(--tilt));
        font-family: <?= $numberFont ?>;
        font-size: <?= $numberSize ?>;
        font-weight: <?= $numberWeight ?>;
        color: <?= $numberColor ?>;
        --tilt: <?= $numberOblique ?>;
    }

    .number.big {
        font-family: <?= $bigFont ?>;
        font-size: <?= $bigSize ?>;
        font-weight: <?= $bigWeight ?>;
        color: <?= $bigColor ?>;
        --tilt: <?= $bigOblique ?>;
    }
</style>
</head>
<body>
    <div class="clock">
    <?php foreach ($hands as $name => $props): ?>
        <?php if ($props['show']): ?>
            <div class="hand <?= $name ?>-hand" id="<?= $name ?>-hand"></div>
        <?php endif; ?>
    <?php endforeach; ?>

    <div class="center-circle"></div>

    <?php
    for ($i = 1; $i <= 12; $i++) {
        $angle = deg2rad($i * 30 - 90);
        $r = $clockSize * 0.42;
        $x = 50 + cos($angle) * $r / ($clockSize / 100);
        $y = 50 + sin($angle) * $r / ($clockSize / 100);
        $isBig = ($i % 3 === 0);

        if ($isBig && !$showBig) continue;
        if (!$isBig && !$showSmall) continue;

        $class = 'number' . ($isBig ? ' big' : '');
        echo "<div class=\"$class\" style=\"left:{$x}%;top:{$y}%;\">{$i}</div>";
    }
    ?>
</div>


    <script>
    function updateClock() {
        const now = new Date();
        const s = now.getSeconds();
        const m = now.getMinutes();
        const h = now.getHours();

        const sDeg = (s / 60) * 360 + 90;
        const mDeg = ((m + s / 60) / 60) * 360 + 90;
        const hDeg = ((h % 12 + m / 60) / 12) * 360 + 90;

        <?php if ($hands['second']['show']): ?>
        document.getElementById('second-hand').style.transform = `translateX(-50%) rotate(${sDeg}deg)`;
        <?php endif; ?>
        <?php if ($hands['minute']['show']): ?>
        document.getElementById('minute-hand').style.transform = `translateX(-50%) rotate(${mDeg}deg)`;
        <?php endif; ?>
        <?php if ($hands['hour']['show']): ?>
        document.getElementById('hour-hand').style.transform = `translateX(-50%) rotate(${hDeg}deg)`;
        <?php endif; ?>
    }

    setInterval(updateClock, 1000);
    updateClock();
</script>

</body>
</html>
