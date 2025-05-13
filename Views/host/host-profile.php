<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Host Profile - WanderNest</title>
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
        .calendar-day {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            cursor: pointer;
        }
        .calendar-day.available {
            background-color: #198754;
            color: white;
        }
        .calendar-day.unavailable {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.html">
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
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" class="rounded-circle" width="30" height="30">
                            Maria Garcia
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="host-profile.html">My Profile</a></li>
                            <li><a class="dropdown-item" href="settings.html">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="login.html">Logout</a></li>
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
        <img src="https://randomuser.me/api/portraits/women/32.jpg" class="profile-avatar rounded-circle">
    </div>

    <!-- Profile Content -->
    <div class="container mt-5">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-4">
                <div class="section-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Maria Garcia</h4>
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-edit me-2"></i>Edit
                        </button>
                    </div>
                    <p class="text-muted mb-3">
                        <i class="fas fa-map-marker-alt me-2"></i>Barcelona, Spain
                    </p>
                    <div class="profile-stats mb-3">
                        <div class="row text-center">
                            <div class="col">
                                <h5>24</h5>
                                <small class="text-muted">Volunteers</small>
                            </div>
                            <div class="col">
                                <h5>18</h5>
                                <small class="text-muted">Reviews</small>
                            </div>
                            <div class="col">
                                <h5>4.9</h5>
                                <small class="text-muted">Rating</small>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100 mb-3">
                        <i class="fas fa-plus me-2"></i>Add New Listing
                    </button>
                </div>

                <div class="section-card">
                    <h5 class="mb-3">Quick Links</h5>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-calendar me-2"></i>Availability Calendar
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-users me-2"></i>Current Volunteers
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-star me-2"></i>Reviews
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
                                About Us
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#listings">
                                My Listings
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#calendar">
                                Calendar
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#reviews">
                                Reviews
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- About Us Tab -->
                        <div class="tab-pane fade show active" id="about">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>About Us</h5>
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-edit me-2"></i>Edit
                                </button>
                            </div>
                            <p>Welcome to our organic farm and homestay in Barcelona! We're a family of four passionate about sustainable living and cultural exchange.</p>
                            
                            <h6 class="mt-4 mb-3">Help Needed</h6>
                            <div class="d-flex flex-wrap gap-2 mb-4">
                                <span class="badge bg-primary">Gardening</span>
                                <span class="badge bg-primary">Teaching</span>
                                <span class="badge bg-primary">Cooking</span>
                                <span class="badge bg-primary">Childcare</span>
                            </div>

                            <h6 class="mt-4 mb-3">Accommodation</h6>
                            <p>Private room with shared bathroom. Three meals per day included. Free WiFi and laundry facilities available.</p>
                        </div>

                        <!-- My Listings Tab -->
                        <div class="tab-pane fade" id="listings">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5>My Listings</h5>
                                <button class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-2"></i>Add Listing
                                </button>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="mb-1">Organic Farm & Homestay</h6>
                                            <p class="text-muted mb-2">Barcelona, Spain</p>
                                            <span class="badge bg-success">Active</span>
                                        </div>
                                        <div>
                                            <button class="btn btn-outline-primary btn-sm me-2">Edit</button>
                                            <button class="btn btn-outline-danger btn-sm">Deactivate</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more listing cards here -->
                        </div>

                        <!-- Calendar Tab -->
                        <div class="tab-pane fade" id="calendar">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5>Availability Calendar</h5>
                                <div>
                                    <button class="btn btn-outline-primary btn-sm me-2">
                                        <i class="fas fa-plus me-2"></i>Add Dates
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-download me-2"></i>Export
                                    </button>
                                </div>
                            </div>
                            <div class="calendar-container">
                                <!-- Calendar will be dynamically generated -->
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="calendar-day available">1</div>
                                    <div class="calendar-day available">2</div>
                                    <div class="calendar-day unavailable">3</div>
                                    <!-- Add more calendar days -->
                                </div>
                            </div>
                        </div>

                        <!-- Reviews Tab -->
                        <div class="tab-pane fade" id="reviews">
                            <h5 class="mb-4">Reviews from Volunteers</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://randomuser.me/api/portraits/men/45.jpg" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="mb-0">John Smith</h6>
                                            <small class="text-muted">Volunteer from USA</small>
                                        </div>
                                    </div>
                                    <p class="mb-2">Amazing experience! The family was very welcoming and I learned a lot about organic farming.</p>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../../vendor/js/bootstrap.bundle.min.js"></script>
</body>
</html> 