<?php
$mysqlClient = new PDO(
	"mysql:host=localhost;port=3307;dbname=citations;charset=utf8",
	"root",
	""
);
$mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$randomID = rand(1, 17);

$stmt = $mysqlClient->prepare(
	"SELECT quote, date, author FROM citation WHERE quote_id = :quote_id"
);
$stmt->bindParam(":quote_id", $randomID);
$stmt->execute();
$quote = $stmt->fetch(PDO::FETCH_ASSOC);

$quote_l = isset($_GET['quote-l']) ? $_GET['quote-l'] : true;
$quote_r = isset($_GET['quote-r']) ? $_GET['quote-r'] : false;
$quote_style = isset($_GET['quote-style']) ? $_GET['quote-style'] : 34;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Quote Widget</title>
    <style>
.quote {
    font-family: Arial, sans-serif;
    padding: 20px;
    margin: auto;
    width: fit-content;
}

.quote>:first-child{
    margin: 1em;
    overflow: visible;
    position: relative;
	font-size: 1.5em;
}

.quote>:first-child:before,
.quote>:first-child:after{
    position: absolute;
    content: url('images/ (<?php echo($quote_style) ?>).svg');
    width: 2em;
    height: 2em;
    display: block;
}

.quote>:first-child:before{
    left: -2em;
    top: 0;
	<?php if (!$quote_l){echo 'display: none;';}?>
}

.quote>:first-child:after{
    transform: rotate(180deg);
    right: -2em;
    bottom: 0;
	<?php if (!$quote_r){echo 'display: none;';}?>
}

.quote>:last-child{
    text-align: right;

    </style>
</head>
<body>
    <div class="quote">
        <p><?php echo($quote['quote'])?></p>
		<p><?php echo($quote['author']."(".$quote['date'])?>)</p>
    </div>
</body>
</html>
