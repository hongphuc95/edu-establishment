<?php
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');
require_once ('jpgraph/jpgraph_pie3d.php');
include('fuctionTest.php');
statistique(16);

$data1y=array();
for ($i=0; $i < $GLOBALS["currentSize"]; $i++ ) {
$data1y[$i] = count_value($GLOBALS["tableSave"][$i],16);
}

$graph = new PieGraph(600,600);

$theme_class = "DefaultTheme";


$b1 = new PiePlot($data1y);
$graph->Add($b1);

$b1->ShowBorder();
$b1->SetColor("black");

$graph->SetBox(true);
$graph->title->SetFont(FF_DV_SANSSERIF, FS_BOLD);
$graph->title->Set("Pie-graphe par département");

$graph->Stroke();
?>