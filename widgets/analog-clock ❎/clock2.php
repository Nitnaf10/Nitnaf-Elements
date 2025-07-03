<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Clock2</title>
    <style>
        <?php
            $brad = isset($_GET['brad']) ? htmlspecialchars($_GET['brad']) : '50%';
            $borderColor = isset($_GET['borderColor']) ? htmlspecialchars($_GET['borderColor']) : 'rgb(0,200,100)';
        ?>
        
        body {
            background: radial-gradient(circle, #0a0a0a 30%, #000000 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .clock {
            width: 320px;
            height: 320px;
            background: rgba(0, 0, 0, 0.6);
            border: 10px solid <?= $borderColor ?>;
            border-radius: <?= $brad ?>;
            position: relative;
            box-shadow: 0 0 20px <?= $borderColor ?>, 0 0 40px <?= $borderColor ?>, inset 0 0 30px rgba(0, 255, 225, 0.2);
        }

        .hand {
            width: 50%;
            position: absolute;
            top: 50%;
            transform-origin: 100%;
            transition: transform 1s linear;
            border-radius: 2px;
        }

        .hour {
            height: 6px;
            background: #00ffee;
            box-shadow: 0 0 10px #00ffee;
        }

        .minute {
            height: 4px;
            background: #00ccff;
            box-shadow: 0 0 8px #00ccff;
        }

        .second {
            height: 2px;
            background: #ff0055;
            box-shadow: 0 0 6px #ff0055;
        }

        .center {
            width: 14px;
            height: 14px;
            background: #00ffe1;
            border-radius: <?= $brad ?>;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 0 10px #00ffe1;
        }
    
    </style>
</head>
<body>
    <div class="clock">
        <div class="hand hour" id="hour"></div>
        <div class="hand minute" id="minute"></div>
        <div class="hand second" id="second"></div>
        <div class="center"></div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const seconds = now.getSeconds();
            const minutes = now.getMinutes();
            const hours = now.getHours();

            const secondDeg = seconds * 6;
            const minuteDeg = minutes * 6 + seconds * 0.1;
            const hourDeg = ((hours % 12) / 12) * 360 + (minutes / 60) * 30;

            document.getElementById('second').style.transform = `rotate(${secondDeg}deg)`;
            document.getElementById('minute').style.transform = `rotate(${minuteDeg}deg)`;
            document.getElementById('hour').style.transform = `rotate(${hourDeg}deg)`;
        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>
