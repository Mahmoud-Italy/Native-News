<?php
include "config.php";

$user_id = $_SESSION['user_id'];
$news_id = strip_tags($_POST['news_id']);
$comment = strip_tags($_POST['com']);

$stmt = $conn->prepare("INSERT INTO news_comments (news_id,user_id,comment) VALUES
	    (:news_id, :user_id, :comment) ");
$stmt->bindParam(':news_id', $news_id);
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':comment', $comment);
$stmt->execute();

?>