<?php
include '../session.php';
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postName = $_POST['postname'];
    $stmt = $conn->prepare("INSERT INTO Post (PostName) VALUES (?)");
    $stmt->bind_param("s", $postName);
    $stmt->execute();
    header("Location: list.php");
    exit();
}
?>

<h2>Add New Post</h2>
<form method="POST">
    <label>Post Name:</label>
    <input type="text" name="postname" required>
    <input type="submit" value="Save">
</form>
<a href="list.php">Back to Posts</a>
