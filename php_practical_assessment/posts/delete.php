<?php
include '../session.php';
include '../config.php';

$id = $_GET['id'];
$conn->query("DELETE FROM Post WHERE PostId = $id");
header("Location: list.php");
exit();
?>
