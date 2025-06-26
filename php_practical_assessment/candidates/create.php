<?php
include '../session.php';
include '../config.php';

// Fetch available posts
$posts = $conn->query("SELECT * FROM Post");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nid = $_POST['nid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $post = $_POST['post'];
    $examDate = $_POST['exam_date'];
    $phone = $_POST['phone'];
    $marks = $_POST['marks'];

    $stmt = $conn->prepare("INSERT INTO CandidatesResult 
        (CandidateNationalId, FirstName, LastName, Gender, DateOfBirth, PostId, ExamDate, PhoneNumber, Marks)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssiisi", $nid, $fname, $lname, $gender, $dob, $post, $examDate, $phone, $marks);

    if ($stmt->execute()) {
        header("Location: list.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Candidate Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h3 class="mb-4">Add Candidate Result</h3>
        <form method="POST">
            <div class="row mb-3">
                <div class="col">
                    <label>National ID</label>
                    <input type="text" name="nid" class="form-control" required>
                </div>
                <div class="col">
                    <label>Phone Number</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label>First Name</label>
                    <input type="text" name="fname" class="form-control" required>
                </div>
                <div class="col">
                    <label>Last Name</label>
                    <input type="text" name="lname" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label>Gender</label>
                    <select name="gender" class="form-control" required>
                        <option value="">-- Select Gender --</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label>Exam Date</label>
                    <input type="date" name="exam_date" class="form-control" required>
                </div>
                <div class="col">
                    <label>Post</label>
                    <select name="post" class="form-control" required>
                        <option value="">-- Select Post --</option>
                        <?php while ($row = $posts->fetch_assoc()): ?>
                            <option value="<?= $row['PostId'] ?>"><?= $row['PostName'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label>Marks (out of 100)</label>
                <input type="number" name="marks" class="form-control" min="0" max="100" required>
            </div>

            <button type="submit" class="btn btn-primary">Save Candidate</button>
            <a href="list.php" class="btn btn-secondary">View All Candidates</a>
        </form>
    </div>
</body>
</html>
