<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nehru BBA and BCA College | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/college/public/assets/css/public.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/college/public/index.php">Nehru BBA and BCA College</a>
        <a href="/college/public/index.php" class="btn btn-outline-light btn-sm">Back to Home</a>
    </div>
</nav>

<section class="portal-wrapper">
    <div class="portal-card">
        <h3 class="portal-heading text-center">Login to Nehru BBA and BCA College</h3>
        <p class="portal-subtext text-center">Use your account credentials to continue.</p>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials'): ?>
            <div class="alert alert-danger">Invalid email or password.</div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'missing_fields'): ?>
            <div class="alert alert-warning">Please enter email and password.</div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'admin_registration_closed'): ?>
            <div class="alert alert-warning">Admin registration is closed because an admin account already exists.</div>
        <?php endif; ?>

        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'unauthorized'): ?>
            <div class="alert alert-danger">You are not authorized to access that page. Please login.</div>
        <?php endif; ?>

        <?php if (isset($_GET['success']) && $_GET['success'] === 'admin_registered'): ?>
            <div class="alert alert-success">Admin account created successfully. Please login.</div>
        <?php endif; ?>

        <form action="/college/public/index.php?url=login-process" method="POST">
            <div class="mb-3">
                <label class="form-label">Email / Login ID</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <?php if (!empty($allowAdminRegister)): ?>
            <div class="portal-links">
                <small class="text-muted">No admin account yet?</small><br>
                <a href="/college/public/index.php?url=register-admin">Register Admin</a>
            </div>
        <?php endif; ?>
    </div>
</section>

</body>
</html>