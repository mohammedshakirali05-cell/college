<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nehru BBA and BCA College | Register Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/college/public/assets/css/public.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/college/public/index.php">Nehru BBA and BCA College</a>
        <a href="/college/public/index.php?url=login" class="btn btn-outline-light btn-sm">Back to Login</a>
    </div>
</nav>

<section class="portal-wrapper">
    <div class="portal-card register-card">
        <h3 class="portal-heading text-center">Register First Admin</h3>
        <p class="portal-subtext text-center">Create the initial admin account for Nehru BBA and BCA College.</p>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_input'): ?>
            <div class="alert alert-danger">Please fill all required fields.</div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'password_mismatch'): ?>
            <div class="alert alert-danger">Password and confirm password do not match.</div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'register_failed'): ?>
            <div class="alert alert-danger">Admin registration failed. Email may already exist.</div>
        <?php endif; ?>

        <form action="/college/public/index.php?url=register-admin-process" method="POST">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-4">Register Admin</button>
        </form>
    </div>
</section>

</body>
</html>