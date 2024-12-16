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

<body>
    <header class="header">
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
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#Appointment">Appointment</a></li> -->
                        <li class="nav-item"><a class="nav-link"
                                href="https://api.whatsapp.com/send?phone=+923485329512&text=We%20need%20an%20ambulance%20ASAP">WhatsApp</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="contact.html" target="_blank">Contact Us</a></li>
                    </ul>
                </div>
                <div class="navbar_media">
                    <span class="icon_media"><i class="fa fa-phone phone_media"></i></span>
                    <span class="number">+923485329512</span>
                    <a href="#login" class="btn_media_navbar" type="button" data-bs-toggle="modal"
                        data-bs-target="#myModal">Book Now</a>
                    <!-- <a href="#" id="loginBtn" class="btn_media_login">Login</a> -->
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#login">
                        Login
                    </button>
                </div>

            </div>
        </nav>
        <!-- login form toggle top -->
        <div class="offcanvas offcanvas-end" id="login">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title">Login</h1>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <div class="login-container" style="background-color: #42a5f5; color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                    <h2 class="text-center" style="text-align: center; margin-bottom: 15px; color: white;">Login</h2>
                    <form id="loginForm" action="welcome.php" method="POST">
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
                        <button type="submit"
                            style="background-color: #2196f3; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; margin-top: 10px;">
                            Login
                        </button>

                        <button style="background-color: #2196f3; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; margin-top: 10px;"
                            type="button" data-bs-toggle="offcanvas" data-bs-target="#signup">
                            SignUp
                        </button>
                    </form>
                </div>
                <!-- <button class="btn btn-secondary" type="button">A Button</button> -->
            </div>
        </div>


        <!-- signup -->
        <div class="offcanvas offcanvas-start" id="signup">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title">Signup</h1>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <div class="signup-container" style="background-color: #42a5f5; color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
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
                        <button type="submit"
                            style="background-color: #2196f3; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; margin-top: 10px;">
                            Sign Up
                        </button>
                    </form>
                </div>
        </div>
</div>
                <div class="banner-section px-3">
                    <div class="container">
                        <div class="content_banner">
                            <h2 class="heading_home">Let's Start Your Comfortable Journey with Our Cars</h2>
                            <p class="paragraph_home">Experience freedom with My Car Rental! Affordable rates, diverse vehicles,
                                and exceptional service await. Book now and hit the road!</p>
                            <div class="btn_media_home">
                                <a href="#login" type="button" data-bs-toggle="offcanvas" data-bs-target="#login" class="btn_home">Get Started</a>
                                <a href="#" class="play_btn"><i class="fa fa-play"></i></a><span class="play_btn_span">Watch
                                    Video</span>
                            </div>
                        </div>
                    </div>
                </div>
    </header>
    <section class="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2>About Us</h2>
                    <p>
                        Welcome to our car rental service! We are dedicated to providing you with the best car rental
                        experience possible. Our fleet includes a wide range of vehicles to suit your needs, whether you
                        are traveling for business or leisure.
                    </p>
                    <p>
                        Our team is committed to ensuring that you receive outstanding service at every step of your
                        journey. From the moment you contact us to the time you return your vehicle, we strive to exceed
                        your expectations.
                    </p>
                    <p>
                        Thank you for choosing us for your car rental needs. We look forward to serving you!
                    </p>
                </div>
                <div class="col-md-6">
                    <img src="images/car14.jpg" alt="About Us" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="home">
            <div class="catalog">
                <div class="container">
                    <h2 class="catalog-title">Available Cars</h2>

                    <div class="row">
                        <!-- Car 1 -->
                        <div class="col-md-3">
                            <div class="card">
                                <img src="images/pexels-mikebirdy-116675.jpg" class="card-img-top" alt="Car 1">
                                <div class="card-body">
                                    <h5 class="card-title">Car Name 1</h5>
                                    <p class="card-text">Price: $20,000</p>
                                    <p class="card-text">Price per day: $100</p>
                                    <p class="card-text">Availability: <span class="available"> Available </span></p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#myModal">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Car 2 -->
                        <div class="col-md-3">
                            <div class="card">
                                <img src="images/car2.jpg" class="card-img-top" alt="Car 2">
                                <div class="card-body">
                                    <h5 class="card-title">Car Name 2</h5>
                                    <p class="card-text">Price: $25,000</p>
                                    <p class="card-text">Price per day: $120</p>
                                    <p class="card-text">Availability: <span class="available">Not Available</span></p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#myModal">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Car 3 -->
                        <div class="col-md-3">
                            <div class="card">
                                <img src="images/cars3.jpg" class="card-img-top" alt="Car 3">
                                <div class="card-body">
                                    <h5 class="card-title">Car Name 3</h5>
                                    <p class="card-text">Price: $30,000</p>
                                    <p class="card-text">Price per day: $150</p>
                                    <p class="card-text">Availability: <span class="available">Available</span></p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#myModal">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Car 4 -->
                        <div class="col-md-3">
                            <div class="card">
                                <img src="images/car4.jpg" class="card-img-top" alt="Car 4">
                                <div class="card-body">
                                    <h5 class="card-title">Car Name 4</h5>
                                    <p class="card-text">Price: $40,000</p>
                                    <p class="card-text">Price per day: $180</p>
                                    <p class="card-text">Availability: <span class="available">Available</span></p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#myModal">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Car 5 -->
                        <div class="col-md-3">
                            <div class="card">
                                <img src="images/car5.jpg" class="card-img-top" alt="Car 5">
                                <div class="card-body">
                                    <h5 class="card-title">Car Name 5</h5>
                                    <p class="card-text">Price: $50,000</p>
                                    <p class="card-text">Price per day: $200</p>
                                    <p class="card-text">Availability: <span class="available">Not Available</span></p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#myModal">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Car 6 -->
                        <div class="col-md-3">
                            <div class="card">
                                <img src="images/car6.jpg" class="card-img-top" alt="Car 6">
                                <div class="card-body">
                                    <h5 class="card-title">Car Name 6</h5>
                                    <p class="card-text">Price: $20,000</p>
                                    <p class="card-text">Price per day: $100</p>
                                    <p class="card-text">Availability: <span class="available">Available</span></p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#myModal">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Car 7 -->
                        <div class="col-md-3">
                            <div class="card">
                                <img src="images/cars8.jpg" class="card-img-top" alt="Car 7">
                                <div class="card-body">
                                    <h5 class="card-title">Car Name 7</h5>
                                    <p class="card-text">Price: $25,000</p>
                                    <p class="card-text">Price per day: $120</p>
                                    <p class="card-text">Availability: <span class="available">Not Available</span></p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#myModal">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Car 8 -->
                        <div class="col-md-3">
                            <div class="card">
                                <img src="images/car11.jpg" class="card-img-top" alt="Car 8">
                                <div class="card-body">
                                    <h5 class="card-title">Car Name 8</h5>
                                    <p class="card-text">Price: $30,000</p>
                                    <p class="card-text">Price per day: $150</p>
                                    <p class="card-text">Availability: <span class="available">Available</span></p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Car 9 -->
                        <div class="col-md-3">
                            <div class="card">
                                <img src="images/car10.jpg" class="card-img-top" alt="Car 9">
                                <div class="card-body">
                                    <h5 class="card-title">Car Name 9</h5>
                                    <p class="card-text">Price: $40,000</p>
                                    <p class="card-text">Price per day: $180</p>
                                    <p class="card-text">Availability: <span class="available">Available</span></p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#myModal">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Car 10 -->
                        <div class="col-md-3">
                            <div class="card">
                                <img src="images/car5.jpg" class="card-img-top" alt="Car 10">
                                <div class="card-body">
                                    <h5 class="card-title">Car Name 10</h5>
                                    <p class="card-text">Price: $50,000</p>
                                    <p class="card-text">Price per day: $200</p>
                                    <p class="card-text">Availability: <span class="available">Not Available</span></p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#myModal">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- car 11 -->
                        <div class="col-md-3">
                            <div class="card">
                                <img src="images/car12.jpg" class="card-img-top" alt="Car 11">
                                <div class="card-body">
                                    <h5 class="card-title">Car Name 11</h5>
                                    <p class="card-text">Price: $40,000</p>
                                    <p class="card-text">Price per day: $180</p>
                                    <p class="card-text">Availability: <span class="available">Available</span></p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#myModal">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- car 12 -->
                        <div class="col-md-3">
                            <div class="card">
                                <img src="images/car14.jpg" class="card-img-top" alt="Car 12">
                                <div class="card-body">
                                    <h5 class="card-title">Car Name 12</h5>
                                    <p class="card-text">Price: $30,000</p>
                                    <p class="card-text">Price per day: $150</p>
                                    <p class="card-text">Availability: <span class="available">Available</span></p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#myModal">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Additional cars can be added similarly -->
                </div>
                <div class="container mt-3">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="index.html">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="index.html">1</a></li>
                        <li class="page-item"><a class="page-link" href="car2.html">2</a></li>
                        <li class="page-item"><a class="page-link" href="car3.html">3</a></li>
                        <li class="page-item"><a class="page-link" href="car3.html">Next</a></li>
                    </ul>
                </div>
            </div>
            </div>
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


                        <form class="was-validated">
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
                                    <option value="CarModel1">Chevrolet Camaro 2015</option>
                                    <option value="CarModel2">G wagon G63</option>
                                    <option value="CarModel3">Mercedes B170 2009</option>
                                    <!-- Add more options as needed -->
                                </select>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please select a car.</div>
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
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <section class="about"></section>
    </main>

    <footer class="footer"></footer>


</body>

</html>