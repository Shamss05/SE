<?php
session_start();
require_once '../../Controllers/countrycontroller.php';
require_once '../../Controllers/taskscontroller.php';
require_once '../../Controllers/Authcontroller.php';

$auth=new Authcontroller;
$tasks=new taskscontroller;
$userdata=new Countrycontroller;
$auth->auth(null,2);
$result=$userdata->fetch_user_data($_SESSION['user']['id']);
require_once '../../vendor/functions.php';
if(empty($_SESSION['user']['image'])){
$_SESSION['user']['image']="user.png";
}
$all_skills=$tasks->fetch_tasks();
$edit_mode = isset($_GET['edit']) && $_GET['edit'] == 'true';

if(isset($_POST['save_profile'])){
$prefernces=$_POST['preferences'];
$skillsArray = $_POST['skills'];
$skills = implode(',', $skillsArray);
  $auth->update_user_info($prefernces,$skills,$_SESSION['user']['id']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - WanderNest</title>
    <!-- Bootstrap CSS -->
    <link href="../../vendor/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendor/css/all.min.css" rel="stylesheet">
    <style>
        .profile-header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 300px;
            position: relative;
        }
        .profile-avatar {
            width: 150px;
            height: 150px;
            border: 5px solid white;
            position: absolute;
            bottom: -75px;
            left: 50px;
        }
        .profile-stats {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .edit-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .section-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .nav-pills .nav-link.active {
            background-color: #0d6efd;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?=baseurl()?>">
                <i class="fas fa-globe-americas me-2"></i>WanderNest
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="feed.html">Feed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="messages.html">Messages</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                            <img src="<?=baseurl("uploads/").$_SESSION['user']['image']?>" class="rounded-circle" width="30" height="30">
                            <?=$_SESSION['user']['name']?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?=baseurl("Traveler/traveler-profile.php")?>">My Profile</a></li>
                            <li><a class="dropdown-item" href="settings.html">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=baseurl()?>?logout=true">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Header -->
    <div class="profile-header">
        <button class="btn btn-light edit-btn">
            <i class="fas fa-camera me-2"></i>Change Cover
        </button>
        <img src="<?=baseurl("uploads/").$_SESSION['user']['image']?>" class="profile-avatar rounded-circle">
    </div>

    <!-- Profile Content -->
    <div class="container mt-5">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-4">
                <div class="section-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0"><?=$_SESSION['user']['name']?></h4>
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-edit me-2"></i>Edit
                        </button>
                    </div>
                    <p class="text-muted mb-3">
                        <i class="fas fa-map-marker-alt me-2"></i><?=$result['country_name']?>
                    </p>
                    <div class="profile-stats mb-3">
                        <div class="row text-center">
                            <div class="col">
                                <h5>12</h5>
                                <small class="text-muted">Trips</small>
                            </div>
                            <div class="col">
                                <h5>8</h5>
                                <small class="text-muted">Reviews</small>
                            </div>
                            <div class="col">
                                <h5>4.8</h5>
                                <small class="text-muted">Rating</small>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100 mb-3">
                        <i class="fas fa-plus me-2"></i>Add New Trip
                    </button>
                </div>

                <div class="section-card">
                    <h5 class="mb-3">Quick Links</h5>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-heart me-2"></i>Saved Hosts
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-calendar me-2"></i>Upcoming Trips
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-star me-2"></i>My Reviews
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-cog me-2"></i>Account Settings
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-8">
                <div class="section-card">
                    <ul class="nav nav-pills mb-4" id="profileTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#about">
                                About Me
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#trips">
                                My Trips
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#reviews">
                                Reviews
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#photos">
                                Photos
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- About Me Tab -->
                        <div class="tab-pane fade show active" id="about">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>About Me</h5>
                                <a href="?edit=<?= $edit_mode ? 'false' : 'true' ?>" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit me-2"></i><?= $edit_mode ? 'Cancel' : 'Edit' ?>
                                </a>

                            </div>
                             <?php if ($edit_mode): ?>
        <form action="traveler-profile.php" method="POST">
            <div class="mb-3">
                <label for="preferences" class="form-label">Preferences</label>
                <textarea name="preferences" id="preferences" class="form-control" rows="4"><?= htmlspecialchars($result['preferences']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="skills" class="form-label">Skills & Interests</label>
            <select name="skills[]" id="skills" class="form-select" multiple>
        <?php foreach ($all_skills as $skill): ?>
            <option value="<?= $skill['name'] ?>">
                <?= $skill['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <div class="form-text">Hold Ctrl (Windows) or Command (Mac) to select multiple.</div>
            </div>
            <button type="submit" name="save_profile" class="btn btn-primary">Save Changes</button>
        </form>
        <?php else:?>
                      <p><?=$result['preferences']?></p>
                            
                            <h6 class="mt-4 mb-3">Skills & Interests</h6>
                            <div class="d-flex flex-wrap gap-2 mb-4">
                                <span class="badge bg-primary"><?=$result['skills']?></span>
                                <span class="badge bg-primary">Farming</span>
                                <span class="badge bg-primary">Cooking</span>
                                <span class="badge bg-primary">Languages</span>
                            </div>

              
                        </div>

        <?php endif;?>
                            
                        <!-- My Trips Tab -->
                        <div class="tab-pane fade" id="trips">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5>My Trips</h5>
                                <button class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-2"></i>Add Trip
                                </button>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="mb-1">Organic Farm Stay - Bali</h6>
                                            <p class="text-muted mb-2">March 2024 - April 2024</p>
                                            <span class="badge bg-success">Confirmed</span>
                                        </div>
                                        <button class="btn btn-outline-primary btn-sm">View Details</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more trip cards here -->
                        </div>

                        <!-- Reviews Tab -->
                        <div class="tab-pane fade" id="reviews">
                            <h5 class="mb-4">Reviews from Hosts</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://randomuser.me/api/portraits/women/45.jpg" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0">Maria Garcia</h6>
                                            <small class="text-muted">Host in Spain</small>
                                        </div>
                                    </div>
                                    <p class="mb-2">John was an excellent volunteer. Very helpful and respectful.</p>
                                    <div class="text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more review cards here -->
                        </div>

                        <!-- Photos Tab -->
                        <div class="tab-pane fade" id="photos">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5>My Photos</h5>
                                <button class="btn btn-primary btn-sm">
                                    <i class="fas fa-upload me-2"></i>Upload Photos
                                </button>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e" class="img-fluid rounded" alt="Travel Photo">
                                </div>
                                <!-- Add more photo columns here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../../vendor/js/bootstrap.bundle.min.js"></script>
</body>
</html> 