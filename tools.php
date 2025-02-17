<?php
$title_dump = "Tools | Blind Tools";
require_once "header.php";

// Database connection details
$servername = "localhost";
$username = "blindtoo_ashu";
$password = "As12@hu12";
$dbname = "blindtoo_tools-admin";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch tools from the database
$sql = "SELECT title, description, url FROM tools ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$tools = [];
while ($row = $result->fetch_assoc()) {
    $tools[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tools - Blind Tools</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .tool {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }
        .tool h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .tool p {
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4 text-center">Explore Our Tools</h1>
        <p class="text-center">
            Discover a variety of accessible tools designed to assist blind and visually impaired users. 
            Each tool is crafted with accessibility in mind, empowering you to navigate daily challenges effortlessly. 
            Click on any tool below to start using it!
        </p>

        <div id="tools-container">
            <?php if (!empty($tools)): ?>
                <?php foreach ($tools as $tool): ?>
                    <div class="tool">
                        <h2><?php echo htmlspecialchars($tool['title']); ?></h2>
                        <p><?php echo nl2br(htmlspecialchars($tool['description'])); ?></p>
                        <a href="<?php echo htmlspecialchars($tool['url']); ?>" target="_blank" class="btn btn-primary">
                            Open <?php echo htmlspecialchars($tool['title']); ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-muted">No tools available at the moment. Please check back later.</p>
            <?php endif; ?>
        </div>
    </div>

<?php require_once "footer.php"; ?>
</body>
</html>

