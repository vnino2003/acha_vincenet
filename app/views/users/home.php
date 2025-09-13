<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LMS Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f8f9fa;
    }
    .sidebar {
      min-height: 100vh;
      background: #fff;
      border-right: 1px solid #e0e0e0;
      padding-top: 1rem;
    }
    .sidebar .nav-link {
      color: #333;
      font-weight: 500;
      border-radius: .5rem;
      margin: .2rem 0;
    }
    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      background: #0d6efd;
      color: #fff;
    }
    .sidebar .nav-link i {
      margin-right: 8px;
    }
    .content {
      padding: 2rem;
    }
    .profile-pic-container {
      position: relative;
      display: inline-block;
    }
    .profile-pic-container label {
      position: absolute;
      bottom: 0;
      right: 0;
      background: #0d6efd;
      color: #fff;
      border-radius: 50%;
      padding: 6px;
      cursor: pointer;
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">

    <!-- Sidebar -->
    <nav class="col-md-3 col-lg-2 sidebar d-md-block">
      <div class="position-sticky">
        <div class="px-3 mb-4">
          <h4 class="fw-bold text-primary">📘 MyLMS</h4>
        </div>
        <ul class="nav flex-column px-2">
          <li class="nav-item"><a class="nav-link" href="dashboard.html"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="courses.html"><i class="bi bi-book"></i> My Courses</a></li>
          <li class="nav-item"><a class="nav-link" href="assignments.html"><i class="bi bi-journal-text"></i> Assignments</a></li>
          <li class="nav-item"><a class="nav-link" href="quizzes.html"><i class="bi bi-ui-checks"></i> Quizzes & Exams</a></li>
          <li class="nav-item"><a class="nav-link" href="grades.html"><i class="bi bi-trophy"></i> Progress & Grades</a></li>
          <li class="nav-item"><a class="nav-link" href="discussions.html"><i class="bi bi-chat-dots"></i> Discussions</a></li>
          <li class="nav-item"><a class="nav-link" href="schedule.html"><i class="bi bi-calendar-event"></i> Schedule</a></li>

          <!-- Profile (active page) -->
          <li class="nav-item mt-3">
            <a class="nav-link active" href="profile.html">
              <i class="bi bi-person-circle"></i> Profile
            </a>
          </li>

          <li class="nav-item mt-3">
            <a class="nav-link text-danger" href="<?=site_url('user/logout'); ?>">
              <i class="bi bi-box-arrow-right"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Profile Content -->
    <main class="col-md-9 ms-sm-auto col-lg-10 content">
      <h2 class="fw-bold mb-4"><i class="bi bi-person-circle"></i> My Profile</h2>

      <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
             <?php getErrors(); ?>
      <?php getMessage(); ?>
          <div class="row align-items-center">
            <div class="col-md-3 text-center">
              <div class="profile-pic-container">
                <img src="<?= $profile['profile_pic'] ?? 'https://via.placeholder.com/120'; ?>" 
                     alt="Profile" 
                     class="rounded-circle mb-3" width="120" height="120">
                <label for="uploadPic"><i class="bi bi-plus-lg"></i></label>
                <input type="file" id="uploadPic" name="profile_pic" class="d-none" accept="image/*">
              </div>
              <h5 class="mt-2"><?= $user['first_name'] . " " . $user['last_name']; ?></h5>
              <p class="text-muted"><?= $user['email']; ?></p>
            </div>
            <div class="col-md-9">
              <p><strong>Username:</strong> <?= $user['username']; ?></p>
              <p><strong>Email:</strong> <?= $user['email']; ?></p>
              <p><strong>Phone:</strong> <?= $profile['phone'] ?? 'Not set'; ?></p>
              <p><strong>Address:</strong> <?= $profile['address'] ?? 'Not set'; ?></p>
              <p><strong>Birthday:</strong> <?= $profile['birthday'] ?? 'Not set'; ?></p>
              <p><strong>Gender:</strong> <?= $profile['gender'] ?? 'Not set'; ?></p>
              <p><strong>Course/Department:</strong> <?= $profile['course'] ?? 'Not set'; ?></p>
              <p><strong>Emergency Contact:</strong> <?= $profile['emergency_contact'] ?? 'Not set'; ?></p>
              <p><strong>About Me:</strong> <?= $profile['about'] ?? 'No bio yet.'; ?></p>

              <!-- Social Links -->
              <p><strong>Facebook:</strong> <?= $profile['facebook'] ?? 'Not set'; ?></p>
              <p><strong>LinkedIn:</strong> <?= $profile['linkedin'] ?? 'Not set'; ?></p>
              <p><strong>GitHub:</strong> <?= $profile['github'] ?? 'Not set'; ?></p>

              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                <i class="bi bi-pencil-square"></i> Edit Profile
              </button>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?=site_url('profile'); ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Edit Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">First Name</label>
              <input type="text" name="first_name" value="<?= $user['first_name']; ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Last Name</label>
              <input type="text" name="last_name" value="<?= $user['last_name']; ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="email" value="<?= $user['email']; ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Username</label>
              <input type="text" name="username" value="<?= $user['username']; ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Phone</label>
              <input type="text" name="phone" value="<?= $profile['phone']  ; ?>" class="form-control" placeholder="Enter phone number">
            </div>
            <div class="col-md-6">
              <label class="form-label">Address</label>
              <input type="text" name="address" value="<?= $profile['address']  ; ?>" class="form-control" placeholder="Enter address">
            </div>
            <div class="col-md-6">
              <label class="form-label">Birthday</label>
              <input type="date" name="birthday" value="<?= $profile['birthday']  ; ?>" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Gender</label>
              <select name="gender" class="form-select">
                <option value="">Select gender</option>
                <option value="Male" <?= ($profile['gender']  ) === 'Male' ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?= ($profile['gender']  ) === 'Female' ? 'selected' : ''; ?>>Female</option>
                <option value="Other" <?= ($profile['gender']  ) === 'Other' ? 'selected' : ''; ?>>Other</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Course / Department</label>
              <input type="text" name="course" value="<?= $profile['course']  ; ?>" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Emergency Contact</label>
              <input type="text" name="emergency_contact" value="<?= $profile['emergency_contact']  ; ?>" class="form-control">
            </div>
            <div class="col-md-12">
              <label class="form-label">About Me</label>
              <textarea name="about" class="form-control" rows="3"><?= $profile['about']  ; ?></textarea>
            </div>
            <div class="col-md-12">
              <label class="form-label">Social Links</label>
              <input type="text" name="facebook" value="<?= $profile['facebook']  ; ?>" placeholder="Facebook URL" class="form-control mb-2">
              <input type="text" name="linkedin" value="<?= $profile['linkedin']  ; ?>" placeholder="LinkedIn URL" class="form-control mb-2">
              <input type="text" name="github" value="<?= $profile['github']  ; ?>" placeholder="GitHub URL" class="form-control">
            </div>
          
          
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save Changes</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="<?= BASE_URL; ?>/public/js/alert.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
