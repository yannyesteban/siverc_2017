<?php
session_start();
//ini_set("error_reporting","1");

//error_reporting(E_ALL);
ini_set("display_errors", false); 
header('Content-Type: text/html; charset=iso-8859-1');
require_once ("constantes.php");
require_once ("clases/sg_constantes.php");
require_once ("clases/cls_conexion_pg.php");
require_once ("clases/funciones.php");
require_once ("clases/funciones_sg.php");
require_once ("clases/cls_reporte.php");
require_once ("clases/cls_documento.php");
$rep = new cls_reporte;
$ins = "";
if(isset($_GET["cfg_ins_aux"]) or isset($_POST["cfg_ins_aux"])){
	$ins = $_GET["cfg_ins_aux"];
	$aut = $_SESSION["VSES"][$ins]["SS_AUT"];
	$ses = &$_SESSION["VSES"][$ins];

}else{	
	$aut = false;

}
if(!$aut){
	echo "no tiene autorizacion";
	exit;
}// end if

$rep->vses = &$ses;

$rep->vform = &$_GET;
//echo '<link rel="stylesheet" type="text/css" href="css/sg_reportes1.css">';

$doc = new cls_documento;
$doc->body = $rep->control($rep->vform["rep_nombre"]);
$doc->title = $rep->titulo;
echo $doc->control();


?>