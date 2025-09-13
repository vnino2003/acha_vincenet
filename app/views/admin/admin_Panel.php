      <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
    body, html {
        height: 100%;
        margin: 0;
    }
    .sidebar {
        min-width: 220px;
        max-width: 220px;
        height: 100vh;
        display: flex;
        flex-direction: column;
        padding: 1rem;
        background: #0d6efd;
    }
    .sidebar a {
        display: block;
        padding: 0.9rem 1rem;
        color: white;
        text-decoration: none;
        margin-bottom: 0.4rem;
        border-radius: 0.5rem;
        transition: all 0.3s;
        font-weight: 500;
    }
    .sidebar a:hover, .sidebar a.active {
        background-color: #fff;
        color: #0d6efd;
    }
    .content {
        flex: 1;
        padding: 1.5rem;
        overflow-x: auto;
        background: #f8f9fa;
    }
    .table-container { 
        max-height: 500px; 
        overflow-y: auto; 
    }
    .action-btn {
        margin: 0 2px;
        padding: 0.35rem 0.75rem;
        font-size: 0.85rem;
        border-radius: 0.4rem;
    }

    
</style>
</head>
<body>

<div class="d-flex">

    <!-- <?=site_url();?> -->
    <div class="sidebar">
        <a href="#" class="active">Home</a>
        <a href="#'>">User</a>
        <a href="#">Product</a>
        <a href="#">Reports</a>
        <a href="#">Settings</a>
    </div>

    <div class="content">

        	
	</form>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-semibold">Users Management</h3>
          
        </div>
        <div class="d-flex justify-content-between align-items-center mb-4">
                <form action="<?=site_url('admin');?>" method="get" class="col-sm-4 float-end d-flex">
                            <?php
                            $q = '';
                            if(isset($_GET['q'])) {
                                $q = $_GET['q'];
                            }
                            ?>
                <input class="form-control me-2" name="q" type="text" placeholder="Search" value="<?=html_escape($q);?>">
                <button type="submit" class="btn btn-primary" type="button">Search</button>
            </form>
              <a href="<?=site_url('user/registerForm');?>" class="btn btn-success">+ Add New User</a>
        </div>
        <?php getMessage(); ?>

      
        <div class="table-container table-responsive">
            <table class="table table-striped table-hover align-middle shadow-sm bg-white rounded">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                    <?php if (!empty($getAll)): ?>
                        <?php foreach($getAll as $user): ?>
                        <tr>
                            <td><?=html_escape($user['id']);?></td>
                            <td><?=html_escape($user['first_name']);?></td>
                            <td><?=html_escape($user['last_name']);?></td>
                            <td><?=html_escape($user['username']);?></td>
                            <td><?=html_escape($user['email']);?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary action-btn" data-bs-toggle="modal" data-bs-target="#editModal<?=$user['id'];?>">Edit</button>
                                <button class="btn btn-sm btn-outline-danger action-btn" data-bs-toggle="modal" data-bs-target="#deleteModal<?=$user['id'];?>">Delete</button>
                            </td>
                        </tr>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal<?=$user['id'];?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Confirm Delete</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete <strong><?=html_escape($user['first_name'].' '.$user['last_name']);?></strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="<?=site_url('admin-delete/'.$user['id']);?>" method="POST" style="display:inline;">
                                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?=$user['id'];?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="<?=site_url('admin-edit/'.$user['id']);?>" method="POST">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Edit User</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?=html_escape($user['id']);?>">
                                            <div class="mb-3">
                                                <label class="form-label">First Name</label>
                                                <input type="text" name="first_name" class="form-control" value="<?=html_escape($user['first_name']);?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" name="last_name" class="form-control" value="<?=html_escape($user['last_name']);?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Username</label>
                                                <input type="text" name="username" class="form-control" value="<?=html_escape($user['username']);?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" value="<?=html_escape($user['email']);?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            <?php
              
                echo $page;
            ?>
        </div>
    </div>
</div>

<script src="<?= BASE_URL; ?>/public/js/alert.js"></script>
</body>
</html>
