<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

  <div class="card shadow-lg border-0 rounded-4 p-4 w-100" style="max-width: 420px;">
    
    <div class="mb-3 text-center">
      <?php getErrors(); ?>
      <?php getMessage(); ?>
    </div>

    <h2 class="text-center mb-4 fw-bold text-primary">Welcome Back</h2>
    <p class="text-center text-muted mb-4">Please login to continue</p>

    <form action="authenticate" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label fw-semibold">Username</label>
        <input type="text" class="form-control rounded-3" name="username" placeholder="Enter your username" required value="<?= $_POST['username'] ?? '' ?>">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label fw-semibold">Password</label>
        <input type="password" class="form-control rounded-3" name="password" placeholder="Enter your password" required>
      </div>

      <button type="submit" class="btn btn-primary w-100 rounded-3 fw-semibold py-2">Login</button>
    </form>

    <div class="text-center mt-4">
      <small class="text-muted">Don’t have an account? 
        <a href="/register" class="text-decoration-none fw-semibold">Register here</a>
      </small>
    </div>
  </div>
  
  <script src="<?= BASE_URL; ?>/public/js/alert.js"></script>
</body>
</html>
