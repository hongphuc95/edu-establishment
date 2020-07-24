<?php
if (isset($_POST["nom"])) {
if ($_POST["nom"] !== null) {
setCookie("nomCookie",$_POST["nom"],time() + 3600);
}
}

if (isset($_POST["town"])) {
if ($_POST["town"] !== null) {
setCookie("townCookie",$_POST["town"],time() + 3600);
}
}

if (isset($_POST["cp"])) {
if ($_POST["cp"] !== null) {
setCookie("cpCookie",$_POST["cp"],time() + 3600);
}
}

if (isset($_POST["region"])) {
if ($_POST["region"] !== null) {
setCookie("regionCookie",$_POST["region"],time() + 3600);
}
}

if (isset($_POST["academy"])) {
if ($_POST["academy"] !== null) {
setCookie("academyCookie",$_POST["academy"],time() + 3600);
}
}

if (isset($_POST["type"])) {
if ($_POST["type"] !== null) {
setCookie("typeCookie",$_POST["type"],time() + 3600);
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<link href="./style.css" rel="stylesheet" type="text/css"/>
<title>Rechercher multiple</title>
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
include ('fuctionTest.php');
?>

<section>
	<div id="search_form" class="inline">
		<form method="post">
		<div id="search_input">
	<article>
<h1>Rechercher</h1>

<label for="nom">Nom</label>
<input  type="text" name="nom" id="nom" placeholder="Nom d'établissement"/>
<br>

<label for="town">Commune</label>
<input type="text"  name="town" id="town" placeholder="Commune"/>
<br>

<label for="cp">Code Postal</label>
<input type="text" name="cp" id="cp" placeholder="Code Postal"/>
<br>

<label for="type">Type</label>
<?php createMenuSelection(2,"type"); ?>
<br>

<label for="status">Statut</label>
<?php createMenuSelection(5,"status"); ?>
<br>

<label for="academy">Académie</label>
<?php createMenuSelection(17,"academy"); ?>
<br>

<label for="region">Région</label>
<?php createMenuSelection(18,"region"); ?>
<br>

<label for="departement">Département</label>
<?php createMenuSelection(16,"departement"); ?>

</div>

<div id="search_export">
	    <input type="checkbox" name="listPrint" id="listPrint" checked="checked" />
   <label for="listPrint">Afficher par liste</label>
   <br>

	<input type="checkbox" name="tablePrint" id="tablePrint"/ >
<label for="tablePrint">Afficher par tableau</label>
   <br>
   <?php
  if(count($_COOKIE) > 0) {
  echo '<p style="font-style: italic;">'."Dernière recherche: ". printCookie(). '<br>';
  }
   ?>
  </div>
 <button type="submit" name="yolo">Go</button>
  </article>	
 </form> 
</div>


<?php
if (!isset($_POST["yolo"])) {
echo '<div id="map" class="inline">
			<aside>
				<img src="image/france.png" alt="france" id="france"/>
			</aside>	
		</div>';
} else {
run();
if (isset($_POST["listPrint"])) { 
echo '<div id="search_res" class="inline">';	
list_ex();
echo '</div>';
}
if (isset($_POST["tablePrint"])) {
	echo '<div id="search_res" class="inline">
<aside>';
echo '<h2>'."Consulter le tableau au dessous".'</h2>';
echo '<img src="image/arrow.png" id="arrow">';
echo '</div>';
echo '</aside>	
</div>';
echo '<section id="tableSection">';
table_export();
echo '</section>';
}
}
?>
</section>
<?php
include 'footer.inc.php';
?>

</body>
</html>
