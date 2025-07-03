<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Configurer le Timer</title>
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

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin: 5px 0;
            font-size: 1.2em;
            color: #333;
        }

        input {
            margin: 5px;
            padding: 10px;
            font-size: 1em;
            width: 120px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button {
            margin-top: 10px;
            padding: 10px 20px;
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
    </style>
</head>
<body>

    <h1>Configurer le Timer</h1>

    <form action="hourglass.php" method="get">
        <label for="h">Heures</label>
        <input type="number" id="h" name="h" min="0" value="0">
        
        <label for="min">Minutes</label>
        <input type="number" id="min" name="min" min="0" value="0">
        
        <label for="s">Secondes</label>
        <input type="number" id="s" name="s" min="0" value="0">
        
        <button type="submit">Démarrer le Timer</button>
        <button type="reset">Réinitialiser</button>
    </form>

</body>
</html>
