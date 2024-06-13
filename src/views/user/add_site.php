<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Site</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <div class="container">
        <form action="/add-site" method="POST">
            <h1>Add Site</h1>
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generateCsrfToken()); ?>">
            <label for="name">Site Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="url">Site URL:</label>
            <input type="url" id="url" name="url" required>
            <label for="check_interval">Check Interval (minutes):</label>
            <input type="number" id="check_interval" name="check_interval" required>
            <button type="submit">Add Site</button>
        </form>
    </div>
</body>
</html>
