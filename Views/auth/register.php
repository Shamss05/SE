<?php
require_once '../../Controllers/Authcontroller.php';
require_once '../../Controllers/countrycontroller.php';
require_once '../../Controllers/taskscontroller.php';
require_once '../../Controllers/host_listingscontroller.php';


require_once '../../Models/user.php';
require_once '../../Models/host_listings.php';

$host_listing=new host_listingscontroller;
$auth=new Authcontroller;
$countries_data=new Countrycontroller;
$countries=$countries_data->fetch_counties();

$tasks_data=new taskscontroller;
$tasks=$tasks_data->fetch_tasks();



if(isset($_POST['traveler_submit'])){
$name=$_POST['name'];
$email=$_POST['email'];
$hasedpassword=password_hash($_POST['password'],PASSWORD_DEFAULT);
$country=$_POST['country'];
$skills=$_POST['skills'];


$user=new User;
$user->name=$name;
$user->email=$email;
$user->password=$hasedpassword;
$user->Country=$country;
$user->role=2;
$user->image="...";
$user->preferences="Default";
$user->skills=$skills;

$result = $auth->register($user);
if($result) {
    header("Location: ../auth/login.php");
    exit();
} else {
    echo "<script>alert('Registration failed. Please try again.');</script>";
}
}


if(isset($_POST['host_submit'])){
  $name=$_POST['name'];
  $email=$_POST['email'];
  $hasedpassword=password_hash($_POST['password'],PASSWORD_DEFAULT);
  $country=$_POST['country'];
  $skills=$_POST['skills'];
  // $location=$_POST['location'];
  // $city=$_POST['city'];
  // $accomodation=$_POST['accomodation'];
  // $description=$_POST['description'];
  // $title=$_POST['title'];
  // $language=$_POST['language'];

  $user=new User;
  $user->name=$name;
  $user->email=$email;
  $user->password=$hasedpassword;
  $user->Country=$country;
  $user->role=1;
  $user->image="...";
  $user->preferences="Default";
  $user->skills="No skills for host";
  
  $result = $auth->register($user);

  echo "registered";
  die;
  
  // if($result) {
  //   $listing=new host_listings;
  //   $listing->accommodation_details=$accomodation;
  //   $listing->city=$city;
  //   $listing->country=$country;
  //   $listing->description=$description;
  //   $listing->location=$location;
  //   $listing->title=$title;
  //   $listing->language_required=$language;
  //   $result=$host_listing->getLastId();
  //   $host_listing->savelisting($listing);
  // } 
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - WanderNest</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            padding: 4rem 0;
        }
        .register-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
        }
        .form-step {
            display: none;
        }
        .form-step.active {
            display: block;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="register-container">
                    <h2 class="text-center mb-4">Create Your Account</h2>

                    <!-- Role Selection Tabs -->
                    <ul class="nav nav-pills nav-justified mb-4" id="roleTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="traveler-tab" data-bs-toggle="pill" data-bs-target="#travelerForm">
                                <i class="fas fa-plane-departure me-2"></i>Join as Traveler
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="host-tab" data-bs-toggle="pill" data-bs-target="#hostForm">
                                <i class="fas fa-home me-2"></i>Join as Host
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="roleTabContent">
                        <!-- Traveler Registration Form -->
                        <div class="tab-pane fade show active" id="travelerForm">
                            <form method="post" id="travelerRegistration">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input name="name" type="text" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input name="email" type="email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group">
                                                <input name="password" type="password" class="form-control" id="password2" required>
                                                <button class="btn btn-outline-secondary" type="button" id="togglePassword2">
                                                    <i class="far fa-eye"></i>
                                                </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Country</label>
                                        <select name="country" class="form-select" required>
                                        <option value="">Select your country</option>
                                          <?php foreach($countries as $country):?>
                                            <option value="<?=$country['id']?>"><?=$country['name']?></option>
                                            <?php endforeach;?>
                                            <!-- Add more countries -->
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Skills & Interests</label>
                                    <select name="skills[]" class="form-select" multiple required>
                                      <?php foreach($tasks as $task):?>
                                        <option value="<?=$task['name']?>"><?=$task['name']?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <small class="text-muted">Hold Ctrl/Cmd to select multiple</small>
                                </div>
                                <button name="traveler_submit" type="submit" class="btn btn-primary w-100">Create Traveler Account</button>
                            </form>
                        </div>

                        <!--                                         
                                        
                                        
                                        
                                                                            <div class="mb-3">
                                        <label class="form-label">Type of Help Needed</label>
                                        <select name="skills" class="form-select" multiple required>
                                        <?php foreach($tasks as $task):?>
                                        <option value="<?=$task['name']?>"><?=$task['name']?></option>
                                        <?php endforeach;?>
                                        </select>
                                    </div>

                                        
                                        -->

         <!-- Host Registration Form -->
                        <div class="tab-pane fade" id="hostForm">
                            <form method="post" id="hostRegistration" action="host_details.html">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input name="name" type="text" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input name="email" type="email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group">
                                        <input name="password" type="password" class="form-control" id="password" required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">City</label>
                                        <input name="city" type="text" class="form-control" required>
                                    </div>
                                          <div class="col-md-6 mb-3">
                                            <label class="form-label">Country</label>
                                            <select name="country" class="form-select" required>
                                                <option value="">Select country</option>
                                                <?php foreach($countries as $country):?>
                                                <option value="<?=$country['id']?>"><?=$country['name']?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                </div>
                                <button name="host_submit" type="submit" class="btn btn-primary w-100">Continue to Property Details</button>
                            </form>
                        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Email validation function
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function nextStep(step) {
            // Get the current step's form fields
            const currentStep = document.getElementById('step' + (step - 1));
            if (!currentStep) return; // Guard against invalid step

            const requiredFields = currentStep.querySelectorAll('[required]');
            let isValid = true;

            // Check each required field
            requiredFields.forEach(field => {
                if (!field.value) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                    
                    // Special validation for email fields
                    if (field.type === 'email') {
                        if (!isValidEmail(field.value)) {
                            isValid = false;
                            field.classList.add('is-invalid');
                            alert('Please enter a valid email address.');
                        }
                    }
                }
            });

            // If any field is invalid, show error and don't proceed
            if (!isValid) {
                return;
            }

            // If all fields are valid, proceed to next step
            document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
            document.getElementById('step' + step).classList.add('active');
            document.querySelector('.progress-bar').style.width = (step * 25) + '%';
        }

        function prevStep(step) {
            document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
            document.getElementById('step' + step).classList.add('active');
            document.querySelector('.progress-bar').style.width = (step * 25) + '%';
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

        // Password visibility toggle
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
        
        // Password visibility toggle
        document.getElementById('togglePassword2').addEventListener('click', function() {
            const password = document.getElementById('password2');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>