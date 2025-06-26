<?php
include '../session.php';
include '../config.php';

$query = "SELECT c.*, p.PostName 
          FROM CandidatesResult c
          JOIN Post p ON c.PostId = p.PostId";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Candidates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h3>Candidate List</h3>
        <a href="create.php" class="btn btn-success mb-3">Add New Candidate</a>
        <a href="../dashboard.php" class="btn btn-secondary mb-3">Dashboard</a>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>NID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>DoB</th>
                    <th>Post</th>
                    <th>Exam Date</th>
                    <th>Phone</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['CandidateNationalId'] ?></td>
                    <td><?= $row['FirstName'] . ' ' . $row['LastName'] ?></td>
                    <td><?= $row['Gender'] ?></td>
                    <td><?= $row['DateOfBirth'] ?></td>
                    <td><?= $row['PostName'] ?></td>
                    <td><?= $row['ExamDate'] ?></td>
                    <td><?= $row['PhoneNumber'] ?></td>
                    <td><?= $row['Marks'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
