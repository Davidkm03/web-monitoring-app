<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading text-white">Web Monitoring App</div>
            <div class="list-group list-group-flush">
                <a href="/dashboard" class="list-group-item list-group-item-action bg-dark text-white">Dashboard</a>
                <a href="/add-site" class="list-group-item list-group-item-action bg-dark text-white">Add Site</a>
                <a href="/logout" class="list-group-item list-group-item-action bg-dark text-white">Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" class="w-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/add-site">Add Site</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid">
                <h1 class="mt-4">Dashboard</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Site</th>
                            <th>Status</th>
                            <th>Last Checked</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Suponiendo que $sites es un array con datos -->
                        <?php foreach ($sites as $site): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($site['name'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($site['status'] ?? 'unknown'); ?></td>
                                <td><?php echo htmlspecialchars($site['last_checked'] ?? 'never'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
