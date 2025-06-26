<?php
include 'session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Cafe Camellia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f2f2f2;
        }
        .dashboard-container {
            max-width: 900px;
            margin: 50px auto;
        }
        .card {
            border-radius: 16px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .logout-btn {
            float: right;
        }
    </style>
</head>
<body>

<div class="container dashboard-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>☕ Welcome, <?= $_SESSION['username'] ?>!</h3>
        <a href="logout.php" class="btn btn-outline-danger logout-btn">Logout</a>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card p-4">
                <h5 class="mb-3">📋 Manage Posts</h5>
                <p>Create, update, or remove job posts for which candidates apply.</p>
                <a href="posts/list.php" class="btn btn-primary">Go to Post Management</a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-4">
                <h5 class="mb-3">📝 Add Candidate Result</h5>
                <p>Record candidate information and their interview exam marks.</p>
                <a href="candidates/create.php" class="btn btn-success">Add Candidate Result</a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-4">
                <h5 class="mb-3">📑 View Candidates</h5>
                <p>See all registered candidates and their data.</p>
                <a href="candidates/list.php" class="btn btn-info text-white">View Candidates</a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-4">
                <h5 class="mb-3">📊 Results by Post</h5>
                <p>Generate reports sorted from highest to lowest marks for each post.</p>
                <a href="results/post_report.php" class="btn btn-warning">View Results Report</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
