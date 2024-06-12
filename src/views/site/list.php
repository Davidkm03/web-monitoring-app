<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Sites</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <h1>My Sites</h1>
    <ul>
        <?php foreach ($sites as $site): ?>
            <li>
                <strong><?php echo htmlspecialchars($site['name']); ?></strong> (<?php echo htmlspecialchars($site['url']); ?>)
                <form action="/delete-site" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $site['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
