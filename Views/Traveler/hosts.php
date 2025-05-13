<?php
require_once '../../vendor/functions.php';
require_once '../../Controllers/host_listingscontroller.php';
$hostlistings=new host_listingscontroller;
$result=$hostlistings->get_Data();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Hosts - WanderNest</title>
    <!-- Bootstrap CSS -->
    <link href="../../vendor/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendor/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .filters-section {
            background-color: white;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .host-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            margin-bottom: 1.5rem;
            height: 100%;
        }
        .host-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        .cover-photo {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .host-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            margin-top: -25px;
            margin-left: 1rem;
        }
        .help-tag {
            font-size: 0.8rem;
            padding: 0.3rem 0.6rem;
            border-radius: 20px;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            display: inline-block;
            background-color: #e9ecef;
        }
        .rating {
            color: #ffc107;
        }
        .availability-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 0.3rem 0.6rem;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        .view-toggle-btn.active {
            background-color: #0d6efd;
            color: white;
        }
        .map-view {
            display: none;
            height: calc(100vh - 160px);
            background-color: #e9ecef;
            border-radius: 12px;
        }
        .map-view.active {
            display: block;
        }
        .list-view.hidden {
            display: none;
        }
        #searchBar {
            border-radius: 25px;
            padding-left: 1rem;
            padding-right: 3rem;
        }
        .search-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        .wishlist-btn {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #dc3545;
            transition: all 0.2s;
        }
        .wishlist-btn:hover {
            background-color: #dc3545;
            color: white;
        }
        .wishlist-btn.active {
            background-color: #dc3545;
            color: white;
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
                        <a class="nav-link" href="<?=baseurl()?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?=baseurl("Traveler/hosts.php")?>">Find Hosts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="how-it-works.html">How It Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="complaints.html">
                            Complaints
                        </a>
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
        <!-- Filters Section -->
        <div class="filters-section mt-5">
            <div class="container">
                <!-- Search Bar -->
                <div class="row mb-4">
                    <div class="col-md-8 mx-auto">
                        <div class="position-relative">
                            <input type="text" class="form-control form-control-lg" id="searchBar" placeholder="Search by location or keyword">
                            <i class="fas fa-search search-icon"></i>
                        </div>
                    </div>
                </div>

                <!-- Filters and View Toggle -->
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex flex-wrap gap-2">
                            <!-- Country Filter -->
                            <select class="form-select" style="max-width: 200px;">
                                <option value="">All Countries</option>
                                <option value="africa">Africa</option>
                                <option value="asia">Asia</option>
                                <option value="CA">Central America</option>
                                <option value="europe">Europe</option>
                                <option value="ME">Middle East</option>
                                <option value="SA">South America</option>
                                <option value="canada">Canada</option>
                                <option value="CR">Costa Rice</option>
                                <option value="thailand">Thailand</option>
                                <option value="greece">Greece</option>
                                <option value="colombia">Colombia</option>
                                <option value="brazil">Brazil</option>
                                <option value="SA">South Africa</option>
                            </select>
                            
                            <!-- Help Type Filter -->
                            <select class="form-select" style="max-width: 200px;">
                                <option value="">All Help Types</option>
                                <option value="household">Household & Daily Living</option>
                                <option value="gardening">Gardening & Farming</option>
                                <option value="construction">Construction & Maintenance</option>
                                <option value="language">Language & Education</option>
                                <option value="art">Art, Design & Media</option>
                                <option value="hospitality">Hospitality & Tourism</option>
                                <option value="digital">Digital Help</option>
                                <option value="culture">Culture & Community</option>
                            </select>

                            <!-- Duration Filter -->
                            <select class="form-select" style="max-width: 200px;">
                                <option value="">Any Duration</option>
                                <option value="1-2">1-2 weeks</option>
                                <option value="2-4">2-4 weeks</option>
                                <option value="1-3">1-3 months</option>
                                <option value="3+">3+ months</option>
                            </select>

                            <!-- Rating Filter -->
                            <select class="form-select" style="max-width: 200px;">
                                <option value="">Any Rating</option>
                                <option value="4+">4+ Stars</option>
                                <option value="3+">3+ Stars</option>
                                <option value="2+">2+ Stars</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-end gap-2">
                            <!-- Sort Options -->
                            <select class="form-select" style="max-width: 200px;">
                                <option value="newest">Newest First</option>
                                <option value="rating">Highest Rated</option>
                                <option value="reviews">Most Reviews</option>
                                <option value="active">Most Active</option>
                            </select>

                            <!-- View Toggle -->
                            <div class="btn-group">
                                <button class="btn btn-outline-primary view-toggle-btn active" data-view="list">
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mb-5">
            <!-- List View -->
            <div class="list-view">
                <div class="row">
                    <!-- Host Card 1 -->
                     <?php foreach($result as $hostlisting):?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                            <div class="position-relative">
                                <img src="<?=baseurl("uploads/").$hostlisting['img_1']?>" class="card-img-top" alt="Host Location">
                                <button class="btn btn-outline-danger btn-sm rounded-circle wishlist-btn" 
                                        onclick="toggleFavorite('host1', this)" 
                                        data-host-id="host1">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="<?=baseurl("uploads/").$hostlisting['image']?>" class="rounded-circle me-2" width="40" alt="Host">
                                    <div>
                                        <h5 class="card-title mb-0"><?=$hostlisting['name']?></h5>
                                        <small class="text-muted"><?=$hostlisting['country_name']?>
                                        </small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <span class="badge bg-success me-2">Available Now</span>
                                    <div class="text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <small class="text-muted">(4.5)</small>
                                    </div>
                                </div>
                                <p class="card-text"><?=$hostlisting['accommodation_details']?></p>
                                <div class="mb-3">
                                    <span class="badge bg-light text-dark me-1">Farming</span>
                                    <span class="badge bg-light text-dark me-1">Gardening</span>
                                    <span class="badge bg-light text-dark">Cooking</span>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted">Created: <?=$hostlisting['created_at']?></small>
                                    </div>
                                    <div class="d-flex gap-2">
                                      <?php $id=$hostlisting['listing_id']?>
                                        <a href="<?=baseurl('Traveler/host-card.php')."?list_id=$id"?>" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye me-1"></i>View Details
                                        </a>
                                        <a href="<?=baseurl("Traveler/membership.html")?>" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#membershipModal">
                                            <i class="fas fa-comment me-1"></i>Message
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>              
                </div>

            </div>

            <!-- Map View -->
            <div class="map-view">
                <div class="h-100 d-flex align-items-center justify-content-center">
                    <p class="text-muted">Map view coming soon...</p>
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
                        <li><a href="about.html" class="text-white">About Us</a></li>
                        <li><a href="safety-guidelines.html" class="text-white">Safety Guidelines</a></li>
                        <li><a href="contact.html" class="text-white">Contact Us</a></li>
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

    <!-- Bootstrap Bundle with Popper -->
    <script src="../../vendor/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="../../vendor/js/jquery.min.js"></script>
    <script>
        // View Toggle Functionality
        document.querySelectorAll('.view-toggle-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Update button states
                document.querySelectorAll('.view-toggle-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                // Toggle views
                const view = this.dataset.view;
                if (view === 'map') {
                    document.querySelector('.list-view').classList.add('hidden');
                    document.querySelector('.map-view').classList.add('active');
                } else {
                    document.querySelector('.list-view').classList.remove('hidden');
                    document.querySelector('.map-view').classList.remove('active');
                }
            });
        });

        // Favorites functionality
        function toggleFavorite(hostId, button) {
            let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const hostCard = button.closest('.card');
            const hostData = {
                id: hostId,
                name: hostCard.querySelector('.card-title').textContent,
                location: hostCard.querySelector('.text-muted').textContent,
                image: hostCard.querySelector('.card-img-top').src,
                rating: hostCard.querySelector('.text-warning').innerHTML,
                description: hostCard.querySelector('.card-text').textContent,
                availability: hostCard.querySelector('.badge').textContent,
                tags: Array.from(hostCard.querySelectorAll('.badge.bg-light')).map(tag => tag.textContent)
            };

            const index = favorites.findIndex(h => h.id === hostId);
            if (index === -1) {
                // Add to favorites
                favorites.push(hostData);
                button.classList.add('active');
                button.innerHTML = '<i class="fas fa-heart"></i>';
            } else {
                // Remove from favorites
                favorites.splice(index, 1);
                button.classList.remove('active');
                button.innerHTML = '<i class="far fa-heart"></i>';
            }

            localStorage.setItem('favorites', JSON.stringify(favorites));
            updateFavoritesCount();
        }

        // Update favorites count in nav
        function updateFavoritesCount() {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const favLink = document.querySelector('a[href="favorites.html"]');
            favLink.innerHTML = `<i class="fas fa-heart me-1"></i>Favorites (${favorites.length})`;
        }

        // Initialize favorites
        document.addEventListener('DOMContentLoaded', function() {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            
            // Update all heart buttons
            document.querySelectorAll('.wishlist-btn').forEach(button => {
                const hostId = button.getAttribute('data-host-id');
                if (favorites.some(h => h.id === hostId)) {
                    button.classList.add('active');
                    button.innerHTML = '<i class="fas fa-heart"></i>';
                }
            });

            updateFavoritesCount();
        });

        // Search functionality
        document.getElementById('searchBar').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.host-card');
            
            cards.forEach(card => {
                const title = card.querySelector('.card-title').textContent.toLowerCase();
                const location = card.querySelector('.text-muted').textContent.toLowerCase();
                const description = card.querySelector('.card-text').textContent.toLowerCase();
                
                const matches = title.includes(searchTerm) || 
                                location.includes(searchTerm) || 
                                description.includes(searchTerm);
                                
                card.closest('.col-md-6').style.display = matches ? 'block' : 'none';
            });
        });

        // Filter functionality
        document.querySelectorAll('.form-select').forEach(select => {
            select.addEventListener('change', function() {
                const country = document.querySelector('select[class="form-select"]:nth-of-type(1)').value;
                const helpType = document.querySelector('select[class="form-select"]:nth-of-type(2)').value;
                const duration = document.querySelector('select[class="form-select"]:nth-of-type(3)').value;
                const rating = document.querySelector('select[class="form-select"]:nth-of-type(4)').value;

                const cards = document.querySelectorAll('.host-card');
                cards.forEach(card => {
                    let showCard = true;

                    // Filter by country
                    if (country && !card.querySelector('.text-muted').textContent.includes(country)) {
                        showCard = false;
                    }

                    // Filter by help type
                    if (helpType) {
                        const tags = card.querySelectorAll('.help-tag');
                        let hasType = false;
                        tags.forEach(tag => {
                            if (tag.textContent.toLowerCase().includes(helpType.toLowerCase())) {
                                hasType = true;
                            }
                        });
                        if (!hasType) showCard = false;
                    }

                    // Filter by duration
                    if (duration) {
                        const cardDuration = card.querySelector('small.text-muted').textContent;
                        if (!cardDuration.includes(duration)) {
                            showCard = false;
                        }
                    }

                    // Filter by rating
                    if (rating) {
                        const minRating = parseFloat(rating);
                        const cardRating = parseFloat(card.querySelector('.rating').textContent);
                        if (cardRating < minRating) {
                            showCard = false;
                        }
                    }

                    card.closest('.col-md-6').style.display = showCard ? 'block' : 'none';
                });
            });
        });

        // Membership check for message buttons
        document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
            button.addEventListener('click', function(e) {
                // Here you would typically check if the user has a premium membership
                const hasPremiumMembership = false; // This would come from your backend
                
                if (!hasPremiumMembership) {
                    e.preventDefault();
                    // The modal will show automatically due to data-bs-toggle="modal"
                } else {
                    // If they have premium, redirect to chat
                    window.location.href = 'chat.html';
                }
            });
        });
    </script>

    <!-- Membership Modal -->
    <div class="modal fade" id="membershipModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upgrade to Premium</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-lock fa-3x text-primary mb-3"></i>
                    <h4>Premium Membership Required</h4>
                    <p class="text-muted">To contact hosts and send messages, you need to upgrade to a premium membership.</p>
                    <div class="d-grid gap-2">
                        <a href="membership.html" class="btn btn-primary">View Membership Plans</a>
                        <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Maybe Later</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 