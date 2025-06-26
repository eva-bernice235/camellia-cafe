<?php
include '../session.php';
include '../config.php';

// Fetch all posts for the dropdown
$posts = $conn->query("SELECT * FROM Post");

// Get selected PostId from URL
$selectedPostId = isset($_GET['post']) ? $_GET['post'] : '';
$candidates = [];

if ($selectedPostId) {
    $stmt = $conn->prepare("
        SELECT c.*, p.PostName 
        FROM CandidatesResult c 
        JOIN Post p ON c.PostId = p.PostId 
        WHERE c.PostId = ? 
        ORDER BY c.Marks DESC
    ");
    $stmt->bind_param("i", $selectedPostId);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $candidates[] = $row;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Results by Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">
<div class="container">
    <h3 class="mb-4">📊 Results Report by Post</h3>

    <form method="GET" class="mb-4">
        <label for="post" class="form-label">Select Post</label>
        <select name="post" id="post" class="form-select" onchange="this.form.submit()" required>
            <option value="">-- Choose Post --</option>
            <?php while ($post = $posts->fetch_assoc()): ?>
                <option value="<?= $post['PostId'] ?>" <?= ($selectedPostId == $post['PostId']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($post['PostName']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>

    <?php if ($selectedPostId): ?>
        <div class="card mb-3 p-3">
            <h5>Showing results for: <strong><?= $candidates[0]['PostName'] ?? 'N/A' ?></strong></h5>
            <p class="text-muted">Sorted from highest to lowest marks</p>
        </div>

        <?php if (count($candidates) > 0): ?>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>National ID</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Phone</th>
                        <th>Marks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($candidates as $index => $c): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($c['CandidateNationalId']) ?></td>
                        <td><?= htmlspecialchars($c['FirstName'] . ' ' . $c['LastName']) ?></td>
                        <td><?= $c['Gender'] ?></td>
                        <td><?= $c['DateOfBirth'] ?></td>
                        <td><?= $c['PhoneNumber'] ?></td>
                        <td><strong><?= $c['Marks'] ?></strong></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning">No candidates found for this post.</div>
        <?php endif; ?>
    <?php endif; ?>

    <a href="../dashboard.php" class="btn btn-secondary mt-3">← Back to Dashboard</a>
</div>
</body>
</html>
