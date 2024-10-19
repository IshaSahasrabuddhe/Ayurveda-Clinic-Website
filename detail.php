<?php
session_start();  // Start the session at the top

// Your HTML document starts here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="deals.css">
    <title>Detail Page</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white; /* Background color similar to index.html */
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            font-size: 2.5em; /* Larger font size */
            color: #4a4a4a; /* Text color */
            margin-bottom: 20px; /* Spacing below the title */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
        }
        #carousel {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            width: 100%; /* Full width */
            overflow: hidden; /* Hide overflow */
            border-radius: 50px; /* Optional: rounded corners */
            height: 700px; 
            width: 100%;
        }
        .carousel-images {
            display: none;
            transition: 0.5s ease; /* Add smooth transition */
            border-radius: 50px;
            
        }
        .carousel-images img {
            width: 100%; /* Full width */
            height: auto; /* Maintain aspect ratio */
            border-radius: 50px;
        }
        .active {
            display: block; /* Show active image */
        }
        .button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 1; /* Ensure buttons are on top */
        }
        .button.prev {
            left: 10px;
        }
        .button.next {
            right: 10px;
        }
        .section2 {
            padding: 50px; 
            background-color: #fff4e4;
        }
        .section2 h1, .section2 h2 {
            font-family: 'Times New Roman', Times, serif; 
            text-align: center;
        }
        .section2 h1 {
            font-size: 20px;
            padding-bottom: 50px;
            color: black;
        }
        .section2 h2 {
            font-size: 70px;
        }
        .carousel-item img {
            height: 800px; 
            object-fit: cover;
            border-radius: 50px;
        }
        .card{
            border-radius: 50px;
            padding: 10px;
            height: 300px;
            background-color: #d8f0e0;
        }
       .card-body{
        text-align: justify;
       }
    </style>
</head>
<body >

    <!-- jQuery and Bootstrap JS for dropdown functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <nav class="navbar navbar-expand-lg" style="background-color: #fff4e4; padding: 10px 20px; ">
      <a class="navbar-brand" href="#" style="color: rgb(35, 62, 35); font-size: 24px; font-weight: bold;">
        Sahane Ayurvedalaya
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border: none; background-color: rgb(163, 205, 183);">
        <span class="navbar-toggler-icon" style="color: white;">=</span>
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




    <div id="content" style="padding-left: 60px; padding-right: 60px; padding-bottom: 100px;">
        <div class="row" style= "padding-top: 20px">
        <!-- Header Section -->
            <div class="headcont" style="display: flex; justify-content: left; align-items: center; height: 300px; width: 100%; border-radius: 50px 180px 50px 50px; background-color: rgb(6, 19, 6); color: white;  padding: 0 20px; background-image: url(gre.png); padding-left: 100px;">
                <h1 id="title" style="color: white; font-size: 50px; text-align: center;">Your Title Here</h1>
            </div>
        </div>
        
        <!-- Inline Media Queries for Responsiveness -->
        <style>
            @media (max-width: 768px) {
                .headcont {
                    height: 250px !important;
                    border-radius: 30px 120px 30px 30px !important;
                }
        
                #title {
                    font-size: 40px !important;
                    padding-top: 80px !important;
                }
            }
        
            @media (max-width: 480px) {
                .headcont {
                    height: 200px !important;
                    border-radius: 20px 100px 20px 20px !important;
                }
        
                #title {
                    font-size: 30px !important;
                    padding-top: 60px !important;
                }
            }
        </style>
        
    
        <!-- Carousel and Side Section -->
        <div class="row">
            <!-- Carousel (8 columns) -->
            <div id="carousel" class="col-md-8" >
                <!-- Images will be inserted here -->
            </div>
    
            <!-- Side Section (4 columns) -->
            <div class="col-md-4">
                <!-- Content for the side section next to the carousel -->
                <div class="side-content" style="background-color: rgb(3, 40, 3); height: 100%; padding: 30px; border-radius: 50px; color: white; padding-top: 50px; margin-top: 10px;">
                    <div >
                        <h2 style="color: white; font-family: 'Times New Roman', Times, serif;">Experience Transformative Healing at Sahane Ayurvedalaya</h2>
                        <p style="font-size: 16px; color: white; line-height: 1.6; text-align: justify; padding-top: 20px;">
                            At Sahane Ayurvedalaya, our commitment to holistic wellness and natural healing sets us apart. Our treatments are meticulously crafted by seasoned Ayurvedic experts who prioritize your well-being. We take pride in the positive feedback from our clients, who consistently rate our services highly, with an impressive average of 4.9 out of 5 stars. Our diverse range of therapies, including personalized consultations, detoxification programs like Panchakarma, and rejuvenating massages such as Abhyanga, have proven effective in relieving various discomforts. Whether you're seeking relief from stress, chronic pain, or simply looking to enhance your overall health, our carefully curated Ayurvedic treatments offer a path to rejuvenation and harmony. Join us at Sahane Ayurvedalaya, where ancient wisdom meets modern care, and embark on your journey to optimal health.
                        </p>
                        <a href="book_appointment.php" style="display: inline-block; margin-top: 15px; padding: 10px 20px; font-size: 18px; color: #03240e; background-color: #c8e6cf; text-decoration: none; border-radius: 50px;">Book Your Appointment Now</a>
                    </div>
                    
                </div>
            </div>
        </div>
    
        <!-- Descriptions and Side Section -->
        <div class="row mt-4">
            <!-- Descriptions (8 columns) -->
            <div class="descriptions col-md-8">
                <p id="short_description"></p>
                <p id="long_description" style=" text-align: justify;"></p>
                <p id="welcome_message"></p>
            </div>
    
            <!-- Side Section (4 columns) -->
            <div class="col-md-4">
                <div id="cardCarousel2" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <!-- First Card -->
                        <div class="carousel-item active">
                            <div class="card" style="height: 300px;">
                            
                                <div class="card-body" >
                                    <h5 class="card-title">Holistic Healing</h5>
                                    <p class="card-text">Ayurveda emphasizes a holistic approach to health, addressing the physical, mental, and spiritual aspects of well-being. It seeks to balance the body’s energies (doshas) and promote overall harmony, leading to improved health and vitality.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Second Card -->
                        <div class="carousel-item">
                            <div class="card">
                                
                                <div class="card-body">
                                    <h5 class="card-title">Natural Remedies</h5>
                                    <p class="card-text"> Ayurvedic treatments utilize natural herbs, oils, and therapies, minimizing the use of synthetic drugs. This not only reduces the risk of side effects but also promotes long-term health by enhancing the body’s natural healing processes.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Third Card -->
                        <div class="carousel-item">
                            <div class="card">
                               
                                <div class="card-body">
                                    <h5 class="card-title">Personalized Care</h5>
                                    <p class="card-text">Ayurveda recognizes that each individual is unique, with different constitutions and needs. Treatments are tailored to the individual's specific dosha, lifestyle, and health conditions, resulting in more effective and personalized care. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Carousel Controls -->
                    <a class="carousel-control-prev" href="#cardCarousel2" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#cardCarousel2" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    

    <!-- Added Section -->
    <div class="section2">
        <div id="top">
            <h1>WHAT WE OFFER</h1>
            <h2>Discover Our<br>Holistic Offerings</h2>
        </div>

        <div class="carousel slide" id="carouselExampleIndicators" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="p3.png" class="d-block w-100" alt="Panchakarma Detoxification">
                    <div class="carousel-caption">
                        <h5>The Shirodhara Therapy</h5>
                        <p>Experience the soothing and calming effects of Shirodhara.</p>
                        <a href="http://localhost/cp/detail.html?id=shirodhara">
                            <p style="color: rgb(65, 65, 137); text-decoration: none;">Discover More</p>
                        </a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="p4.jpg" class="d-block w-100" alt="Abhyanga Massage Therapy">
                    <div class="carousel-caption">
                        <h5>Udvartana Herbal Scrub</h5>
                        <p>Udvartana offers rejuvenation and vitality through herbal scrubs.</p>
                        <p style="color: rgb(65, 65, 137);">Discover More</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="p5.jpg" class="d-block w-100" alt="Yoga and Meditation">
                    <div class="carousel-caption">
                        <h5>Pranayama Techniques</h5>
                        <p>Enhance your life energy with Pranayama breathing exercises.</p>
                        <p style="color: rgb(65, 65, 137);">Discover More</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="p2.jpg" class="d-block w-100" alt="Herbal Medicine Consultations">
                    <div class="carousel-caption">
                        <h5>Ayurvedic Dietary Guidance</h5>
                        <p>Discover personalized dietary guidance based on Ayurvedic principles.</p>
                        <p style="color: rgb(65, 65, 137);">Discover More</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        
    </div>

    <script>
        // Function to get query parameter by name
        function getQueryParam(name) {
            const params = new URLSearchParams(window.location.search);
            return params.get(name);
        }

        // Fetch data and display the details
        const id = getQueryParam('id');

        fetch('offerings.json')
            .then(response => response.json())
            .then(data => {
                const item = data.find(d => d.id === id);
                if (item) {
                    document.getElementById('title').innerText = item.title;
                    document.getElementById('short_description').innerText = item.short_description;
                    document.getElementById('long_description').innerText = item.long_description;
                    document.getElementById('welcome_message').innerText = item.welcome_message;

                    // Create image carousel
                    const carouselDiv = document.getElementById('carousel');
                    item.images.forEach((image, index) => {
                        const imgDiv = document.createElement('div');
                        imgDiv.classList.add('carousel-images');
                        imgDiv.classList.toggle('active', index === 0); // Set the first image active

                        const img = document.createElement('img');
                        img.src = image;
                        imgDiv.appendChild(img);
                        carouselDiv.appendChild(imgDiv);
                    });

                    // Add navigation buttons
                    const prevButton = document.createElement('button');
                    prevButton.innerText = '❮';
                    prevButton.classList.add('button', 'prev');
                    carouselDiv.appendChild(prevButton);

                    const nextButton = document.createElement('button');
                    nextButton.innerText = '❯';
                    nextButton.classList.add('button', 'next');
                    carouselDiv.appendChild(nextButton);

                    let currentIndex = 0;

                    function showImage(index) {
                        const images = document.querySelectorAll('.carousel-images');
                        images[currentIndex].classList.remove('active');
                        currentIndex = (index + images.length) % images.length; // Loop around
                        images[currentIndex].classList.add('active');
                    }

                    nextButton.onclick = () => showImage(currentIndex + 1);
                    prevButton.onclick = () => showImage(currentIndex - 1);

                    // Automatic carousel functionality
                    setInterval(() => {
                        showImage(currentIndex + 1);
                    }, 5000); // Change image every 5 seconds

                } else {
                    document.getElementById('content').innerHTML = '<p>Item not found.</p>';
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
