<?php 
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
include '../library/SED.php';

$studenteBI=consultasSQL::CleanStringText($_POST['adminBI']);
$studentName=consultasSQL::CleanStringText($_POST['studentName']);
$studentSobreNome=consultasSQL::CleanStringText($_POST['studentSobreNome']);
$adminPassword1=consultasSQL::CleanStringText($_POST['adminPassword1']);
$adminPassword2=consultasSQL::CleanStringText($_POST['adminPassword2']);
 ?>