$webClient = New-Object System.Net.WebClient

# Hero Images
$webClient.DownloadFile("https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80", "images\hero\hero-main.jpg")
$webClient.DownloadFile("https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80", "images\hero\hero-contact.jpg")
$webClient.DownloadFile("https://images.unsplash.com/photo-1504609773096-104ff2c73ba4", "images\hero\hero-how-it-works.jpg")

# Destination Images
$webClient.DownloadFile("https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80", "images\destinations\bali.jpg")
$webClient.DownloadFile("https://images.unsplash.com/photo-1518546305927-5a555bb7020d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80", "images\destinations\lisbon.jpg")
$webClient.DownloadFile("https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80", "images\destinations\chiang-mai.jpg")
$webClient.DownloadFile("https://images.unsplash.com/photo-1527631746610-bca00a040d60?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80", "images\destinations\travel-buddy.jpg")

# Testimonial Images
$webClient.DownloadFile("https://randomuser.me/api/portraits/women/32.jpg", "images\testimonials\sarah.jpg")
$webClient.DownloadFile("https://randomuser.me/api/portraits/men/45.jpg", "images\testimonials\carlos.jpg")
$webClient.DownloadFile("https://randomuser.me/api/portraits/women/68.jpg", "images\testimonials\emma.jpg")

# Profile Images
$webClient.DownloadFile("https://randomuser.me/api/portraits/women/68.jpg", "images\profiles\maria.jpg") 