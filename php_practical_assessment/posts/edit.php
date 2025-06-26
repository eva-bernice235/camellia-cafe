<?php
include '../session.php';
include '../config.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['postname'];
    $stmt = $conn->prepare("UPDATE Post SET PostName = ? WHERE PostId = ?");
    $stmt->bind_param("si", $newName, $id);
    $stmt->execute();
    header("Location: list.php");
    exit();
}

$result = $conn->query("SELECT * FROM Post WHERE PostId = $id");
$row = $result->fetch_assoc();
?>

<h2>Edit Post</h2>
<form method="POST">
    <label>Post Name:</label>
    <input type="text" name="postname" value="<?= $row['PostName'] ?>" required>
    <input type="submit" value="Update">
</form>
<a href="list.php">Back to Posts</a>
