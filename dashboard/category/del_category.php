<?php
include "../../config.php";

$id = $_GET['id'];
$stmt = $conn->prepare("UPDATE `categories` SET `deleted` = 1 WHERE `id` = $id ");
$stmt->execute();
header("Location: category.php");
?>