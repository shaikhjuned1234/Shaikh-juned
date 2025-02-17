<?php
$servername = "sql309.infinityfree.com"; 
$username = "if0_37322116"; 
$password = "DnFeg6OYQyShCFw"; 
$dbname = "if0_37322116_tools"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT title, description, url FROM tools";
$result = $conn->query($sql);
$tools = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tools[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tools Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        .tool {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Tools</h1>
        <div id="tools-container">
            <?php foreach ($tools as $tool): ?>
                <div class="tool">
                    <h3><?php echo htmlspecialchars($tool['title']); ?></h3>
                    <p><?php echo htmlspecialchars($tool['description']); ?></p>
                    <a href="<?php echo htmlspecialchars($tool['url']); ?>" target="_blank" class="btn btn-primary">open tool <?php echo htmlspecialchars($tool['title']); ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
