<?php
include "config.php";
$id = $_POST['com_id'];
$del = $conn->prepare("DELETE FROM news_comments WHERE id = $id");
$del->execute();
?>