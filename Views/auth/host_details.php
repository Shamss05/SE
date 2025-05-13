<?php
require_once '../../Controllers/taskscontroller.php';
require_once '../../Controllers/countrycontroller.php';
require_once '../../Controllers/host_listingscontroller.php';


require_once '../../Models/host_images.php';
require_once '../../Models/host_listings.php';
require_once '../../Models/availability.php';

$host_listing=new host_listingscontroller;
$countries_data=new Countrycontroller;
$countries=$countries_data->fetch_counties();

$tasks_data=new taskscontroller;
$tasks=$tasks_data->fetch_tasks();

if(isset($_POST['host_submit'])){
  $location=$_POST['location'];
  $country=$_POST['country'];
  $city=$_POST['city'];
  $accomodation=$_POST['accomodation'];
  $description=$_POST['description'];
  $title=$_POST['title'];
  $language=$_POST['language'];
  $start_date=$_POST['start'];
  $end_date=$_POST['end'];
  $files = $_FILES['images'];
  $maxFiles = 3;



    $listing=new host_listings;
    $listing->accommodation_details=$accomodation;
    $listing->city=$city;
    $listing->country=$country;
    $listing->description=$description;
    $listing->location=$location;
    $listing->title=$title;
    $listing->language_required=$language;
    $result=  $host_listing->savelisting($listing);
if($result){
  $host_listing->savephotos($files,$maxFiles,$result);
    $avaliable=new availability;
    $avaliable->listing_id=$result;
    $avaliable->start_date=$start_date;
    $avaliable->end_date=$end_date;
    $host_listing->saveavalability($avaliable);

  
}
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Host Property Details - WanderNest</title>
    <!-- Bootstrap CSS -->
    <link href="../../vendor/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendor/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            padding: 4rem 0;
        }
        .details-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
        }
        .progress {
            height: 0.5rem;
        }
        #photoPreview {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 10px;
        }
        .preview-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
        .step-indicator {
            padding: 5px 10px;
            border-radius: 20px;
            background-color: #e9ecef;
            color: #6c757d;
            font-size: 0.9rem;
        }
        .step-indicator.active {
            background-color: #0d6efd;
            color: white;
        }
        .form-step {
            display: none;
        }
        .form-step.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="details-container">
                    <h2 class="text-center mb-4">Property Details</h2>

                    <!-- Progress Bar -->
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: 33.33%"></div>
                    </div>

                    <!-- Step indicators -->
                    <div class="d-flex justify-content-between mb-4">
                        <span class="step-indicator active">Details</span>
                        <span class="step-indicator">Availability</span>
                        <span class="step-indicator">Photos</span>
                    </div>

                    <form method="post" enctype="multipart/form-data" id="hostDetailsForm">
                        <!-- Step 1: Details -->
                        <div class="form-step active" id="step1">
                          <div class="mb-3">
                                        <label class="form-label">Type of Help Needed</label>
                                        <select name="skills[]" class="form-select" multiple required>
                                        <?php foreach($tasks as $task):?>
                                        <option value="<?=$task['name']?>"><?=$task['name']?></option>
                                        <?php endforeach;?>
                                        </select>
                                    </div>
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <textarea name="title" class="form-control" rows="4" placeholder="Enter your place title" required></textarea>
                            </div>
                              <div class="col-md-6 mb-3">
                                        <label class="form-label">Country</label>
                                        <select name="country" class="form-select" required>
                                        <option value="">Select your country</option>
                                            <?php foreach($countries as $country):?>
                                            <option value="<?=$country['id']?>"><?=$country['name']?></option>
                                            <?php endforeach;?>
                                        </select>
                              </div>
                            <div class="mb-3">
                                <label class="form-label">Language</label>
                                <textarea name="language" class="form-control" rows="4" placeholder="Enter the language required" required></textarea>
                            </div>
                              <div class="mb-3">
                                <label class="form-label">Location</label>
                                <textarea name="location" class="form-control" rows="4" placeholder="Enter the language required" required></textarea>
                            </div>
                              <div class="mb-3">
                                <label class="form-label">city</label>
                                <textarea name="city" class="form-control" rows="4" placeholder="Enter the language required" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4" placeholder="Describe your place and the cultural experience you offer" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Accommodation Details</label>
                                <textarea name="accomodation" class="form-control" rows="3" placeholder="Describe the accommodation you provide" required></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next</button>
                            </div>
                        </div>

                        <!-- Step 2: Availability -->
                        <div class="form-step" id="step2">
                            <div class="mb-3">
                                <label class="form-label">Available From</label>
                                <input name="start" type="date" name="available_from" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Available Until</label>
                                <input name="end" type="date" name="available_until" class="form-control" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Previous</button>
                                <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next</button>
                            </div>
                        </div>

                        <!-- Step 3: Photos -->
                        <div class="form-step" id="step3">
                            <div class="mb-3">
                                <label class="form-label">Upload Photos</label>
                                <input name="images[]" type="file" class="form-control" multiple accept="image/*" onchange="previewPhotos(event)" required>
                                <small class="text-muted">Upload at least 3 photos of your property</small>
                            </div>
                            <div id="photoPreview" class="mb-3"></div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Previous</button>
                                <button name="host_submit" type="submit" class="btn btn-primary">Submit for Review</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../../vendor/js/bootstrap.bundle.min.js"></script>
    <script>
        function nextStep(step) {
            // Get the current step's form fields
            const currentStep = document.getElementById('step' + (step - 1));
            if (!currentStep) return;

            const requiredFields = currentStep.querySelectorAll('[required]');
            let isValid = true;

            // Check each required field
            requiredFields.forEach(field => {
                if (!field.value) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                return;
            }

            // If all fields are valid, proceed to next step
            document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
            document.getElementById('step' + step).classList.add('active');
            
            // Update progress bar
            document.querySelector('.progress-bar').style.width = (step * 33.33) + '%';
            
            // Update step indicators
            document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
                if (index < step) {
                    indicator.classList.add('active');
                } else {
                    indicator.classList.remove('active');
                }
            });
        }

        function prevStep(step) {
            document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
            document.getElementById('step' + step).classList.add('active');
            document.querySelector('.progress-bar').style.width = (step * 33.33) + '%';
            
            // Update step indicators
            document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
                if (index < step) {
                    indicator.classList.add('active');
                } else {
                    indicator.classList.remove('active');
                }
            });
        }

        function previewPhotos(event) {
            const preview = document.getElementById('photoPreview');
            preview.innerHTML = '';
            const files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('preview-image');
                    preview.appendChild(img);
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html> 