<?php
global $tableSave, $currentSize, $rows, $width;
$tableSave= array();
$currentSize = 0;
$width = 26;

function setRows($val) {
$GLOBALS["rows"] = $val;
}

function add($val) {
$GLOBALS["tableSave"][$GLOBALS["currentSize"]] = $val;
$GLOBALS["currentSize"]++;
}


//Check if duplicate cells in csv file
function check_duplicate($check) {
for ($i = $check; $i < $GLOBALS["currentSize"]; $i++) {
for ($j = $i+1; $j < $GLOBALS["currentSize"]; $j++) {
if ($GLOBALS["tableSave"][$j] == $GLOBALS["tableSave"][$i]) {
$GLOBALS["tableSave"][$j] == null;
for ($k = $j+1; $k < $GLOBALS["currentSize"]; $k++) {
$GLOBALS["tableSave"][$k-1] = $GLOBALS["tableSave"][$k];
$GLOBALS["tableSave"][$k] = null;
}
$GLOBALS["currentSize"]--;
} 
}	
}
}

// Statistics
function statistique($find) {
	$tableProcess=array();
if (($handle = fopen("etablissements_denseignement_superieur.csv", "r")) !== FALSE) {  
	fgetcsv($handle);
	  while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
if ($GLOBALS["currentSize"] == 0) {
	$GLOBALS["tableSave"][$GLOBALS["currentSize"]] = $data[$find]; 
	$GLOBALS["currentSize"]++;
} else {
	$repetition = 0;
for ($i = 0; $i < $GLOBALS["currentSize"]; $i++ ) {
if ($GLOBALS["tableSave"][$i] != $data[$find]) {
$repetition++;
}
}
if ($repetition == $GLOBALS["currentSize"]) {
	if ($data[$find] != null) {
	$GLOBALS["tableSave"][$GLOBALS["currentSize"]] = $data[$find]; 
	$GLOBALS["currentSize"]++;
	}
}
}
	  }
	   fclose($handle);
}
}

//Table output for statistique
function statistiqueResultat($find) {
switch($find) {
case 5: $show="STATUT"; break;
case 6: $show="TUTELLE"; break;
case 16: $show="DÉPARTEMENT"; break;
case 18: $show="RÉGION"; break;
case 17: $show="ACADÉMIE"; break;
case 2: $show ="TYPE D'ÉTABLISSEMENT"; break;
default: $show="UNKNOW"; break;
}

echo '<div id="res">';
echo '<h2>'."Tableau statistique par ".$show.'</h2>';
echo '</div>';

echo '<div class="statistiquesTab" id="res">';
echo '<table>';
echo '<tr>';
echo '<th>'.$show.'</th>';
echo '<th>NOMBRE D\'ÉTABLISSEMENT</th>';
$count = 0;
echo '</tr>';
for ($i=0; $i < $GLOBALS["currentSize"]; $i++ ) {
	if($GLOBALS["tableSave"][$i] !== "") {
	echo '<tr>';
	echo '<td>'.$GLOBALS["tableSave"][$i].'</td>';
	echo '<td>';
$res = count_value($GLOBALS["tableSave"][$i],$find);
$count = $count + $res;
echo $res;
echo '</td>';
echo '</tr>';
	}
}
	echo '<tr>';
echo '<td><strong>Total</strong></td>';
echo '<td>'.'<strong>'.$count.'<strong>'.'</td>';
	echo '</tr>';
echo '</table>';
echo '</div>';
}


//Menu scroll in search field
function createMenuSelection($val, $gerne) {
echo '<select name="'.$gerne.'">';
statistique($val);
echo '<option value="">'."------".'</option>';
for ($i=0; $i< $GLOBALS["currentSize"]; $i++) {
echo '<option value="'.$GLOBALS["tableSave"][$i].'">'
.$GLOBALS["tableSave"][$i].'</option>';
}
echo '</select>';

for ($i=0; $i< $GLOBALS["currentSize"]; $i++){
        unset($GLOBALS["tableSave"][$i]);
        }
        $GLOBALS["currentSize"] = 0;
}



// Count the number of value
function count_value($val,$find) {
	$tableTemp=array();
	$indexTemp = 0;
if (($handle = fopen("etablissements_denseignement_superieur.csv", "r")) !== FALSE) {    
$count = 0;
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
		if ($val == $data[$find]) {
  if($indexTemp == 0) {
	  $string = $data[3].";".$data[0].";"
	   .$data[9].";".$data[10].";".$data[11].";"
	   .$data[17].";".$data[18].";"
	   .$data[2].";".$data[5].";"
	   .$data[14].";".$data[15].";".$data[16].";"
	   .$data[1].";".$data[4].";".$data[6].";".$data[7];

$tableTemp[$indexTemp] = $string;
$indexTemp++;
$count++;
  } else {
	  $repetition = 0;
	  $string = $data[3].";".$data[0].";"
	   .$data[9].";".$data[10].";".$data[11].";"
	   .$data[17].";".$data[18].";"
	   .$data[2].";".$data[5].";"
	   .$data[14].";".$data[15].";".$data[16].";"
	   .$data[1].";".$data[4].";".$data[6].";".$data[7];

	  for ($i=0; $i<$indexTemp; $i++) {
		  if ($tableTemp[$i] != $string) {
			  $repetition++;
		  }
	  }
	  if ($repetition == $indexTemp) {
$tableTemp[$indexTemp] = $string;
$indexTemp++;
$count++;
	  }
  }
	}		
	}
    fclose($handle);
	//echo '<p>'. "Il y a ". $count. " pour l'établissement ".$val;
	return $count;
}
}

//Find and save all the information in a table - MAIN ALGORITHM 
function find_value($val, $find) {
	$check = $GLOBALS["currentSize"];
	if($check == 0) {
if (($handle = fopen("etablissements_denseignement_superieur.csv", "r")) !== FALSE) {    
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
		if ($find == 3) {
			$dataRes = explode(" ", $data[3]);
			$valRes = explode(" ", $val);
			$string = "";
		for ($i=0; $i<count($dataRes); $i++) {
			for ($j=0; $j<count($valRes); $j++) {
				if ($valRes[$j] == $dataRes[$i]) {
				if ($string  == "") {
                $string = $valRes[$j];
				} else {
					$string = $string . " " . $valRes[$j];
				}
 			}
			}
			}
    	if ($val == $string) {	
   	//$ext = explode("/", $data[25]);
   	$add = $data[3].";".$data[0].";"
	   .$data[9].";".$data[10].";".$data[11].";"
	   .$data[17].";".$data[18].";"
	   .$data[2].";".$data[5].";"
	   .$data[14].";".$data[15].";".$data[16].";"
	   .$data[1].";".$data[4].";".$data[6].";".$data[7];
 add($add);
     }
  } else {
	  if ($val == $data[$find]) {	
   	//$ext = explode("/", $data[25]);
   	$add = $data[3].";".$data[0].";"
	   .$data[9].";".$data[10].";".$data[11].";"
	   .$data[17].";".$data[18].";"
	   .$data[2].";".$data[5].";"
	   .$data[14].";".$data[15].";".$data[16].";"
	   .$data[1].";".$data[4].";".$data[6].";".$data[7];
 add($add);
     }
  }
	}
  check_duplicate($check);
     //   echo ($GLOBALS["currentSize"]-$check) . " RÉSULTATS SONT TROUVÉS <br>";
    fclose($handle);
}
} else {
	$tableProcess= array();
	$indexArray = 0;
if (($handle = fopen("etablissements_denseignement_superieur.csv", "r")) !== FALSE) {    
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
	if ($find == 3) {
			$dataRes = explode(" ", $data[3]);
		$findRes = explode(" ", $find);
			$string = "";
		for ($i=0; $i<count($dataRes); $i++) {
			for ($j=0; $j<count($valRes); $j++) {
				if ($valRes[$j] == $dataRes[$i]) {
				if ($string  == "") {
                $string = $valRes[$j];
				} else {
					$string = $string . " " . $valRes[$j];
				}
 			}
			}
			}
    	if ($val == $string) {	
   	$compare = $data[3].";".$data[0].";"
	   .$data[9].";".$data[10].";".$data[11].";"
	   .$data[17].";".$data[18].";"
	   .$data[2].";".$data[5].";"
	   .$data[14].";".$data[15].";".$data[16].";"
	   .$data[1].";".$data[4].";".$data[6].";".$data[7];

	for ($i=0; $i<$GLOBALS["currentSize"]; $i++) {
		if ($compare == $GLOBALS["tableSave"][$i]) {
$GLOBALS["tableProcess"][$indexArray] = $GLOBALS["tableSave"][$i];
$indexArray++;
		}
		}
		}
	} else {
		    	if ($val == $data[$find]) {	
   	$compare = $data[3].";".$data[0].";"
	   .$data[9].";".$data[10].";".$data[11].";"
	   .$data[17].";".$data[18].";"
	   .$data[2].";".$data[5].";"
	   .$data[14].";".$data[15].";".$data[16].";"
	   .$data[1].";".$data[4].";".$data[6].";".$data[7];
	for ($i=0; $i<$GLOBALS["currentSize"]; $i++) {
		if ($compare == $GLOBALS["tableSave"][$i]) {
$GLOBALS["tableProcess"][$indexArray] = $GLOBALS["tableSave"][$i];
$indexArray++;
		}
		}
		}
	}
	}

for ($i = 0; $i <  $GLOBALS["currentSize"]; $i++){
        unset($GLOBALS["tableSave"][$i]);
        }
        $GLOBALS["currentSize"] = 0;
        
$GLOBALS["currentSize"] = $indexArray;
for ($i=0; $i<$GLOBALS["currentSize"];$i++) {
$GLOBALS["tableSave"][$i] = $GLOBALS["tableProcess"][$i];
}

for ($i = 0; $i <  $indexArray; $i++){
        unset($GLOBALS["tableProcess"][$i]);
        }
        $indexArray = 0;
		 check_duplicate($check);
fclose($handle);
}
}
}




//Table output for result searching
function table_export() {
	echo '<div class="resTab">';
echo '<table>';
echo '<tr>';
echo '<td style = "background: #27ae60;">Nom</td>'; 
echo '<td style = "background: #27ae60;">Code UAI</td>';
echo '<td style = "background: #27ae60;">Type</td>'; 
echo '<td style = "background: #27ae60;">Statut</td>'; 
echo '<td style = "background: #27ae60;">Adresse</td>';
echo '<td style = "background: #27ae60;">Code Postal</td>';
echo '<td style = "background: #27ae60;">Commune</td>';
echo '<td style = "background: #27ae60;">Téléphone</td>';
echo '<td style = "background: #27ae60;">Arrondisement</td>'; 
echo '<td style = "background: #27ae60;">Departement</td>'; 
echo '<td style = "background: #27ae60;">Académie</td>'; 
echo '<td style = "background: #27ae60;">Région</td>'; 
echo '</tr>';
for ($i = 0; $i < $GLOBALS["currentSize"]; $i++) {
	$extRes = explode(";",$GLOBALS["tableSave"][$i]);
echo '<tr>';
echo '<td>'.$extRes[0].'</td>';
echo '<td>'.$extRes[1].'</td>';
echo '<td>'.$extRes[7].'</td>';
echo '<td>'.$extRes[8].'</td>';
echo '<td>'.$extRes[2].'</td>';
echo '<td>'.$extRes[3].'</td>';
echo '<td>'.$extRes[4].'</td>';
echo '<td>'.$extRes[9].'</td>';
echo '<td>'.$extRes[10].'</td>';
echo '<td>'.$extRes[11].'</td>';
echo '<td>'.$extRes[5].'</td>';
echo '<td>'.$extRes[6].'</td>';
echo '</tr>';
}
echo '</table>';
echo '</div>';
}


//List output for all results searching
function list_ex() {
	if ($GLOBALS["currentSize"] != 0) {
echo '<div id="res" class="inline">';
echo '<h2>'.$GLOBALS["currentSize"] . " RÉSULTATS SONT TROUVÉS".'</h2>';
echo '</div>';
for ($i=0; $i<$GLOBALS["currentSize"]; $i++) {
	echo '<div id="res" class="inline">';
		$ext = explode(";",$GLOBALS["tableSave"][$i]);
echo '<h2>'.$ext[0].'</h2>';
echo '<p>';
echo $ext[7].'<br>'.$ext[8].'<br>';
echo $ext[2].'<br>';
echo $ext[3]." ".$ext[4].'<br>';
echo $ext[5].'<br>'.$ext[6].'<br>';
echo '<a href="resultat.php?idcode='.$ext[1].'">'."Afficher plus d'information".'</a>'."<br>";
echo '</p>';
echo '</div>';
} //echo '</section>';
} else {
//echo '<section>';
echo '<p>'."Aucun résultat est trouvé".'</p>';
//echo '</section>';
}
}


function list_all($val) {
if (($handle = fopen("etablissements_denseignement_superieur.csv", "r")) !== FALSE) {    
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
if ($data[0] == $val) {
echo '<section id="tableSection">';
echo '<div id="res" class="inline" style="width: auto;">';
echo '<p>';
echo '<a href="findMulti.php">Retour à la page précédent</a>';
echo "<br>"."<br>";
echo "Nom: " . '<strong>'.$data[3].'</strong>';
echo "<br>";
echo "Type d'établissement: " . '<strong>'.$data[2].'</strong>';
echo "<br>";
echo "Statut: " . '<strong>'.$data[5].'</strong>';
echo "<br>";
echo "Adresse: " . '<strong>'.$data[9].'</strong>';
if ($data[10] == "Marseille" || $data[11] == "Paris") {
echo " - " . '<strong>'.$data[15].'</strong>';
}
echo "<br>";
echo "CP + Commune: " . '<strong>'.$data[10].'</strong>'. " " . '<strong>'.$data[11].'</strong>';
echo "<br>";
echo "Téléphone: " .'<strong>'.$data[14].'</strong>';
echo "<br>";
echo "Académie: " . '<strong>'.$data[17].'</strong>';
echo "<br>";
echo "Region: " . '<strong>'.$data[18].'</strong>';
echo "<br>";
echo "Code UAI: " . '<strong>'.$data[0].'</strong>';
echo "<br>";
echo "No SIRET: " . '<strong>'.$data[1].'</strong>';
echo "<br>";
echo "Université: " . '<strong>'.$data[7].'</strong>';
echo "<br>";
echo "Sigle: " . '<strong>'.$data[4].'</strong>';
echo "<br>";
echo '<a href="' . $data[25] . '">Afficher sur Onisep.fr</a>';
echo "<br>";
echo '</p>';
echo '</div>';
echo '</section>';
}
}
	fclose($handle);
}
}

//Last search
function printCookie() {
if (isset($_COOKIE["nomCookie"])) {
	return $_COOKIE["nomCookie"];
} 
if (isset($_COOKIE["townCookie"])) {
	return $_COOKIE["townCookie"];
} 
if (isset($_COOKIE["cpCookie"])) {
	return $_COOKIE["cpCookie"];
} 
if (isset($_COOKIE["regionCookie"])) {
	return $_COOKIE["regionCookie"];
} 
if (isset($_COOKIE["academyCookie"])) {
	return $_COOKIE["academyCookie"];
} 
if (isset($_COOKIE["typeCookie"])) {
	return $_COOKIE["typeCookie"];
} 
}

//Get all value after method in form
function run() {
if (isset ($_POST["nom"])) {
	if ($_POST["nom"] !== "") {
	$nom = ucfirst($_POST["nom"]);   
	$GLOBALS["nomCookie"] = $nom;
	find_value($nom,3);
}
}

if (isset($_POST["region"])) {
if ($_POST["region"] !== "") {
$region = $_POST["region"];
$GLOBALS["regionCookie"] = $region;
find_value($region, 18);
}
}


if (isset($_POST["academy"])) {
if ($_POST["academy"] != "") {
$academy = $_POST["academy"];
$GLOBALS["academyCookie"] = $academy;
find_value($academy, 17);
}
}

if (isset ($_POST["town"])) {
	if ($_POST["town"] != "") {
$town = ucfirst($_POST["town"]);
$GLOBALS["townCookie"] = $town;
find_value($town,11);
}
}

if (isset($_POST["type"])) {
if ($_POST["type"] != "") {
$type = $_POST["type"];
$GLOBALS["typeCookie"] = $type;
find_value($type,2);
}
}

if (isset($_POST["status"])) {
if ($_POST["status"] !== "") {
$status = $_POST["status"];
$GLOBALS["statusCookie"] = $status;
	find_value($status,5);
}
}

if (isset($_POST["departement"])) {
if ($_POST["departement"] !== "") {
$departement = $_POST["departement"];
$GLOBALS["departmentCookie"] = $departement;
	find_value($departement,16);
}
}

if (isset($_POST["cp"])) {
if ($_POST["cp"] !== "") {
$cp = $_POST["cp"];
$GLOBALS["cpCookie"] = $cp;
	find_value($cp,10);
}
}

if (isset($_POST["longitude"])) {
if ($_POST["longitude"] != "") {
$longitude = $_POST["longitude"];
find_value($longitude,20);
}
}

if (isset($_POST["latitude"])) {
if ($_POST["latitude"] != "") {
$latitude = $_POST["latitude"];
find_value($latitude,21);
}
}

if (isset($_POST["regionCOD"])) {
if ($_POST["regionCOD"] !== "") {
$regionCOD = $_POST["regionCOD"];
	find_value($nom,19);
}
}
}

function print_value($index, $find) {
if (($handle = fopen("etablissements_denseignement_superieur.csv", "r")) !== FALSE) {    
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
    		    		    		$extRes = explode(";",$GLOBALS["tableSave"][$index]);
    		if ($data[0] == $extRes[1] && $data[9] == $extRes[2]) {
return $data[$find];
    		}
    }
    	//wipeOut($GLOBALS["tableSave"]);
    fclose($handle);
}
}

?>
