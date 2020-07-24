<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<link href="./style.css" rel="stylesheet" type="text/css"/>
<title>Statistique</title>
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

<section>
<div id="search_form" class="inline">
			<article>
				<h1>Statistique</h1>
				<h2>Nombre d'établissements par :</h2>
				
			<form method="post">
				<table>
					<tr>
						<td><input type="radio" name="typeStatistique" value="type">Type d'établissement</td>
						<td><input type="radio" name="typeStatistique" value="status">Statut</td>
					</tr>
					<tr>
						<td><input type="radio" name="typeStatistique" value="guardianship">Tutelle</td>
						<td><input type="radio" name="typeStatistique" value="academy">Académie</td>
					</tr>
					<tr>
						<td><input type="radio" name="typeStatistique" value="region">Région</td>
						<td><input type="radio" name="typeStatistique" value="department">Département</td>
					</tr>
				</table>
				<h2>Afficher par :</h2>
				<div id="search_export">
<input type="checkbox" name="tableauStatistique" id="tableauStatistique" checked="checked" />
   <label for="tableauStatistique">Tableau</label>
   <br>

	<input type="checkbox" name="grapheStatistique" id="grapheStatistique"/ >
<label for="grapheStatistique">Graphique</label>
   <br>
					 </div>

					 <button type="submit" name="yolo">Go</button>
			</form> 
					</article>			
		</div>



<?php
if (!isset($_POST["yolo"])) {
echo '<div id="map" class="inline">
			<aside>
				<img src="image/statistics.png" alt="statistics" id="statistics"/>
			</aside>	
		</div>';
} else {
        echo '<div id="search_res" class="inline">';
if (isset($_POST["typeStatistique"])) {
if ($_POST["typeStatistique"] == "region") {
setRows(18);
statistique(18);
}if ($_POST["typeStatistique"] == "status") {
setRows(5);
statistique(5);
} if ($_POST["typeStatistique"] == "guardianship") {
setRows(6);
statistique(6);
} if ($_POST["typeStatistique"] == "academy") {
setRows(17);
statistique(17);
} if ($_POST["typeStatistique"] == "department") {
setRows(16);
statistique(16);
}  if ($_POST["typeStatistique"] == "type") {
setRows(2);
statistique(2);
}

if (isset($_POST["tableauStatistique"])) {
statistiqueResultat($GLOBALS["rows"]);
}

if (isset($_POST["grapheStatistique"])) {
	switch ($GLOBALS["rows"]) {
case 18:
echo '<div id="res">';
echo '<img src="graphRegion.php" id="graph">';
echo '</div>';
break; 

case 16:
echo '<div id="res">';
echo '<img src="graphDepartment.php" id="graph">';
echo '</div>';
break; 

case 17:
echo '<div id="res">';
echo '<img src="graphAcademy.php" id="graph">';
echo '</div>';
break; 

case 5:
echo '<div id="res">';
echo '<img src="graphStatus.php" id="graph">';
echo '</div>';
break; 

case 2:
echo '<div id="res">';
echo '<img src="graphType.php" id="graph">';
echo '</div>';
break; 

case 6:
echo '<div id="res">';
echo '<img src="graphGuardianship.php" id="graph">';
echo '</div>';
break; 

default:
echo 'ERROR';

}
}
}
echo '</div>';
	} 
?>
</section>

<?php
include 'footer.inc.php';
?>

</body>
</html>
