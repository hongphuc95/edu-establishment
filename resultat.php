<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<link href="./style.css" rel="stylesheet" type="text/css"/>
<title>Information</title>
</head>
<body>

<nav id="nav">
<ul>
<li><img src="cergyLogo.png" alt="cergyLogo"/></li>
<li><a href="index.html">Accueil</a></li>
<li><a href="findMulti.php">Rechercher multiple</a>
<ul>
<li><a href="findByName.php">Rechercher par nom</a></li>
<li><a href="findByAcademy.php">Rechercher par académie</a></li>
<li><a href="findByRegion.php">Rechercher par région</a></li>
<li><a href="findByType.php">Rechercher par type</a></li>
</ul>
</li>
<li><a href="statistique.php">Statistique</a></li>
<li><a href="contact.php">Contacter</a></li>
</ul>
</nav>

<?php
include 'fuctionTest.php';
?>

<?php
$val = $_GET['idcode'];
list_all($val);
include 'footer.inc.php';
?>

</body>
</html>