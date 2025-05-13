<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Host Profile - WanderNest</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .profile-header {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        .cover-photo {
            height: 300px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .host-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            margin-top: -50px;
            margin-left: 2rem;
        }
        .rating {
            color: #ffc107;
        }
        .help-tag {
            font-size: 0.9rem;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            display: inline-block;
            background-color: #e9ecef;
        }
        .section-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            padding: 1.5rem;
        }
        .gallery-item {
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .review-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
        }
        .review-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .availability-badge {
            background-color: #e9ecef;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.9rem;
            display: inline-block;
        }
        .contact-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
        }
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            width: 100%;
        }
        .calendar-header {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #6c757d;
        }
        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }
        .calendar-day {
            position: relative;
            cursor: pointer;
            transition: all 0.2s;
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 0.9rem;
            min-width: 30px;
            min-height: 30px;
            margin: 2px;
        }
        .calendar-day:hover:not(.empty) {
            transform: scale(1.1);
        }
        .calendar-day.today {
            border: 2px solid #0d6efd;
        }
        .calendar-day.available {
            background-color: #d1e7dd;
            color: #0f5132;
        }
        .calendar-day.limited {
            background-color: #fff3cd;
            color: #856404;
        }
        .calendar-day.unavailable {
            background-color: #f8d7da;
            color: #842029;
            cursor: not-allowed;
        }
        .calendar-day.empty {
            color: #dee2e6;
            cursor: default;
        }
        .calendar-navigation {
            background-color: #f8f9fa;
            padding: 0.5rem;
            border-radius: 8px;
        }
        .availability-stats {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
        }
        .stat-item {
            padding: 0.5rem;
        }
        .stat-item h4 {
            color: #0d6efd;
        }
        .booking-info {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
        }
        .quick-stats-bar {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
        }
        .stat-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .calendar-day::after {
            content: attr(data-bs-title);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 5px;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s;
        }
        .calendar-day:hover::after {
            opacity: 1;
            visibility: visible;
            bottom: calc(100% + 5px);
        }
        .booking-requirements {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <i class="fas fa-globe-americas me-2"></i>WanderNest
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="hosts.html">Find Hosts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="opportunities.html">Opportunities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html#how-it-works">How It Works</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="favorites.html" class="btn btn-outline-primary me-2">
                        <i class="fas fa-heart me-1"></i>Favorites
                    </a>
                    <a href="login.html" class="btn btn-outline-primary me-2">Login</a>
                    <a href="register.html" class="btn btn-primary">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Add padding for fixed navbar -->
    <div style="padding-top: 76px;">
        <div class="container">
            <!-- Profile Header -->
            <div class="profile-header">
                <img src="https://images.unsplash.com/photo-1500076656116-558758c991c1" class="cover-photo w-100" alt="Cover Photo">
                <div class="d-flex align-items-center p-4">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" class="host-avatar" alt="Host">
                    <div class="ms-4">
                        <h1 class="mb-1">Maria & Giovanni</h1>
                        <p class="text-muted mb-2">
                            <i class="fas fa-map-marker-alt me-1"></i>Tuscany, Italy
                        </p>
                        <div class="rating mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span class="ms-1 text-muted">(4.5) 28 reviews</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="availability-badge">
                                <i class="fas fa-calendar-check me-1"></i>Available Now
                            </span>
                            <a href="chat.html" class="btn btn-primary">
                                <i class="fas fa-comments me-1"></i>Chat with Host
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Left Column -->
                <div class="col-lg-8">
                    <!-- About Section -->
                    <div class="section-card">
                        <h3 class="mb-4">About Us</h3>
                        <p>Welcome to our family-run organic farm in the heart of Tuscany! We are Maria and Giovanni, a couple passionate about sustainable farming and sharing our Italian culture with travelers from around the world.</p>
                        <p>Our farm has been in the family for generations, and we take pride in maintaining traditional farming practices while incorporating modern sustainable techniques. We grow a variety of organic vegetables, fruits, and olives, and produce our own olive oil and wine.</p>
                        <p>We love hosting volunteers who are interested in learning about organic farming, Italian culture, and sustainable living. In exchange for your help, we offer comfortable accommodation, delicious home-cooked meals, and an authentic Italian experience.</p>
                    </div>

                    <!-- Help Section -->
                    <div class="section-card">
                        <h3 class="mb-4">Help Needed</h3>
                        <div class="mb-4">
                            <span class="help-tag"><i class="fas fa-seedling me-1"></i>Farming</span>
                            <span class="help-tag"><i class="fas fa-utensils me-1"></i>Cooking</span>
                            <span class="help-tag"><i class="fas fa-wine-bottle me-1"></i>Wine Making</span>
                            <span class="help-tag"><i class="fas fa-tree me-1"></i>Gardening</span>
                        </div>
                        <p>We need help with various farm activities, including:</p>
                        <ul>
                            <li>Planting and harvesting vegetables</li>
                            <li>Olive harvesting and processing</li>
                            <li>Grape harvesting and wine making</li>
                            <li>General farm maintenance</li>
                            <li>Preparing traditional Italian meals</li>
                        </ul>
                        <p><strong>Duration:</strong> 2-4 weeks</p>
                        <p><strong>Hours per day:</strong> 4-5 hours, 5 days a week</p>
                    </div>

                    <!-- Accommodation Section -->
                    <div class="section-card">
                        <h3 class="mb-4">Accommodation</h3>
                        <p>We offer comfortable accommodation in our traditional Tuscan farmhouse. Volunteers stay in a private room with shared bathroom facilities. The house is equipped with modern amenities while maintaining its rustic charm.</p>
                        <p>All meals are provided and are made with fresh ingredients from our farm. We love cooking together and sharing our traditional recipes!</p>
                    </div>

                    <!-- Gallery Section -->
                    <div class="section-card">
                        <h3 class="mb-4">Photo Gallery</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <img src="https://images.unsplash.com/photo-1500076656116-558758c991c1" class="gallery-item w-100" alt="Farm">
                            </div>
                            <div class="col-md-4">
                                <img src="https://images.unsplash.com/photo-1518546305927-5a555bb7020d" class="gallery-item w-100" alt="Accommodation">
                            </div>
                            <div class="col-md-4">
                                <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4" class="gallery-item w-100" alt="Activities">
                            </div>
                        </div>
                    </div>

                    <!-- Reviews Section -->
                    <div class="section-card">
                        <h3 class="mb-4">Reviews</h3>
                        <!-- Review 1 -->
                        <div class="review-card p-3 mb-3">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://randomuser.me/api/portraits/women/32.jpg" class="review-avatar me-3" alt="Reviewer">
                                <div>
                                    <h5 class="mb-0">Sarah M.</h5>
                                    <small class="text-muted">From Canada - Stayed 3 weeks</small>
                                </div>
                            </div>
                            <div class="rating mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p>"An amazing experience! Maria and Giovanni are wonderful hosts who made me feel like part of the family. I learned so much about organic farming and Italian culture. The food was incredible, and the location is beautiful. Highly recommend!"</p>
                        </div>
                        <!-- Review 2 -->
                        <div class="review-card p-3">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://randomuser.me/api/portraits/men/45.jpg" class="review-avatar me-3" alt="Reviewer">
                                <div>
                                    <h5 class="mb-0">James L.</h5>
                                    <small class="text-muted">From Australia - Stayed 2 weeks</small>
                                </div>
                            </div>
                            <div class="rating mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <p>"Great experience learning about organic farming and Italian culture. The work was rewarding, and the hosts were very welcoming. The location is perfect for exploring Tuscany on weekends."</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-lg-4">
                    <!-- Quick Info Card -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Quick Info</h5>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    <strong>Response Time:</strong> Usually within 24 hours
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-calendar-check text-primary me-2"></i>
                                    <strong>Last Active:</strong> 2 hours ago
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-users text-primary me-2"></i>
                                    <strong>Hosting Since:</strong> 2018
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-star text-primary me-2"></i>
                                    <strong>Response Rate:</strong> 98%
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Availability Calendar -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Availability</h5>
                            
                            <!-- Quick Stats Bar -->
                            <div class="quick-stats-bar mb-4">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="stat-card bg-light p-3 rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="stat-icon bg-primary text-white rounded-circle me-3">
                                                    <i class="fas fa-calendar-check"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Next Available</h6>
                                                    <small class="text-muted">June 1, 2024</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="stat-card bg-light p-3 rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="stat-icon bg-success text-white rounded-circle me-3">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Response Time</h6>
                                                    <small class="text-muted">Within 24 hours</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Availability Stats with Progress Bars -->
                            <div class="availability-stats mb-4">
                                <div class="row text-center">
                                    <div class="col-4">
                                        <div class="stat-item">
                                            <h4 class="mb-0">85%</h4>
                                            <small class="text-muted">Available</small>
                                            <div class="progress mt-2" style="height: 4px;">
                                                <div class="progress-bar bg-success" style="width: 85%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-item">
                                            <h4 class="mb-0">12%</h4>
                                            <small class="text-muted">Limited</small>
                                            <div class="progress mt-2" style="height: 4px;">
                                                <div class="progress-bar bg-warning" style="width: 12%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-item">
                                            <h4 class="mb-0">3%</h4>
                                            <small class="text-muted">Booked</small>
                                            <div class="progress mt-2" style="height: 4px;">
                                                <div class="progress-bar bg-danger" style="width: 3%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Calendar Navigation with Month Selector -->
                            <div class="calendar-navigation d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-outline-secondary" id="prevMonth">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <h6 class="mb-0" id="currentMonth">June 2024</h6>
                                    <button class="btn btn-sm btn-outline-secondary" id="nextMonth">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                                <button class="btn btn-sm btn-outline-primary" id="todayBtn">
                                    <i class="fas fa-calendar-alt me-1"></i>Today
                                </button>
                            </div>

                            <!-- Calendar Grid with Tooltips -->
                            <div class="calendar mb-3">
                                    <div class="calendar-days" id="calendarDays">
                                        <!-- Calendar days will be dynamically generated -->
                                    </div>
                            </div>

                            <!-- Enhanced Availability Legend -->
                            <div class="availability-legend mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="badge bg-success">
                                        <i class="fas fa-circle me-1"></i>Available (2+ spots)
                                    </span>
                                    <span class="badge bg-warning">
                                        <i class="fas fa-circle me-1"></i>Limited (1 spot)
                                    </span>
                                    <span class="badge bg-danger">
                                        <i class="fas fa-circle me-1"></i>Fully Booked
                                    </span>
                                </div>
                            </div>

                            <!-- Booking Requirements -->
                            <div class="booking-requirements mb-3">
                                <h6 class="mb-2">Booking Requirements</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-clock me-1"></i>Min. 2 weeks
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-user me-1"></i>Max. 2 volunteers
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-calendar me-1"></i>Book 2 weeks ahead
                                    </span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal">
                                    <i class="fas fa-calendar-plus me-2"></i>Check Availability
                                </button>
                                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#notifyModal">
                                    <i class="fas fa-bell me-2"></i>Notify Me When Available
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Similar Hosts -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Similar Hosts</h5>
                            <div class="similar-host mb-3">
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/women/45.jpg" class="rounded-circle me-2" width="40" alt="Similar Host">
                                    <div>
                                        <h6 class="mb-0">Anna's Farm</h6>
                                        <small class="text-muted">Tuscany, Italy</small>
                                    </div>
                                </div>
                                <div class="text-warning mt-2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <small class="text-muted">(4.0)</small>
                                </div>
                            </div>
                            <div class="similar-host mb-3">
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/men/75.jpg" class="rounded-circle me-2" width="40" alt="Similar Host">
                                    <div>
                                        <h6 class="mb-0">Organic Vineyard</h6>
                                        <small class="text-muted">Provence, France</small>
                                    </div>
                                </div>
                                <div class="text-warning mt-2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <small class="text-muted">(4.5)</small>
                                </div>
                            </div>
                            <a href="hosts.html?similar=1" class="btn btn-outline-primary w-100">View More Similar Hosts</a>
                        </div>
                    </div>

                    <!-- Safety Tips -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Safety Tips</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Always communicate through our platform
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Never send money before meeting
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Meet in public places first
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Trust your instincts
                                </li>
                            </ul>
                            <a href="#" class="btn btn-link p-0">Learn more about safety</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Button -->
    <button class="btn btn-primary btn-lg rounded-circle contact-btn">
        <i class="fas fa-envelope"></i>
    </button>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Contact button functionality
        document.querySelector('.contact-btn').addEventListener('click', function() {
            document.querySelector('.section-card.sticky-top').scrollIntoView({
                behavior: 'smooth'
            });
        });
    </script>

    <!-- Availability Modal -->
    <div class="modal fade" id="availabilityModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Availability Calendar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="calendar-container">
                        <!-- Full calendar would be implemented here -->
                        <p class="text-center">Full calendar view coming soon...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Check Availability</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Select Dates</label>
                            <div class="input-group">
                                <input type="date" class="form-control" placeholder="Start Date">
                                <span class="input-group-text">to</span>
                                <input type="date" class="form-control" placeholder="End Date">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Number of Volunteers</label>
                            <select class="form-select">
                                <option value="1">1 Volunteer</option>
                                <option value="2">2 Volunteers</option>
                                <option value="3">3 Volunteers</option>
                                <option value="4">4 Volunteers</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Special Requirements</label>
                            <textarea class="form-control" rows="3" placeholder="Any special requirements or questions?"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Check Availability</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Notify Modal -->
    <div class="modal fade" id="notifyModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Get Notified</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Preferred Dates</label>
                            <div class="input-group">
                                <input type="date" class="form-control" placeholder="Start Date">
                                <span class="input-group-text">to</span>
                                <input type="date" class="form-control" placeholder="End Date">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Number of Volunteers</label>
                            <select class="form-select">
                                <option value="1">1 Volunteer</option>
                                <option value="2">2 Volunteers</option>
                            </select>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="flexibleDates">
                            <label class="form-check-label" for="flexibleDates">
                                I'm flexible with dates
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Subscribe to Notifications</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>WanderNest</h5>
                    <p>Connecting travelers with hosts worldwide for meaningful cultural exchanges.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">About Us</a></li>
                        <li><a href="#" class="text-white">Safety Guidelines</a></li>
                        <li><a href="#" class="text-white">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Calendar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const calendarDays = document.getElementById('calendarDays');
            const currentMonth = document.getElementById('currentMonth');
            const prevMonthBtn = document.getElementById('prevMonth');
            const nextMonthBtn = document.getElementById('nextMonth');
            const todayBtn = document.getElementById('todayBtn');

            let currentDate = new Date();
            let currentMonthIndex = currentDate.getMonth();
            let currentYear = currentDate.getFullYear();

            // Sample availability data (in a real app, this would come from your backend)
            const availabilityData = {
                '2024-06-01': { status: 'available', spots: 2 },
                '2024-06-02': { status: 'available', spots: 2 },
                '2024-06-03': { status: 'available', spots: 2 },
                '2024-06-04': { status: 'limited', spots: 1 },
                '2024-06-05': { status: 'limited', spots: 1 },
                '2024-06-06': { status: 'unavailable', spots: 0 },
                '2024-06-07': { status: 'unavailable', spots: 0 },
                '2024-06-08': { status: 'available', spots: 2 },
                '2024-06-09': { status: 'available', spots: 2 },
                '2024-06-10': { status: 'available', spots: 2 },
                '2024-06-11': { status: 'available', spots: 2 },
                '2024-06-12': { status: 'available', spots: 2 },
                '2024-06-13': { status: 'available', spots: 2 },
                '2024-06-14': { status: 'available', spots: 2 },
                '2024-06-15': { status: 'available', spots: 2 },
                '2024-06-16': { status: 'available', spots: 2 },
                '2024-06-17': { status: 'available', spots: 2 },
                '2024-06-18': { status: 'available', spots: 2 },
                '2024-06-19': { status: 'available', spots: 2 },
                '2024-06-20': { status: 'available', spots: 2 },
                '2024-06-21': { status: 'available', spots: 2 },
                '2024-06-22': { status: 'available', spots: 2 },
                '2024-06-23': { status: 'available', spots: 2 },
                '2024-06-24': { status: 'available', spots: 2 },
                '2024-06-25': { status: 'available', spots: 2 },
                '2024-06-26': { status: 'available', spots: 2 },
                '2024-06-27': { status: 'available', spots: 2 },
                '2024-06-28': { status: 'available', spots: 2 },
                '2024-06-29': { status: 'available', spots: 2 },
                '2024-06-30': { status: 'available', spots: 2 }
            };

            function updateCalendar() {
                // Clear previous calendar
                calendarDays.innerHTML = '';

                // Get first day of the month
                const firstDay = new Date(currentYear, currentMonthIndex, 1);
                const lastDay = new Date(currentYear, currentMonthIndex + 1, 0);
                
                // Get the day of the week for the first day (0-6)
                const firstDayIndex = firstDay.getDay();
                
                // Add empty cells for days before the first day of the month
                for (let i = firstDayIndex - 1; i >= 0; i--) {
                    const prevMonthDay = new Date(currentYear, currentMonthIndex, -i);
                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day empty';
                    dayElement.textContent = prevMonthDay.getDate();
                    dayElement.setAttribute('data-bs-toggle', 'tooltip');
                    dayElement.setAttribute('title', 'Previous month');
                    calendarDays.appendChild(dayElement);
                }

                // Add days of the current month
                for (let day = 1; day <= lastDay.getDate(); day++) {
                    const date = new Date(currentYear, currentMonthIndex, day);
                    const dateString = date.toISOString().split('T')[0];
                    const availability = availabilityData[dateString] || { status: 'available', spots: 2 };
                    
                    const dayElement = document.createElement('div');
                    dayElement.className = `calendar-day ${availability.status}`;
                    dayElement.textContent = day;
                    
                    // Add today class if the date is today
                    if (date.toDateString() === new Date().toDateString()) {
                        dayElement.classList.add('today');
                    }

                    // Add tooltip with availability information
                    dayElement.setAttribute('data-bs-toggle', 'tooltip');
                    let tooltipText = '';
                    switch(availability.status) {
                        case 'available':
                            tooltipText = `Available - ${availability.spots} spot${availability.spots > 1 ? 's' : ''} left`;
                            break;
                        case 'limited':
                            tooltipText = `Limited - ${availability.spots} spot${availability.spots > 1 ? 's' : ''} left`;
                            break;
                        case 'unavailable':
                            tooltipText = 'Fully booked';
                            break;
                    }
                    dayElement.setAttribute('title', tooltipText);

                    // Add click event for booking
                    dayElement.addEventListener('click', function() {
                        if (availability.status !== 'unavailable') {
                            // Open booking modal with selected date
                            const bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
                            bookingModal.show();
                        }
                    });

                    calendarDays.appendChild(dayElement);
                }

                // Update month and year display
                const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 
                                  'July', 'August', 'September', 'October', 'November', 'December'];
                currentMonth.textContent = `${monthNames[currentMonthIndex]} ${currentYear}`;

                // Reinitialize tooltips
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }

            // Event listeners for navigation
            prevMonthBtn.addEventListener('click', function() {
                currentMonthIndex--;
                if (currentMonthIndex < 0) {
                    currentMonthIndex = 11;
                    currentYear--;
                }
                updateCalendar();
            });

            nextMonthBtn.addEventListener('click', function() {
                currentMonthIndex++;
                if (currentMonthIndex > 11) {
                    currentMonthIndex = 0;
                    currentYear++;
                }
                updateCalendar();
            });

            todayBtn.addEventListener('click', function() {
                currentDate = new Date();
                currentMonthIndex = currentDate.getMonth();
                currentYear = currentDate.getFullYear();
                updateCalendar();
            });

            // Initialize calendar
            updateCalendar();
        });
    </script>
</body>
</html> 