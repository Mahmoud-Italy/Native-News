<?php
include "../../config.php";

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE  FROM `ads` WHERE `id` = $id ");
$stmt->execute();
header("Location: list.php");
?>