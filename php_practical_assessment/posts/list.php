<?php
include '../session.php';
include '../config.php';

$result = $conn->query("SELECT * FROM Post");
?>

<h2>All Job Posts</h2>
<a href="create.php">Add New Post</a> | <a href="../dashboard.php">Dashboard</a> | <a href="../logout.php">Logout</a><br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Post Name</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['PostId'] ?></td>
        <td><?= $row['PostName'] ?></td>
        <td>
            <a href="edit.php?id=<?= $row['PostId'] ?>">Edit</a> | 
            <a href="delete.php?id=<?= $row['PostId'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
