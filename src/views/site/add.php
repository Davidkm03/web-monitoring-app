<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Site</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <h1>Add Site</h1>
    <form action="/add-site" method="POST">
        <label for="url">URL:</label>
        <input type="text" id="url" name="url" required><br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="check_interval">Check Interval (minutes):</label>
        <input type="number" id="check_interval" name="check_interval" required><br>
        <button type="submit">Add Site</button>
    </form>
</body>
</html>
