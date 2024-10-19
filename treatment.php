<?php
session_start();  // Start the session at the top

// Your HTML document starts here
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayurvedic Treatments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            color: rgb(11, 45, 11);
            font-family: 'Arial', Times, serif;
        }

        h1{font-family: 'Times Roman', Times, serif; font-weight:600;}
        h2{font-family: 'Times Roman', Times, serif; font-weight:600;}

        .section3 {
            position: relative;
            padding: 20px;
        }

        .weoff {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
        }

        .weleft {
            flex: 1;
            min-width: 300px;
            padding: 20px;
            box-sizing: border-box;
        }

        .weright {
            flex: 1;
            min-width: 300px;
            padding: 20px;
            box-sizing: border-box;
        }

        #scrollSection {
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            position: relative;
            height: 700px;
            background-color: rgb(2, 18, 4);
            width: 100%;
            max-width: 430px;
            border-radius: 20px 100px 20px 20px;
            margin: 10px;
            overflow: hidden;
            transition: all 0.5s ease;
        }

        .card .image-container {
            height: 60%;
            width: 100%;
            border-radius: 20px 100px 20px 20px;
            overflow: hidden;
        }

        .card img {
            height: 100%;
            width: 100%;
            border-radius: 20px 100px 0px 0px;
            object-fit: cover;
        }

        .card h3 {
            font-size: 35px;
            text-align: center;
            color: white; /* Title color set to white */
        }

        .card p {
            text-align: center;
            color: white; /* Description color set to white */
        }

        .discover-more {
            color: rgb(175, 215, 179);
            text-align: center;
            font-size: larger;
        }

        .green-overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: rgb(11, 45, 11); /* Green color */
            transform: translateY(100%);
            transition: transform 0.5s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px; /* Adjust font size for overlay */
            opacity: 0.9; /* Slightly transparent overlay */
            text-align: center;
        }

        .card:hover .green-overlay {
            transform: translateY(0);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .weoff {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .weleft,
            .weright {
                padding: 10px;
                width: 100%;
                box-sizing: border-box;
            }

            .weleft h2 {
                font-size: 50px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg" style="background-color: #fff4e4; padding: 10px 20px; position: fixed; z-index: 1000; width: 100%;">
    <a class="navbar-brand" href="#" style="color: rgb(35, 62, 35); font-size: 24px; font-weight: bold;">
        Sahane Ayurvedalaya
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border: none; background-color: rgb(163, 205, 183);">
        <span class="navbar-toggler-icon" style="color: white;"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav" style="justify-content: flex-end;">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="voila.php" style="color: rgb(7, 32, 7); padding: 14px 20px;">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="voila.php#abt" style="color: rgb(7, 32, 7); padding: 14px 20px;">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="book_appointment.php" style="color: rgb(7, 32, 7); padding: 14px 20px;">Book Appointment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="productcard.php" style="color: rgb(7, 32, 7); padding: 14px 20px;">Order</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cart.php" style="color: rgb(7, 32, 7); padding: 14px 20px;">Cart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="voila.php#con" style="color: rgb(7, 32, 7); padding: 14px 20px;">Contact Us</a>
            </li>

            <!-- Conditional login/signup or profile/logout -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: rgb(7, 32, 7); padding: 14px 20px;">
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="your_orders.php">Your Orders</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php" style="color: rgb(7, 32, 7); padding: 14px 20px;">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php" style="color: rgb(7, 32, 7); padding: 14px 20px;">Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>



    <div class="section3" style= "padding-top:100px;">
        <div class="weoff">
            <div class="weleft">
                <h1>OUR TREATMENT</h1>
                <h2>Comprehensive Ayurveda <br>Treatment for Wellness</h2>
            </div>
            <div class="weright">
                <p style = "font-family:font-family: 'Arial', sans-serif; ">We offer a wide range of Ayurvedic treatments designed to promote holistic healing and restore balance to your body and mind. Whether you're seeking detoxification, pain relief, or rejuvenation, our therapies are tailored to meet your individual needs and ensure lasting wellness.</p>
                <a href="book_appointment.php" style = "text-decoration: none;"><b style="background-color: rgb(11, 45, 11); color: white; padding: 10px; border-radius: 30px; display: inline-block;">Book Appointment</b></a>
            </div>
        </div>

        <div id="scrollSection">
            <div class="card">
                <div class="image-container">
                    <img src="p6.jpg" alt="Ayurvedic Detoxification Therapy">
                </div>
                <div style="padding: 20px;">
                    <h3>Ayurvedic Detoxification Therapy</h3>
                    <p>A natural method to cleanse the body of toxins and restore balance.</p>
                    <p class="discover-more">Discover More</p>
                </div>
                <div class="green-overlay" style=" text-align: center;">This therapy focuses on removing accumulated toxins from the body using natural herbs and techniques. It rejuvenates the internal systems, promoting optimal health and vitality.</div>
            </div>

            <div class="card">
                <div class="image-container">
                    <img src="p7.png" alt="Stress Relief Therapy">
                </div>
                <div style="padding: 20px;">
                    <h3>Stress Relief Therapy</h3>
                    <p>Techniques to reduce stress and enhance relaxation for better mental clarity.</p>
                    <p class="discover-more">Discover More</p>
                </div>
                <div class="green-overlay">A combination of relaxation techniques and Ayurvedic practices designed to reduce stress and anxiety levels. It helps restore mental clarity and emotional balance, fostering a sense of calm and well-being.</div>
            </div>

            <div class="card">
                <div class="image-container">
                    <img src="p8.png" alt="Joint and Muscle Pain Treatment">
                </div>
                <div style="padding: 20px;">
                    <h3>Joint and Muscle Pain Treatment</h3>
                    <p>Herbal remedies and physical therapies to relieve pain and improve mobility.</p>
                    <p class="discover-more">Discover More</p>
                </div>
                <div class="green-overlay"> This treatment employs a blend of herbal remedies, massage, and physical therapies to alleviate pain and inflammation in the joints and muscles. It enhances flexibility and restores mobility, allowing for improved quality of life.</div>
            </div>

            <div class="card">
                <div class="image-container">
                    <img src="p9.png" alt="Rejuvenation Therapy">
                </div>
                <div style="padding: 20px;">
                    <h3>Rejuvenation Therapy</h3>
                    <p>Restorative treatments that revitalize the body and promote a youthful appearance.</p>
                    <p class="discover-more">Discover More</p>
                </div>
                <div class="green-overlay"> A comprehensive treatment designed to restore energy and vitality to the body and mind. It combines nourishing herbal therapies with relaxation techniques to promote a youthful appearance and overall wellness.</div>
            </div>

            <div class="card">
                <div class="image-container">
                    <img src="p10.jpg" alt="Panchakarma Therapy">
                </div>
                <div style="padding: 20px;">
                    <h3>Panchakarma Therapy</h3>
                    <p> A five-step detox process to purify the body and restore overall health.</p>
                    <p class="discover-more">Discover More</p>
                </div>
                <div class="green-overlay">A specialized detoxification process that involves five therapeutic treatments aimed at cleansing the body of impurities. This holistic approach restores balance and harmony, enhancing overall health and well-being.</div>
            </div>

            <div class="card">
                <div class="image-container">
                    <img src="p11.jpg" alt="Beauty Therapy">
                </div>
                <div style="padding: 20px;">
                    <h3>Beauty Therapy</h3>
                    <p>Natural treatments that enhance skin health and promote a radiant glow.</p>
                    <p class="discover-more">Discover More</p>
                </div>
                <div class="green-overlay"> This therapy utilizes Ayurvedic principles to enhance skin health and radiance. It incorporates natural treatments and herbal formulations to rejuvenate the skin, promoting a youthful glow and overall beauty.</div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('scroll', function () {
            var scrollSection = document.getElementById('scrollSection');
            var rect = scrollSection.getBoundingClientRect();

            // Trigger the effect when the section is visible in the viewport
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                scrollSection.style.opacity = '1';
                scrollSection.style.transform = 'translateY(0)';
            }
        });
    </script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>


