<?php
ob_start();
session_start();


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "G4_php_masrawy";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
  	 echo "error Connection ".$e->getMessage();
  }


function getNewsViewers($conn,$news_id) {
	// select all viewers
	$views = $conn->prepare("SELECT * FROM news_view WHERE news_id = $news_id");
	$views->execute();
	$totalViews = $views->rowCount();
	return $totalViews;
}

function getNewsComments($conn,$news_id) {
	// select all viewers
	$com = $conn->prepare("SELECT * FROM news_comments WHERE news_id = $news_id");
	$com->execute();
	$totalComments = $com->rowCount();
	return $totalComments;
}
?>