
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benvingut/da al nostre web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <header class="bg-dark text-white text-center py-5">
        <h1 class="display-4">Benvingut/da al nostre web</h1>
    </header>

    <div class="container mt-4">
        <h1 class="text-center mb-3">Benvingut <?php echo $_SESSION['logged_user']['name'] ?? 'convidat'; ?></h1>

       
    <footer class="bg-dark text-white text-center py-3 mt-4">
        &copy; <?php echo date('Y'); ?> Nostre Web
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>