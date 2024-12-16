<?php
session_start(); // Start the session
?>

<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your database password
$dbname = "cars_detail";

// Include the function file
include 'fetch_cars.php';

// Set the number of cars per page
$limit = 8;

// Get the current page from the URL or set to 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Ensure page is at least 1

// Fetch the cars for the current page
$cars = fetchCars($servername, $username, $password, $dbname, $page, $limit);

// Count total cars for pagination
$totalCars = countCars($servername, $username, $password, $dbname);
$totalPages = ceil($totalCars / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Vehicle, Rent, car, jeep, vehicle rental system">
    <meta name="description" content="Vehicle rental system provides automation of vehicle rental management">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Vehicle Rental System</title>

</head>
<style>
    .catalog-title {
            text-align: center;
            margin: 20px 0;
        }
    
    .btn_home {
    text-decoration: none;
    padding: 15px 30px;
    background-color: rgb(247, 32, 82);
    font-size: 15px;
    color: aliceblue;
    font-weight: 500;
    border-radius: 30px;
    transition: 0.3s ease-in;
}

.btn_home:hover {
    background-color: #f38d08;
}

.play_btn {
    text-decoration: none;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin-left: 30px;
    width: 50px;
    height: 50px;
    border-radius: 40px;
    border: 2px solid rgb(249, 46, 127);
    color: rgb(225, 14, 32);
    font-size: 20px;
    transition: 0.3s ease-in-out;
}

.play_btn:hover {
    background-color: #f07c2e;
    color: aliceblue;
}

.play_btn_span {
    font-size: 13px;
    font-weight: 600;
    color: black;
    padding: 0 15px;
}
    .banner-section {
        background-image: linear-gradient(90deg, #ffffffd8 25%, #1d030900 63%), url(cover.jpg);
        background-size: cover;
        background-position: center;
        overflow-x: hidden;
        /* padding: 4rem 0; */
        color: white;
        /* text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); */
        position: relative;
        display: flex;
        align-items: center;
        margin-top: 0;
    }

    .banner-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /* background-color: rgba(0, 0, 0, 0.7); */
    }

    .content_banner {
        position: relative;
        z-index: 1;
        max-width: 600px;
        opacity: 1;
    }

    
    .heading_home {
        font-size: 4.375rem;
        /* 70px */
        font-weight: 700;
        color: black;
    }

    .paragraph_home {
        font-size: 0.9375rem;
        /* 15px */
        color: black;
        font-weight: 400;
        line-height: 1.625rem;
        /* 26px */
    }

    
</style>

<body>
    <div class="container mt-5">
        <h1>Welcome to Car Rental Service</h1>

        <!-- Check for success message -->
        <?php if (isset($_SESSION['success_message'])): ?>
            <script>
                window.onload = function () {
                    alert("<?php echo $_SESSION['success_message']; ?>");
                };
            </script>
            <?php unset($_SESSION['success_message']); // Clear the message after displaying ?>
        <?php endif; ?>

        <!-- Your existing content goes here -->

    </div>
    <!-- <header class="header"> -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/Rent_a_Car__1_-removebg-preview.png" class="Logo_umc" alt="UMC">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="#services">Services</a></li> -->
                    <!-- <li class="nav-item"><a class="nav-link" href="#Appointment">Appointment</a></li> -->
                    <li class="nav-item"><a class="nav-link"
                            href="https://api.whatsapp.com/send?phone=+923485329512&text=We%20need%20an%20ambulance%20ASAP">WhatsApp</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="contact.php" target="_blank">Contact Us</a></li>
                </ul>
            </div>
            <div class="navbar_media">
                <span class="icon_media"><i class="fa fa-phone phone_media"></i></span>
                <span class="number">+923485329512</span>
                <a href="#login" class="btn_media_navbar" type="button" data-bs-toggle="modal"
                    data-bs-target="#myModal">Book Now</a>
                <!-- <a href="#" id="loginBtn" class="btn_media_login">Login</a> -->
                <button class="btn btn-primary" id="loginbtn" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#login">
                    Login
                </button>

            </div>

        </div>
    </nav>
    <!-- </header> -->

    <div class="container mt-5" style="margin-bottom:0;">
    <h2 style="color:#f9f9f9;">Search for Available Cars</h2>
    <form method="post" action="search.php">
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="car_name" name="car_name" placeholder="Car Name">
            <select class="form-select" id="category" name="category">
                <option value="">Select Category</option>
                <option value="SUV">SUV</option>
                <option value="Sedan">Sedan</option>
                <option value="Convertible">Convertible</option>
                <option value="Hatchback">Hatchback</option>
                <option value="Coupe">Coupe</option>
                <option value="Coupe">bhuijj</option>
                
                <!-- Add more categories as needed -->
            </select>
            <input type="text" class="form-control" id="location" name="location" placeholder="Location">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
</div>
    </div>

    <div class="banner-section   px-3" style="margin-top:0;">
        <div class="container">
            <div class="content_banner">
                <h2 class="heading_home">Let's Start Your Comfortable Journey with Our Cars</h2>
                <p class="paragraph_home">Experience freedom with My Car Rental! Affordable rates, diverse vehicles,
                    and exceptional service await. Book now and hit the road!</p>
                <div class="btn_media_home">
                    <a href="#login" type="button" data-bs-toggle="offcanvas" data-bs-target="#login"
                        class="btn_home">Get Started</a>
                    <a href="#" class="play_btn"><i class="fa fa-play"></i></a><span class="play_btn_span">Watch
                        Video</span>
                </div>
            </div>
        </div>
    </div>


    <section id="about" style="background-color: #f8f9fa; padding: 60px 0; text-shadow:#333">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 style="margin-bottom: 20px; text-shadow: 2px 2px 4px rgba(9, 0, 0, 0.5);">
                        About Us <i class="fas fa-car" style="margin-left: 10px;"></i>
                    </h2>
                    <p style="margin-bottom: 15px;">
                        Welcome to our car rental service! We are dedicated to providing you with the best car rental
                        experience possible. Our fleet includes a wide range of vehicles to suit your needs, whether you
                        are traveling for business or leisure.
                    </p>
                    <p style="margin-bottom: 15px;">
                        Our team is committed to ensuring that you receive outstanding service at every step of your
                        journey. From the moment you contact us to the time you return your vehicle, we strive to exceed
                        your expectations.
                    </p>
                    <p style="margin-bottom: 0;">
                        Thank you for choosing us for your car rental needs. We look forward to serving you!
                    </p>
                </div>
               

                        <!-- Photo Column -->
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6 d-flex justify-content-center mb-3">
                                    <img src="images/camrao white.jpg" alt="About Us" class="rounded img-fluid"
                                        style="width: 100%; height: auto; max-height: 200px; object-fit: cover; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);">
                                </div>
                                <div class="col-6 d-flex justify-content-center mb-3">
                                    <img src="images/black cam.jpg" alt="About Us" class="rounded img-fluid"
                                        style="width: 100%; height: auto; max-height: 200px; object-fit: cover; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);">
                                </div>
                                <div class="col-6 d-flex justify-content-center mb-3">
                                    <img src="images/camaro yellw.jpg" alt="About Us" class="rounded img-fluid"
                                        style="width: 100%; height: auto; max-height: 200px; object-fit: cover; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);">
                                </div>
                                <div class="col-6 d-flex justify-content-center mb-3">
                                    <img src="images/red cam.jpg" alt="About Us" class="rounded img-fluid"
                                        style="width: 100%; height: auto; max-height: 200px; object-fit: cover; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login form toggle top -->
    <!-- Login Offcanvas -->
    <div class="offcanvas offcanvas-end" id="login">
        <div class="offcanvas-header">
            <h1 class="offcanvas-title">Login</h1>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div class="login-container"
                style="background-color: #42a5f5; color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                <h2 class="text-center" style="text-align: center; margin-bottom: 15px; color: white;">Login</h2>
                <form id="loginForm" action="login.php" method="POST">
                    <div class="mb-3" style="margin-bottom: 15px;">
                        <label for="login-username" style="display: block; margin-bottom: 5px;">Username</label>
                        <input type="text" class="form-control" id="login-username" name="username" required
                            style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 5px;">
                    </div>
                    <div class="mb-3" style="margin-bottom: 15px;">
                        <label for="login-password" style="display: block; margin-bottom: 5px;">Password</label>
                        <input type="password" class="form-control" id="login-password" name="password" required
                            style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 5px;">
                    </div>
                    <button id="loginButton" type="submit"
                        style="background-color: #2196f3; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; margin-top: 10px;">
                        Login
                    </button>
                    <button
                        style="background-color: #2196f3; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; margin-top: 10px;"
                        type="button" data-bs-toggle="offcanvas" data-bs-target="#signup">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Signup Offcanvas -->
    <div class="offcanvas offcanvas-start" id="signup">
        <div class="offcanvas-header">
            <h1 class="offcanvas-title">Signup</h1>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div class="signup-container"
                style="background-color: #42a5f5; color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                <form id="signupForm" action="signup.php" method="POST">
                    <div class="mb-3" style="margin-bottom: 15px;">
                        <label for="signup-username" style="display: block; margin-bottom: 5px;">Username</label>
                        <input type="text" class="form-control" id="signup-username" name="username" required
                            style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 5px;">
                    </div>
                    <div class="mb-3" style="margin-bottom: 15px;">
                        <label for="signup-phone" style="display: block; margin-bottom: 5px;">Phone Number</label>
                        <input type="tel" class="form-control" id="signup-phone" name="phone" required
                            style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 5px;">
                    </div>
                    <div class="mb-3" style="margin-bottom: 15px;">
                        <label for="signup-address" style="display: block; margin-bottom: 5px;">Address</label>
                        <input type="text" class="form-control" id="signup-address" name="address" required
                            style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 5px;">
                    </div>
                    <div class="mb-3" style="margin-bottom: 15px;">
                        <label for="signup-password" style="display: block; margin-bottom: 5px;">Password</label>
                        <input type="password" class="form-control" id="signup-password" name="password" required
                            style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 5px;">
                    </div>
                    <!-- <button id="loginButton" type="button"
                            style="background-color: #2196f3; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; margin-top: 10px;">
                            Login
                        </button> -->

                    <button type="submit"
                        style="background-color: #2196f3; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; margin-top: 10px;">
                        Sign Up
                    </button>
                    <button class="btn btn-primary" id="loginbtn" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#login"
                        style="background-color: #2196f3; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; margin-top: 10px;">
                        
                        Login
                    </button>

                </form>
            </div>
        </div>
    </div>
  
    <main>
    <section class="home">
        <div class="catalog">
            <div class="container">
                <h2 class="catalog-title">Available Cars</h2>

                <div class="row">
                    <?php if (!empty($cars)): ?>
                        <?php foreach ($cars as $car): ?>
                            <div class="col-md-3">
                                <div class="card mb-4">
                                    <img src="<?php echo htmlspecialchars($car['image_path']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($car['car_name']); ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($car['car_name']); ?></h5>
                                        <p class="card-text">Price: $<?php echo htmlspecialchars($car['price']); ?></p>
                                        <p class="card-text">Price per day: $<?php echo htmlspecialchars($car['price_per_day']); ?></p>
                                        <p class="card-text">Availability: <span class="available"><?php echo htmlspecialchars($car['availability']); ?></span></p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                            Book Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <p>No available cars at the moment.</p>
                        </div>
                    <?php endif; ?>
                </div>
                <hr>
                <!-- Pagination Controls -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
        <hr>
    </section>
</main>                     
                    <!-- Additional cars can be added similarly -->
                <!-- </div>
                <div class="container mt-3 my-0">
                    <ul class="pagination pagination-lg">
                        <li class="page-item"><a class="page-link" href="index.html">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="index.html">1</a></li>
                        <li class="page-item"><a class="page-link" href="car2.html">2</a></li>
                        <li class="page-item"><a class="page-link" href="car3.html">3</a></li>
                        <li class="page-item"><a class="page-link" href="car3.html">Next</a></li>
                    </ul>
                </div>
            </div>
            </div> -->
        </section>
        <!-- Modal for cars booking details form -->
        <div class="container mt-3">
            <!-- <h3>Modal Example</h3>
            <p>Click on the button to open the modal.</p> -->

            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
      Open modal
    </button> -->
        </div>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Vehical Booking</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">


                        <form class="was-validated" method="POST" action="save_rental_request.php"
                            enctype="multipart/form-data">
                            <div class="mb-3 mt-3">
                                <label for="fullName" class="form-label">Full Name:</label>
                                <input type="text" class="form-control" id="fullName" placeholder="Enter your full name"
                                    name="fullName" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number:</label>
                                <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number"
                                    name="phone" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Complete Address:</label>
                                <textarea class="form-control" id="address" rows="3"
                                    placeholder="Enter your complete address" name="address" required></textarea>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="mb-3">
                                <label for="rentalDays" class="form-label">Number of Rental Days:</label>
                                <input type="number" class="form-control" id="rentalDays" name="rentalDays" min="1"
                                    placeholder="Enter number of days" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="mb-3">
                                <label for="carName" class="form-label">Car Name:</label>
                                <select class="form-select" id="carName" name="carName" required>
                                    <option value="">Select a car</option>
                                    <option value="Chevrolet Camaro 2015">Chevrolet Camaro 2015</option>

                                    <option value="Swift">Swift</option>

                                    <option value="Honda City">Honda City</option>

                                    <option value="Revo 4x4">Revo 4x4</option>

                                    <option value="Honda Civic">Honda Civic</option>

                                    <option value="Toyota Fortuner">Toyota Fortuner</option>

                                    <option value="BMW S3">BMW S3</option>

                                    <option value="BMW S6">BMW S6</option>

                                    <option value="Mercedes">Mercedes</option>

                                    <option value="Audi">Audi</option>

                                    <option value="Chevrolet Chevrolet">Chevrolet Chevrolet</option>

                                    <option value="Chevrolet Camaro SS">Chevrolet Camaro SS</option>

                                    <option value="Cultus">Cultus</option>

                                    <option value="Alto">Alto</option>

                                    <option value="Grande">Grande</option>

                                    <option value="Lexus">Lexus</option>

                                    <option value="Prius">Prius</option>

                                    <option value="Prado">Prado</option>

                                    <option value="V8 Land Cruiser">V8 Land Cruiser</option>


                                </select>
                               
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please select a car.</div>
                            </div>
                            <div class="mb-3">
    <label for="pricePerDay" class="form-label">Price per Day:</label>
    <input type="number"  id="pricePerDay" name="pricePerDay" min="0" placeholder=" price per day" required>
</div>



                            <div class="mb-3">
                                <label for="licensePhoto" class="form-label">Upload Driving License Photo
                                    (Front):</label>
                                <input type="file" class="form-control" id="licensePhoto" name="licensePhoto"
                                    accept="image/*" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please upload a photo.</div>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="agreePolicy" name="agreePolicy"
                                    required>
                                <label class="form-check-label" for="agreePolicy">
                                    I Agree to the Policy
                                    <p class="text-primary" data-bs-toggle="collapse" data-bs-target="#demo">Read More
                                    </p>
                                </label>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Agree on policy to Continue</div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div id="demo" class="collapse"
                        style="font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
                        <h2 style="text-align: center; color: #333;">Vehicle Rental Policy</h2>
                        <p style="font-size: 16px; line-height: 1.5;">
                            By renting a vehicle from <strong style="color: #007BFF;">Cars Services</strong>, you agree
                            to the following terms:
                        </p>

                        <ul style="list-style-type: none; padding-left: 0; font-size: 16px;">
                            <li><strong>Eligibility:</strong> Drivers must be at least <strong>21 years old</strong>,
                                have a valid driver’s license, and present a credit card in their name.</li>
                            <li><strong>Rental Period:</strong> Minimum rental is <strong>24 hours</strong>. Late
                                returns may incur additional charges.</li>
                            <li><strong>Insurance:</strong> Basic insurance is included; additional coverage options are
                                available.</li>
                            <li><strong>Fuel Policy:</strong> Return the vehicle with the same fuel level as at pick-up.
                                <strong>Refueling fees</strong> will apply otherwise.
                            </li>
                            <li><strong>Prohibited Uses:</strong> The vehicle cannot be used for illegal activities,
                                off-roading, or racing.</li>
                            <li><strong>Responsibility:</strong> You are liable for any damages or loss during the
                                rental period.</li>
                            <li><strong>Cancellations:</strong> Full refund for cancellations made <strong>48
                                    hours</strong> in advance; fees may apply for later cancellations.</li>
                        </ul>

                        <p style="font-size: 16px; line-height: 1.5;">
                            By agree Above, you acknowledge that you have read and agree to this policy.
                        </p>

                    </div>
                    <a href="view_rental_requests.php" class="btn btn-info text-light">View Rental Requests</a>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <footer style="background: linear-gradient(90deg, #ff9800, #f57c00); padding: 20px 0; color: white;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 20px;">
            <h4 style="margin-bottom: 10px;">Follow Us</h4>
            <div style="display: flex; justify-content: center; gap: 15px;">
                <a href="#" style="color: white; text-decoration: none; font-size: 24px;">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" style="color: white; text-decoration: none; font-size: 24px;">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" style="color: white; text-decoration: none; font-size: 24px;">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" style="color: white; text-decoration: none; font-size: 24px;">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>

        <div style="text-align: center; margin-bottom: 20px;">
            <h4 style="margin-bottom: 10px;">Admin</h4>
            <div style="display: flex; justify-content: center; gap: 15px;">
                <a href="All_users.php" style="color: white; text-decoration: none; padding: 10px 15px; background-color: rgba(255, 255, 255, 0.2); border-radius: 5px;">View Signup</a>
                <a href="php\All_complaints.php" style="color: white; text-decoration: none; padding: 10px 15px; background-color: rgba(255, 255, 255, 0.2); border-radius: 5px;">View Complaints</a>
                <a href="view_rental_requests.php" style="color: white; text-decoration: none; padding: 10px 15px; background-color: rgba(255, 255, 255, 0.2); border-radius: 5px;">View Bookings</a>
                <a href="view_cars.php" style="color: white; text-decoration: none; padding: 10px 15px; background-color: rgba(255, 255, 255, 0.2); border-radius: 5px;">View Cars</a>
                <a href="admin\add_vehicle.php" style="color: white; text-decoration: none; padding: 10px 15px; background-color: rgba(255, 255, 255, 0.2); border-radius: 5px;">Add Cars</a>

            </div>
        </div>

        <div style="text-align: center;">
            <p style="margin: 0;">&copy; 2024 My Car Rental. All Rights Reserved.</p>
        </div>
    </div>
</footer>
    <script>
        // Function to show the welcome alert
        function showWelcomeAlert() {
            alert("Welcome to the Vehicle Booking System!");
        }

        // Call the function when the page loads
        window.onload = function () {
            showWelcomeAlert();
        };
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

    <script>
        // Function to handle login state and button updates
        function handleLogin(username) {
            const loginButton = document.querySelector('.btn-primary[data-bs-toggle="offcanvas"]');
            // Check if the user is logged in
            if (username) {
                // User is logged in, update the login button to show the username
                loginButton.innerText = username;
                loginButton.onclick = null; // Disable further clicks
            }
        }

        // Example usage (assuming successful login retrieves the username from PHP)
        function onLoginSuccess() {
            const username = "<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>"; // Get username from PHP session
            handleLogin(username); // Call the function with the username
        }

        // Call the onLoginSuccess function to check the login state
        onLoginSuccess();
    </script>
</body>

</html>