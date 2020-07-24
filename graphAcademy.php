<?php
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');
include('fuctionTest.php');
$theme = isset($_GET['theme']) ? $_GET['theme'] : null;
statistique(17);

$data1y=array();
for ($i=0; $i < $GLOBALS["currentSize"]; $i++ ) {
$data1y[$i] = count_value($GLOBALS["tableSave"][$i],17);
}

$data=array();

for ($i=0; $i < $GLOBALS["currentSize"]; $i++ ) {
$data[$i] = $GLOBALS["tableSave"][$i];
}

$graph = new Graph(650,550,"auto");
$graph->SetScale("textlin");
if ($theme) {
  $graph->SetTheme(new $theme());
}
$theme_class = new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->xaxis->SetFont(FF_DV_SANSSERIF, FS_BOLD, 7);
$graph->yaxis->SetFont(FF_DV_SANSSERIF, FS_BOLD, 7);
$graph->SetBox(false);
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($data);
$graph->xaxis->SetLabelAngle(50);


$b1plot = new BarPlot($data1y);

$graph->Add($b1plot);


$b1plot->SetColor("white");
$b1plot->SetFillColor("#27ae60");
$b1plot->value->Show();

$graph->title->SetFont(FF_DV_SANSSERIF, FS_BOLD);
$graph->title->Set("Barre-graphe par académie");

$graph->Stroke();
?>