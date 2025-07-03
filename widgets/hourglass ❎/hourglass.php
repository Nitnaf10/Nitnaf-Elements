<!DOCTYPE html>
<?php
$s = isset($_GET['s']) ? (int)$_GET['s'] : 0;
$min = isset($_GET['min']) ? (int)$_GET['min'] : 0;
$h = isset($_GET['h']) ? (int)$_GET['h'] : 0;
$totalSeconds = $s + ($min * 60) + ($h * 3600);
if ($totalSeconds < 1){
	header("Location: set.php");
}
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Horloge Sablier</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(to bottom, #f5f7fa, #c3cfe2);
        }

        h1 {
            margin-bottom: 20px;
            font-size: 2.5em;
            color: #333;
        }

        .sablier {
            position: relative;
            width: 200px;
            height: 350px;
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid #8b5e3c;
            border-radius: 10px;
            clip-path: polygon(0% 0%, 100% 0%, 60% 50%, 100% 100%, 0% 100%, 40% 50%);
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }

        .sable-haut, .sable-bas {
            position: absolute;
            width: 100%;
            background: #f4c542;
        }

        .sable-haut {
            top: 0;
            height: 50%;
            transition: height 0.5s linear, top 0.5s linear;
			clip-path: polygon(45.01% 12.76%, 112.50% -19.63%, 86.88% 87.09%, 41.88% 108.7%, 23.13% 71.23%, 0.63% -3.88%);
        }

        .sable-bas {
            bottom: 0;
            height: 0%;
            transition: height 0.5s linear;
			clip-path: polygon(33.38% 24.69%, 99px -3px, 79.64% 12.85%, 370px 177px, -52.5% 100.57%, 26.5% 10.29%);
        }

        .sable-milieux {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 50%;
			bottom: 0;
            background: #f4c542;
            border-radius: 2px;
        }

        .temps {
            margin-top: 20px;
            font-size: 2em;
            font-weight: bold;
            color: #222;
        }
		
		.controls {
			margin-top: 20px;
			display: flex;
			justify-content: center;
		}

		button {
			margin: 0 5px;
			padding: 10px 15px;
			font-size: 1em;
			background-color: #4CAF50;
			color: white;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			transition: background-color 0.3s;
		}

		button:hover {
			background-color: #45a049;
		}

		.message {
			margin-top: 20px;
			font-size: 1.5em;
			color: red;
			display: none; /* Masqué par défaut */
			text-align: center; /* Centrer le texte */
		}
    </style>
</head>
<body>
    <div class="sablier">
        <div class="sable-haut" id="sableHaut"></div>
        <div class="sable-milieux"></div>
        <div class="sable-bas" id="sableBas"></div>
    </div>

        <div class="temps" id="tempsAffiche"></div>
    <div class="controls">
        <button id="pauseButton">Pause</button>
        <button id="resumeButton" style="display:none;">Reprendre</button>
        <button id="resetButton">Réinitialiser</button>
    </div>
    <div class="message" id="messageFin">Temps écoulé !</div>

    <script>
        const duree = <?php echo $totalSeconds ?>;
        let tempsRestant = duree;
        let lastUpdate = performance.now();
        let isPaused = false;

        const sableHaut = document.getElementById('sableHaut');
        const sableBas = document.getElementById('sableBas');
        const tempsAffiche = document.getElementById('tempsAffiche');
        const messageFin = document.getElementById('messageFin');

        function formatTemps(secs) {
            const m = Math.floor(secs / 60).toString().padStart(2, '0');
            const s = (secs % 60).toString().padStart(2, '0');
            return `${m}:${s}`;
        }

        function updateAffichage() {
            tempsAffiche.textContent = formatTemps(tempsRestant);

            const ratio = (duree - tempsRestant) / duree;
            const hauteur = ratio * 50;

            sableHaut.style.height = `${50 - hauteur}%`;
            sableHaut.style.top = `${hauteur}%`;
            sableBas.style.height = `${hauteur}%`;
        }

        function tick(now) {
            if (!isPaused) {
                const delta = now - lastUpdate;
                if (delta >= 1000) {
                    if (tempsRestant > 0) {
                        tempsRestant--;
                        updateAffichage();
                        lastUpdate = now;
                    } else {
                        messageFin.style.display = 'block'; // Affiche le message de fin
                        return;
                    }
                }
            }
            requestAnimationFrame(tick);
        }

        document.getElementById('pauseButton').addEventListener('click', () => {
            isPaused = true;
            document.getElementById('pauseButton').style.display = 'none';
            document.getElementById('resumeButton').style.display = 'inline';
        });

        document.getElementById('resumeButton').addEventListener('click', () => {
            isPaused = false;
            document.getElementById('resumeButton').style.display = 'none';
            document.getElementById('pauseButton').style.display = 'inline';
            lastUpdate = performance.now(); // Réinitialise lastUpdate
            requestAnimationFrame(tick);
        });

        document.getElementById('resetButton').addEventListener('click', () => {
            tempsRestant = duree; // Réinitialise le temps restant
            updateAffichage();
            messageFin.style.display = 'none'; // Cache le message de fin
            isPaused = false; // Assure que le timer n'est pas en pause
            document.getElementById('resumeButton').style.display = 'none';
            document.getElementById('pauseButton').style.display = 'inline';
            lastUpdate = performance.now(); // Réinitialise lastUpdate
            requestAnimationFrame(tick);
        });

        updateAffichage();
        requestAnimationFrame(tick);
    </script>


</body>
</html>
