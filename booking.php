<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-image: url('cover.jpg');
            /* Replace with your image URL */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
            /* Text color for visibility */
            text-align: center;
        }

        .button-container {
            background-color: rgba(0, 0, 0, 0.6);
            /* Semi-transparent background for contrast */
            padding: 40px;
            border-radius: 10px;
        }

        .btn-primary {
            font-size: 1.5rem;
            /* Larger button text */
            padding: 15px 30px;
            /* Bigger button size */
        }
    </style>
</head>

<body>
    <main>
        <div class="button-container">
            <h2>Click here to book your vehicle</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                Book Now
            </button>
        </div>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-black">Vehical Booking</h4>
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
                                <input type="number" id="pricePerDay" name="pricePerDay" min="0"
                                    placeholder=" price per day" required>
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
                    <a href="view_rental_requests.php" class="btn btn-info">View Rental Requests</a>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </main>
</body>

</html>