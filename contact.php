<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<link href="./style.css" rel="stylesheet" type="text/css"/>
<title>Contacter</title>
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

<section id="contact">	
		<h1>Contacter</h1>
			<article>
			<form method="post">
				 <label for="fname">Prénom</label>
                 <input type="text" id="fname" name="firstname" placeholder="Votre prénom..">
				<label for="lname">Nom</label>
                <input type="text" id="lname" name="lastname" placeholder="Votre nom..">
                <label for="mail">E-Mail</label>
                <input type="text" id="mail" name="mail" placeholder="Votre e-mail..">
                <label for="subject">Subjet</label>
                <textarea id="subject" name="subject" placeholder="Ecrivez votre message.." style="height:200px"></textarea>
                <button type="submit" name="yolo">Envoyer</button>
			</form>
			</article>

            <?php
if (isset($_POST["yolo"])) {
echo '<h2>Merci de nous contacter</h2>';
}
            ?>
	</section>

<?php
include 'footer.inc.php';
?>

</body>
</html>