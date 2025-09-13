<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .full-height { height: 100vh; }


  </style>
</head>

<body class="bg-light">  

  <div class="container full-height d-flex align-items-center justify-content-center">
    
    <div class="card shadow p-4 w-100" style="max-width:400px;">
      
        <?php getErrors(); ?>
        <?php getMessage(); ?>

      <h3 class="mb-4 text-center">Register User</h3>

      <form action="/create-user" method="POST">
        <div class="mb-3">
          <label for="first_name" class="form-label">First Name</label>
          <input type="text" class="form-control" name="first_name" required>
        </div>

        <div class="mb-3">  
          <label for="last_name" class="form-label">Last Name</label>
          <input type="text" class="form-control" name="last_name" required>
        </div>

        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" required >
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" required >
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" required name="password">
        </div>

        <button type="submit" class="btn btn-primary w-100">Submit</button>

        <div class="text-center mt-3">
          <small>Already have an account? <a href="/">Login here</a></small>
        </div>
      </form>
    </div>
  </div>

<script src="<?= BASE_URL; ?>/public/js/alert.js"></script>
</body>
</html>
