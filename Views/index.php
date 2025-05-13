<?php
 require_once "../vendor/functions.php";
session_start();
if(isset($_GET['logout'])){
session_unset();
session_destroy();
header("Location:./index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WanderNest - Connect with Hosts Worldwide</title>
    <!-- Bootstrap CSS -->
    <link href="../vendor/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="../vendor/css/bootstrap-icons.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../images/hero/hero-main.jpg');
            background-size: cover;
            background-position: center;
            height: 80vh;
            display: flex;
            align-items: center;
            color: white;
            margin-top: 56px; /* Added to account for fixed navbar */
        }
        .search-bar {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 10px;
        }
        .step-icon {
            font-size: 2.5rem;
            color: #0d6efd;
            margin-bottom: 1rem;
        }
        .testimonial-card {
            height: 100%;
        }
        .featured-destination {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }
        .featured-destination img {
            transition: transform 0.3s ease;
        }
        .featured-destination:hover img {
            transform: scale(1.1);
        }
        .destination-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.7));
            padding: 1rem;
            color: white;
        }
        .navbar {
            background-color: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .nav-item .btn {
            padding: 0.375rem 1.5rem;
        }
        .dropdown-menu {
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-globe me-2"></i>WanderNest
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?=baseurl()?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=baseurl("Traveler/hosts.php")?>">Find Hosts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="how-it-works.html">How It Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="complaints.html">
                            Complaints
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="feed.html">
                            Feed
                        </a>
                    </li>
                    
                </ul>
                <div class="d-flex">
                    <a href="favorites.html" class="btn btn-outline-primary me-2">
                        <i class="bi bi-heart me-1"></i>Favorites
                    </a>
                    <?php if(isset($_SESSION['user'])):?>
                    <a href="<?=baseurl("Traveler/traveler-profile.php")?>" class="btn btn-outline-primary me-2">
                        <i class="bi bi-person me-1"></i>Profile
                    </a>
                    <?php elseif(isset($_SESSION['host'])):?>
                    <a href="./Host/host-profile.html" class="btn btn-outline-primary me-2">
                        <i class="bi bi-person me-1"></i>Profile
                    </a>
                    <?php endif;?>
                    <?php if(!isset($_SESSION['user'])&&!isset($_SESSION['host'])):?>
                    <a href="./auth/login.php" class="btn btn-outline-primary me-2">Login</a>
                    <a href="./auth/register.php" class="btn btn-primary">Sign Up</a>
                    <?php else:?>
                    <a href="./index.php?logout=true" class="btn btn-danger">Log out</a>

                    <?php endif;?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 mb-4">Discover Meaningful Travel Experiences</h1>
                    <p class="lead mb-4">Connect with hosts worldwide and exchange your skills for accommodation</p>
                    <div class="search-bar">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" placeholder="Where do you want to go?">
                            <button class="btn btn-primary btn-lg" type="button">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">How It Works</h2>
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="step-icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <h3>Find Your Host</h3>
                    <p>Browse through thousands of hosts offering unique experiences worldwide</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="step-icon">
                        <i class="bi bi-hand-thumbs-up"></i>
                    </div>
                    <h3>Connect & Agree</h3>
                    <p>Message hosts, discuss expectations, and agree on the exchange</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="step-icon">
                        <i class="bi bi-airplane"></i>
                    </div>
                    <h3>Start Your Journey</h3>
                    <p>Travel to your destination and begin your cultural exchange</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Destinations -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Featured Destinations</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <a href="hosts.html?location=bali" class="text-decoration-none">
                        <div class="featured-destination">
                            <img src="../images/destinations/bali.jpg" class="img-fluid" alt="Bali">
                            <div class="destination-overlay">
                                <h4 class="text-white">Bali, Indonesia</h4>
                                <p class="text-white mb-0">
                                    12 hosts available
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="hosts.html?location=lisbon" class="text-decoration-none">
                        <div class="featured-destination">
                            <img src="../images/destinations/lisbon.jpg" class="img-fluid" alt="Portugal">
                            <div class="destination-overlay">
                                <h4 class="text-white">Lisbon, Portugal</h4>
                                <p class="text-white mb-0">
                                    8 hosts available
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="hosts.html?location=chiang-mai" class="text-decoration-none">
                        <div class="featured-destination">
                            <img src="../images/destinations/chiang-mai.jpg" class="img-fluid" alt="Thailand">
                            <div class="destination-overlay">
                                <h4 class="text-white">Chiang Mai, Thailand</h4>
                                <p class="text-white mb-0">
                                    15 hosts available
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Find Travel Buddy Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="mb-4">Find Your Perfect Travel Buddy</h2>
                    <p class="lead mb-4">Connect with fellow travelers who share your interests and travel plans. Make your journey more memorable by sharing it with like-minded adventurers.</p>
                    <div class="d-flex gap-3 mb-4">
                        <div class="text-center">
                            <i class="bi bi-person text-primary mb-2" style="font-size: 2em;"></i>
                            <h5>Connect</h5>
                            <p class="text-muted">Find travel companions worldwide</p>
                        </div>
                        <div class="text-center">
                            <i class="bi bi-calendar text-primary mb-2" style="font-size: 2em;"></i>
                            <h5>Plan</h5>
                            <p class="text-muted">Match travel dates and destinations</p>
                        </div>
                        <div class="text-center">
                            <i class="bi bi-share text-primary mb-2" style="font-size: 2em;"></i>
                            <h5>Share</h5>
                            <p class="text-muted">Split costs and experiences</p>
                        </div>
                    </div>
                    <a href="travel-buddy.html" class="btn btn-primary btn-lg">Find a Travel Buddy</a>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="../images/destinations/travel-buddy.jpg" class="img-fluid rounded shadow-lg" alt="Travel Buddies">
                        <div class="position-absolute top-0 start-0 translate-middle p-3 bg-white rounded-circle shadow">
                            <i class="bi bi-map-fill text-primary" style="font-size: 2em;"></i>
                        </div>
                        <div class="position-absolute bottom-0 end-0 translate-middle p-3 bg-white rounded-circle shadow">
                            <i class="bi bi-heart-fill text-danger" style="font-size: 2em;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">What Our Community Says</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card testimonial-card">
                        <div class="card-body">
                            <p class="card-text">"I spent 3 months in Spain helping with an organic farm. The experience was life-changing!"</p>
                            <div class="d-flex align-items-center">
                                <img src="../images/testimonials/sarah.jpg" class="rounded-circle me-3" width="50" alt="Sarah">
                                <div>
                                    <h6 class="mb-0">Sarah M.</h6>
                                    <small class="text-muted">Traveler from Canada</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card testimonial-card">
                        <div class="card-body">
                            <p class="card-text">"Hosting travelers has brought so much joy and cultural exchange to our family."</p>
                            <div class="d-flex align-items-center">
                                <img src="../images/testimonials/carlos.jpg" class="rounded-circle me-3" width="50" alt="Carlos">
                                <div>
                                    <h6 class="mb-0">Carlos R.</h6>
                                    <small class="text-muted">Host from Spain</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card testimonial-card">
                        <div class="card-body">
                            <p class="card-text">"The platform made it easy to find the perfect host for my teaching skills."</p>
                            <div class="d-flex align-items-center">
                                <img src="../images/testimonials/emma.jpg" class="rounded-circle me-3" width="50" alt="Emma">
                                <div>
                                    <h6 class="mb-0">Emma L.</h6>
                                    <small class="text-muted">Traveler from Australia</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-4">Ready to Start Your Journey?</h2>
            <p class="lead mb-4">Join our community of travelers and hosts today</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#" class="btn btn-light btn-lg">Sign Up as Traveler</a>
                <a href="#" class="btn btn-outline-light btn-lg">Become a Host</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
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
                        <li><a href="about.html" class="text-white">About Us</a></li>
                        <li><a href="safety-guidelines.html" class="text-white">Safety Guidelines</a></li>
                        <li><a href="contact.html" class="text-white">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-camera"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-bullseye"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="../vendor/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                if (this.getAttribute('href').length > 1) { // Ignore single # links
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Update navigation based on login status
        function updateNavigation() {
            // Here you would typically check if the user is logged in
            const isLoggedIn = false;
            const userRole = null; // 'traveler' or 'host'

            if (isLoggedIn) {
                // Update navigation for logged-in users
                document.getElementById('loginBtn').innerHTML = `
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>My Account
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                            <li><a class="dropdown-item" href="messages.html">Messages</a></li>
                            ${userRole === 'host' ? '<li><a class="dropdown-item" href="my-listings.html">My Listings</a></li>' : ''}
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" onclick="logout()">Log Out</a></li>
                        </ul>
                    </div>
                `;
            }
        }

        // Call updateNavigation when the page loads
        document.addEventListener('DOMContentLoaded', updateNavigation);

        // Logout function
        function logout() {
            // Here you would typically handle the logout process
            alert('Logging out...');
            window.location.href = 'index.html';
        }
    </script>
</body>
</html> 