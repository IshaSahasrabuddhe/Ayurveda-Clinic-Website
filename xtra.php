<?php
session_start();  // Start the session at the top

// Your HTML document starts here
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WT Assignment-3 (12311181)(AIDS_Div-C_Roll-19) Isha Sahasrabuddhe</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Shopify+Sans+Web:wght@400;500&display=swap" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
      @keyframes slideInLeft {
        from {
          transform: translateX(-100%);
          opacity: 0;
        }
        to {
          transform: translateX(0);
          opacity: 1;
        }
      }

      @keyframes slideInRight {
        from {
          transform: translateX(100%);
          opacity: 0;
        }
        to {
          transform: translateX(0);
          opacity: 1;
        }
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
        }
        to {
          opacity: 1;
        }
      }

      .slide-left {
        animation: slideInLeft 2s ease-in-out forwards;
      }

      .slide-right {
        animation: slideInRight 2s ease-in-out forwards;
        text-decoration: none;
      }

      .fade-in {
        animation: fadeIn 2s ease-in-out forwards;
      }

      @media (max-width: 992px) {
        .content1 {
          flex-direction: column;
          height: auto;
        }
        #secl img {
          width: 100%;
          height: auto;
        }
        #right img {
          width: 100%;
          height: auto;
        }
      }

      .sec5CONT.active {
            transform: translateY(0);
            opacity: 1;
        }
     
        .sec5CONT {
            transform: translateY(100%);
            opacity: 0;
            transition: transform 1s ease-out, opacity 1s ease-out;
        }

        /* State when the section is in view */
        .sec5CONT.slide-up {
            transform: translateY(0);
            opacity: 1;
        }
        .section5 {
            background-color: rgb(230, 219, 205);
            padding: 50px;
           
        }

        .contactright img {
            height: 700px;
            width: 600px;
            border-radius: 20px 200px 20px 20px;
            margin-left: 50px;
            position: relative;
            transform: translateY(100px); /* Initial position */
            transition: transform 0.8s ease-out; /* Smooth transition */
        }
       
        .bc1 {
            transform: translateY(100px); /* Initial position below */
            opacity: 0;
            transition: transform 1s ease-out, opacity 1s ease-out;
        }

        /* Apply this class when the section is in view */
        .bc1.slide-up {
            transform: translateY(0); /* Move to normal position */
            opacity: 1; /* Fade in */
        }
       
        #leftcol, #rightcol {
          opacity: 0;}



          /* Navbar specific styles */
.navbar {
    background-color: #fff4e4;
    padding: 10px 20px;
}

.navbar-brand {
    color: rgb(35, 62, 35);
    font-size: 24px;
    font-weight: bold;
}

.nav-link {
    color: rgb(7, 32, 7);
    padding: 14px 20px;
    font-size: 18px;
}

.dropdown-menu {
    background-color: rgb(163, 205, 183); /* Customize dropdown background */
}

.dropdown-item {
    color: rgb(7, 32, 7); /* Customize item text color */
}

.dropdown-item:hover {
    background-color: rgb(120, 180, 160); /* Highlight on hover */
}

      
    </style>
  </head>

  <body style="background-image: url(gre.png);">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <nav class="navbar navbar-expand-lg" style="background-color: #fff4e4; padding: 10px 20px;">
      <a class="navbar-brand" href="#" style="color: rgb(35, 62, 35); font-size: 24px; font-weight: bold;">
        Sahane Ayurvedalaya
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border: none; background-color: rgb(163, 205, 183);">
        <span class="navbar-toggler-icon" style="color: white;">=</span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav" style="justify-content: flex-end;">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#" style="color: rgb(7, 32, 7); padding: 14px 20px;">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" style="color: rgb(7, 32, 7); padding: 14px 20px;">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="book_appointment.php" style="color: rgb(7, 32, 7); padding: 14px 20px;">Book Appointment</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="productcard.php" style="color: rgb(7, 32, 7); padding: 14px 20px;">Order</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#con" style="color: rgb(7, 32, 7); padding: 14px 20px;">Contact Us</a>
          </li>

          <!-- Conditional login/signup or profile/logout -->
          <?php if (isset($_SESSION['user_id'])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: rgb(7, 32, 7); padding: 14px 20px;">
                <?php echo htmlspecialchars($_SESSION['username']); ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="profile.php">Profile</a>
                <a class="dropdown-item" href="settings.php">Settings</a>
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

<!-- Rest of your page content -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <div class="section1" style="padding: 50px; background-color: #fff4e4;">
      <div class="content1" style="border-radius: 20px 200px 30px 30px; background-image: url(gre.png); width: 100%; background-size: cover; display: flex;">
            <div id="secl" style="display: flex;">
            <img src="p1.jpg" class="slide-left" style="height: 900px; width: 800px; padding: 50px; border-radius: 20px 200px 30px 30px; object-fit: cover;" />
            </div>
            <div id="secr" class="fade-in" style="color: white; padding: 50px; padding-top: 150px;">
            <h1 style="font-family: 'Times New Roman', Times, serif; font-size: 20px;">WELCOME TO SAHANE AYURVEDALAYA</h1>
            <h2 style="font-family: 'Times New Roman', Times, serif; font-size: 80px;">Discover the Power of Ayurveda with Our Trusted Experts</h2>
            <div id="2s" style="display: flex;">
                <div id="left" style="padding-top: 50px; padding-right: 50px;">
                <p style="font-size: x-large;">Discover the blyss of ayurvedalaya from the depths of our treatment and medicine.</p>
                <a href="book_appointment.php" class="btn btn-success" style="padding: 10px 20px; border-radius: 30px; background-color: rgb(24, 61, 24); color: white; display: flex; justify-content: center; text-decoration: none;">
                        Make Appointment
                    </a>

                </div>
                <div id="right">
                <img src="p2.jpg" class="slide-right" style="height: 400px; width: 350px; padding: 10px; border-radius: 20px 100px 30px 30px; object-fit: cover;" />
                </div>
            </div>
            </div>
      </div>
    </div>

 <!--   <div class="section2" style="padding: 50px; background-color: #fff4e4">
      <div id="top" style="color: black; font-family: 'Times New Roman', Times, serif; align-items: center; justify-content: center; padding-bottom: 50px;">
          <h1 style="font-family: 'Times New Roman', Times, serif; font-size: 20px; display: flex; align-items: center; justify-content: center;">WHAT WE OFFER</h1>
          <h2 style="font-family: 'Times New Roman', Times, serif; font-size: 70px; display: flex; align-items: center; justify-content: center; text-align: center;">Discover Our<br>Holistic Offerings</h2>
      </div>
      <div class="cards" style="padding-left: 100px; padding-right: 100px; display: flex; flex-wrap: wrap; justify-content: center;">
          <div id="leftcol">
              <div id="c1" style="display: flex; flex-direction: row; height: 400px; background-color: white; width:100%; max-width: 600px; border-radius: 20px 20px 100px 20px;margin: 20px;">
                  <div id="leftc" style="width: 45%; height: 100%;">
                      <img src="p3.png" alt="" style="width: 100%; height: 100%; border-radius: 20px 100px 20px 10px; object-fit: cover;">
                  </div>
                  <div id="rightc" style="width: 55%; padding-left: 50px; padding-top: 50px; padding-right: 10px;">
                      <img src="1.png">
                      <h5 style="font-size: 30px; color: rgb(32, 70, 32); font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Panchakarma Detoxification</h5>
                      <p style="font-size: 20px; padding-top: 0px;">Discover yoga the greatest form of relaxation and mental well-being.</p>
                      <p style="color: rgb(65, 65, 137);">Discover More</p>
                  </div>
              </div>
  
              <div id="c1" style="display:flex; flex-direction: row; height: 400px; background-color: white; width:100%; max-width: 600px; border-radius: 20px 20px 100px 20px; margin: 20px;">
                  <div id="leftc" style="width: 45%; height: 100%;">
                      <img src="p4.jpg" alt="" style="width: 100%; height: 100%; border-radius: 20px 100px 20px 10px; object-fit: cover;">
                  </div>
                  <div id="rightc" style="width: 55%; padding-left: 50px; padding-top: 50px; padding-right: 10px;">
                      <img src="2.png">
                      <h5 style="font-size: 30px; color: rgb(32, 70, 32); font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Abhyanga Massage Therapy</h5>
                      <p style="font-size: 20px; padding-top: 20px;">Discover yoga the greatest form of relaxation and mental well-being.</p>
                      <p style="color: rgb(65, 65, 137);">Discover More</p>
                  </div>
              </div>
          </div>
  
          <div id="rightcol">
              <div id="c1" style="display:flex; flex-direction: row; height: 400px; background-color: white; width:100%; max-width: 600px; border-radius: 20px 20px 100px 20px; margin: 20px;">
                  <div id="leftc" style="width: 45%; height: 100%;">
                      <img src="p5.jpg" alt="" style="width: 100%; height: 100%; border-radius: 20px 100px 20px 10px; object-fit: cover;">
                  </div>
                  <div id="rightc" style="width: 55%; padding-left: 50px; padding-top: 50px; padding-right: 10px;">
                      <img src="3.png">
                      <h5 style="font-size: 30px; color: rgb(32, 70, 32); font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Yoga and Meditation</h5>
                      <p style="font-size: 20px; padding-top: 20px;">Discover yoga the greatest form of relaxation and mental well-being.</p>
                      <p style="color: rgb(65, 65, 137);">Discover More</p>
                  </div>
              </div>
  
              <div id="c1" style="display:flex; flex-direction: row; height: 400px; background-color: white; width:100%; max-width: 600px; border-radius: 20px 20px 100px 20px; margin: 20px;">
                  <div id="leftc" style="width: 45%; height: 100%;">
                      <img src="p2.jpg" alt="" style="width: 100%; height: 100%; border-radius: 20px 100px 20px 10px; object-fit: cover;">
                  </div>
                  <div id="rightc" style="width: 55%; padding-left: 50px; padding-top: 50px; padding-right: 10px;">
                      <img src="4.png">
                      <h5 style="font-size: 30px; color: rgb(32, 70, 32); font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Herbal Medicine Consultations</h5>
                      <p style="font-size: 20px; padding-top: 20px;">Discover yoga the greatest form of relaxation and mental well-being.</p>
                      <p style="color: rgb(65, 65, 137);">Discover More</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
  <script>
      // JavaScript to detect scroll and trigger animations
      document.addEventListener('scroll', function() {
          const section2 = document.querySelector('.section2');
          const leftcol = document.getElementById('leftcol');
          const rightcol = document.getElementById('rightcol');
          const section2Position = section2.getBoundingClientRect().top;
          const screenPosition = window.innerHeight;
  
          if (section2Position < screenPosition) {
              leftcol.classList.add('slide-left');
              rightcol.classList.add('slide-right');
          }
      });

      
  </script> -->
  


  <div class="section2" style="padding: 50px; background-color: #fff4e4">
        <div id="top" style="color: black; font-family: 'Times New Roman', Times, serif; align-items: center; justify-content: center; padding-bottom: 50px;">
            <h1 style="font-family: 'Times New Roman', Times, serif; font-size: 20px; display: flex; align-items: center; justify-content: center;">WHAT WE OFFER</h1>
            <h2 style="font-family: 'Times New Roman', Times, serif; font-size: 70px; display: flex; align-items: center; justify-content: center; text-align: center;">Discover Our<br>Holistic Offerings</h2>
        </div>
        <div class="cards" style="padding-left: 100px; padding-right: 100px; display: flex; flex-wrap: wrap; justify-content: center;">
            <div id="leftcol">
                <div id="c1" class="card" data-id="shirodhara" style="cursor: pointer; display: flex; flex-direction: row; height: 400px; background-color: white; width:100%; max-width: 600px; border-radius: 20px 20px 100px 20px;margin: 20px;">
                    <div id="leftc" style="width: 45%; height: 100%;">
                        <img src="p3.png" alt="" style="width: 100%; height: 100%; border-radius: 20px 100px 20px 10px; object-fit: cover;">
                    </div>
                    <div id="rightc" style="width: 55%; padding-left: 50px; padding-top: 50px; padding-right: 10px;">
                        <img src="1.png">
                        <h5 style="font-size: 30px; color: rgb(32, 70, 32); font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">The Shirodhara Therapy</h5>
                        <p style="font-size: 20px; padding-top: 0px;">Experience the soothing and calming effects of Shirodhara.</p>
                        <p style="color: rgb(65, 65, 137);">Discover More</p>
                    </div>
                </div>

                <div id="c1" class="card" data-id="udvartana" style="cursor: pointer; display:flex; flex-direction: row; height: 400px; background-color: white; width:100%; max-width: 600px; border-radius: 20px 20px 100px 20px; margin: 20px;">
                    <div id="leftc" style="width: 45%; height: 100%;">
                        <img src="p4.jpg" alt="" style="width: 100%; height: 100%; border-radius: 20px 100px 20px 10px; object-fit: cover;">
                    </div>
                    <div id="rightc" style="width: 55%; padding-left: 50px; padding-top: 50px; padding-right: 10px;">
                        <img src="2.png">
                        <h5 style="font-size: 30px; color: rgb(32, 70, 32); font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Udvartana Herbal Scrub</h5>
                        <p style="font-size: 20px; padding-top: 20px;">Udvartana offers rejuvenation and vitality through herbal scrubs.</p>
                        <p style="color: rgb(65, 65, 137);">Discover More</p>
                    </div>
                </div>
            </div>

            <div id="rightcol">
                <div id="c1" class="card" data-id="pranayama" style="cursor: pointer; display:flex; flex-direction: row; height: 400px; background-color: white; width:100%; max-width: 600px; border-radius: 20px 20px 100px 20px; margin: 20px;">
                    <div id="leftc" style="width: 45%; height: 100%;">
                        <img src="p5.jpg" alt="" style="width: 100%; height: 100%; border-radius: 20px 100px 20px 10px; object-fit: cover;">
                    </div>
                    <div id="rightc" style="width: 55%; padding-left: 50px; padding-top: 50px; padding-right: 10px;">
                        <img src="3.png">
                        <h5 style="font-size: 30px; color: rgb(32, 70, 32); font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Pranayama Techniques</h5>
                        <p style="font-size: 20px; padding-top: 20px;">Enhance your life energy with Pranayama breathing exercises.</p>
                        <p style="color: rgb(65, 65, 137);">Discover More</p>
                    </div>
                </div>

                <div id="c1" class="card" data-id="dietary_guidance" style="cursor: pointer; display:flex; flex-direction: row; height: 400px; background-color: white; width:100%; max-width: 600px; border-radius: 20px 20px 100px 20px; margin: 20px;">
                    <div id="leftc" style="width: 45%; height: 100%;">
                        <img src="p2.jpg" alt="" style="width: 100%; height: 100%; border-radius: 20px 100px 20px 10px; object-fit: cover;">
                    </div>
                    <div id="rightc" style="width: 55%; padding-left: 50px; padding-top: 50px; padding-right: 10px;">
                        <img src="4.png">
                        <h5 style="font-size: 30px; color: rgb(32, 70, 32); font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Ayurvedic Dietary Guidance</h5>
                        <p style="font-size: 20px; padding-top: 20px;">Discover personalized dietary guidance based on Ayurvedic principles.</p>
                        <p style="color: rgb(65, 65, 137);">Discover More</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to make cards clickable -->
    <script>
        // JavaScript to navigate to the detail page
        document.querySelectorAll('.card').forEach(function(card) {
            card.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                window.location.href = `detail.html?id=${id}`; // Changed detail.html to detail.php
            });
        });

        // JavaScript to detect scroll and trigger animations
        document.addEventListener('scroll', function() {
            const section2 = document.querySelector('.section2');
            const leftcol = document.getElementById('leftcol');
            const rightcol = document.getElementById('rightcol');
            const section2Position = section2.getBoundingClientRect().top;
            const screenPosition = window.innerHeight;

            if (section2Position < screenPosition) {
                leftcol.classList.add('slide-left');
                rightcol.classList.add('slide-right');
            }
        });
    </script>

      
      <!-- Add spacers to enable scrolling -->
   

      <div class="section3" style="background-color: white; color: rgb(11, 45, 11); position: relative; padding: 20px;">
        <div class="weoff" style="display: flex; flex-wrap: wrap; align-items: flex-start;">
            <div class="weleft" style="flex: 1; min-width: 300px; padding: 20px; box-sizing: border-box;">
                <h1 style="font-family: Georgia, 'Times New Roman', Times, serif; font-size: 20px; font-weight: 500;">OUR TREATMENT</h1>
                <h2 style="font-family: 'Times New Roman', Times, serif; font-size: 70px;">Comprehensive Ayurveda <br>Treatment for Wellness</h2>
            </div>
            <div class="weright" style="flex: 1; min-width: 300px; padding: 20px; box-sizing: border-box;">
                <p style="padding-bottom: 50px;">We offer a wide range of Ayurvedic treatments designed to promote holistic healing and restore balance to your body and mind. Whether you're seeking detoxification, pain relief, or rejuvenation, our therapies are tailored to meet your individual needs and ensure lasting wellness.</p>
                <b style="background-color: rgb(11, 45, 11); color: white; padding: 10px; border-radius: 30px; display: inline-block;">See more treatment</b>
            </div>
        </div>
    
        <div id="scrollSection" style="padding: 20px; color: white; display: flex; flex-wrap: wrap; justify-content: center; opacity: 0; transform: translateY(50px); transition: opacity 1s ease-out, transform 1s ease-out;">
            <div style="height: 700px; background-color: rgb(2, 18, 4); width: 100%; max-width: 430px; border-radius: 20px 100px 20px 20px; margin: 10px;">
                <div style="height: 60%; width: 100%; border-radius: 20px 100px 20px 20px;">
                    <img src="p6.jpg" style="height: 100%; width: 100%; border-radius: 20px 100px 0px 0px; object-fit: cover;">
                </div>
                <div style="padding: 20px;">
                    <h3 style="font-size: 35px; font-family: 'Times New Roman', Times, serif; text-align: center;">Ayurvedic Detoxification Therapy</h3>
                    <p style="text-align: center;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt, eaque.</p>
                    <p style="color: rgb(175, 215, 179); text-align: center; font-size: larger;"><a href = "treatment.html" style = "text-decoration: none; color: rgb(175, 215, 179); text-align: center; ">Discover More </a></p>
                </div>
            </div>

            <div style="height: 700px; background-color: rgb(2, 18, 4); width: 100%; max-width: 430px; border-radius: 20px 100px 20px 20px; margin: 10px;">
                <div style="height: 60%; width: 100%; border-radius: 20px 100px 20px 20px;">
                    <img src="p7.png" style="height: 100%; width: 100%; border-radius: 20px 100px 0px 0px; object-fit: cover;">
                </div>
                <div style="padding: 20px;">
                    <h3 style="font-size: 35px; font-family: 'Times New Roman', Times, serif; text-align: center;">Stress Relief Therapy</h3>
                    <p style="text-align: center;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt, eaque.</p>
                    <p style="color: rgb(175, 215, 179); text-align: center; font-size: larger;"><a href = "treatment.html" style = "text-decoration: none; color: rgb(175, 215, 179); text-align: center; ">Discover More </a></p>
                </div>
            </div>

            <div style="height: 700px; background-color: rgb(2, 18, 4); width: 100%; max-width: 430px; border-radius: 20px 100px 20px 20px; margin: 10px;">
                <div style="height: 60%; width: 100%; border-radius: 20px 100px 20px 20px;">
                    <img src="p8.png" style="height: 100%; width: 100%; border-radius: 20px 100px 0px 0px; object-fit: cover;">
                </div>
                <div style="padding: 20px;">
                    <h3 style="font-size: 35px; font-family: 'Times New Roman', Times, serif; text-align: center;">Joint and Muscle Pain Treatment</h3>
                    <p style="text-align: center;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt, eaque.</p>
                    <p style="color: rgb(175, 215, 179); text-align: center; font-size: larger;"><a href = "treatment.html" style = "text-decoration: none; color: rgb(175, 215, 179); text-align: center; ">Discover More </a></p>
                </div>
            </div>
    
            <!-- Repeat the card div for additional cards as needed -->
        </div>
    </div>
    
    <script>
        window.addEventListener('scroll', function() {
            var scrollSection = document.getElementById('scrollSection');
            var rect = scrollSection.getBoundingClientRect();
            
            // Trigger the effect when the section is visible in the viewport
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                scrollSection.style.opacity = '1';
                scrollSection.style.transform = 'translateY(0)';
            }
        });
    </script>
    
    <style>
    /* Inline style tags used for responsive design */
    @media (max-width: 768px) {
        .weoff {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .weleft, .weright {
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }
        .weleft h2 {
            font-size: 50px; /* Adjust font size for smaller screens */
        }
    }
    </style>
    
      

      
     

      <div class="section4" style="display: flex; background-color: #fff4e4; width: 100%; padding: 100px;">
        <div class="workleft" style="width: 50%; padding-left: 100px;">
            <h3 style="font-family: Georgia, 'Times New Roman', Times, serif; font-size: 20px; font-weight: 500;">HOW IT WORKS</h3>
            <h4 style="font-family: 'Times New Roman', Times, serif; font-size: 70px; padding-bottom: 30px;">Simple and Effective Healing Process</h4>
            
            <div class="hiwcon1" style="display: flex; padding-bottom: 20px;">
                <div class="hcl">
                    <h1 style="font-size: 50px; padding-right: 40px; font-family: Georgia, 'Times New Roman', Times, serif; padding-top: 20px; color: rgb(36, 68, 36);">01</h1>
                </div>
                <div class="hcr" style="padding-top: 10px;">
                    <h4 style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 30px">Initial Consultation</h4>
                    <p>During the initial consultation, our expert Ayurvedic practitioners assess your overall health and lifestyle. This helps us understand your unique constitution (Prakriti) and any imbalances (Vikriti) that need to be addressed.</p>
                    <hr>
                </div>
            </div>

            <div class="hiwcon1" style="display: flex; padding-bottom: 20px;">
                <div class="hcl">
                    <h1 style="font-size: 50px; padding-right: 40px; font-family: Georgia, 'Times New Roman', Times, serif; padding-top: 20px; color: rgb(36, 68, 36);">02</h1>
                </div>
                <div class="hcr" style="padding-top: 10px;">
                    <h4 style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 30px">Personalized Treatment Plan</h4>
                    <p>Based on the consultation, we create a customized treatment plan tailored to your specific needs. This includes personalized therapies, dietary recommendations, and lifestyle changes to restore balance and well-being.</p>
                    <hr>
                </div>
            </div>

            <div class="hiwcon1" style="display: flex; padding-bottom: 20px;">
                <div class="hcl">
                    <h1 style="font-size: 50px; padding-right: 40px; font-family: Georgia, 'Times New Roman', Times, serif; padding-top: 20px; color: rgb(36, 68, 36);">03</h1>
                </div>
                <div class="hcr" style="padding-top: 10px;">
                    <h4 style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 30px">Therapy Sessions</h4>
                    <p>Our carefully administered therapy sessions follow the Ayurvedic principles of healing. Whether it’s detoxification, massage, or herbal treatments, each session is designed to promote rejuvenation, alleviate discomfort, and restore harmony to your body and mind.</p>
                    <hr>
                </div>
            </div>
        </div>

        <div class="workright" style="width: 50%; position: relative;">
            <img src="p9.png" alt="Description of Image" style="height: 700px; width: 600px; border-radius: 20px 200px 20px 20px; margin-left: 50px; opacity: 0; transform: translateX(100px); transition: opacity 1s ease-out, transform 1s ease-out;">
        </div>
    </div>

    <script>
        window.addEventListener('scroll', function() {
            var workrightImg = document.querySelector('.workright img');
            var rect = workrightImg.getBoundingClientRect();
            
            // Trigger the effect when the image is visible in the viewport
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                workrightImg.style.opacity = '1';
                workrightImg.style.transform = 'translateX(0)';
            }
        });
    </script>

    
<div class="section5">
  <div class="sec5CONT" style="border-radius: 20px 200px 20px 20px; background-image: url(gre.png); width: 80%; background-size: cover; color: white; align-self: center; 
  justify-content: center; margin-left: auto; margin-right: auto; padding-top: 50px; padding-left: 80px; padding-right: 80px; padding-bottom: 100px; background-attachment: fixed; box-sizing: border-box;">
      <div id="top" style="color: white; font-family: 'Times New Roman', Times, serif; align-items: center; justify-content: center; padding-bottom: 50px; text-align: center;">
          <h1 style="font-family: 'Times New Roman', Times, serif; font-size: 20px;">WHY CHOOSE US</h1>
          <h2 style="font-family: tr; font-size: 60px;">Experience True Wellness <br>with Ayurveda</h2>
      </div>

      <div class="secont" style="display: flex; flex-wrap: wrap; justify-content: space-between;">
          <div class="exp1" style="flex: 1; min-width: 300px; margin: 10px; display: flex; flex-direction: column; align-items: center;">
              <div class="expleft" style="padding: 10px; text-align: center;">
                  <h3 style="font-size: 35px; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Mastery in <br> Ayurvedic Tradition</h3>
                  <p>Our skilled practitioners deliver genuine Ayurvedic treatments, drawing from time-honored practices and knowledge.</p>
                  <p style="color: rgb(175, 215, 179); font-size: larger;">Discover More</p>
              </div>
              <div class="vl" style="border-left: 3px solid white; height: 150px; margin: 10px; padding-top: 20px; display: none;"></div>
          </div>

          <div class="exp1" style="flex: 1; min-width: 300px; margin: 10px; display: flex; flex-direction: column; align-items: center;">
              <div class="expleft" style="padding: 10px; text-align: center;">
                  <h3 style="font-size: 35px; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Holistic Healing<br> Approach</h3>
                  <p>We provide therapies that treat the root cause, focusing on restoring balance in body, mind, and spirit.</p>
                  <p style="color: rgb(175, 215, 179); font-size: larger;">Discover More</p>
              </div>
              <div class="vl" style="border-left: 3px solid white; height: 150px; margin: 10px; padding-top: 20px; display: none;"></div>
          </div>

          <div class="exp1" style="flex: 1; min-width: 300px; margin: 10px; display: flex; flex-direction: column; align-items: center;">
              <div class="expleft" style="padding: 10px; text-align: center;">
                  <h3 style="font-size: 35px; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Expertise in<br> Personalized Care</h3>
                  <p>Each treatment is tailored to your unique needs, ensuring effective and individualized healing.</p>
                  <p style="color: rgb(175, 215, 179); font-size: larger;">Discover More</p>
              </div>
          </div>
      </div>
  </div>
</div>

<!-- Script to add the slide-up effect on scroll -->
<script>
  document.addEventListener("scroll", function() {
      var section5 = document.querySelector(".section5");
      var sec5CONT = document.querySelector(".sec5CONT");

      var sectionPosition = section5.getBoundingClientRect().top;
      var screenPosition = window.innerHeight;

      if (sectionPosition < screenPosition) {
          sec5CONT.classList.add("slide-up");
      }
  });
</script>

<style>
  @media (max-width: 768px) {
      .sec5CONT {
          width: 90%;
          padding: 20px;
          margin-left: auto;
          margin-right: auto;
      }
      #top h1 {
          font-size: 16px;
      }
      #top h2 {
          font-size: 40px;
      }
      .secont {
          flex-direction: column;
      }
      .exp1 {
          min-width: 100%;
          margin: 0 0 20px 0;
      }
      .vl {
          display: none;
      }
  }
  @media (max-width: 480px) {
      #top h1 {
          font-size: 14px;
      }
      #top h2 {
          font-size: 30px;
      }
      .exp1 {
          margin: 0;
      }
  }
</style>
    
<div class="section6" style="background-color: white; display: flex; padding: 100px 150px; flex-wrap: wrap;">
  <div class="sec6con" style="display: flex; width: 100%; flex-wrap: wrap;">
      <div class="testleft" style="flex: 1; overflow: hidden; position: relative; border-radius: 20px 200px 20px 20px; display: flex; justify-content: center;">
          <img src="p10.jpg" alt="Description of Image" style="height: 700px; width: 600px; border-radius: 20px 200px 20px 20px; transform: translateX(-100%); transition: transform 0.8s ease-out; object-fit: cover;">
      </div>

      <div class="testright" style="flex: 1; color: rgb(51, 70, 51); padding-left: 100px; padding-top: 20px; display: flex; flex-direction: column; align-items: flex-start;">
          <h1 style="font-family: 'Times New Roman', Times, serif; font-size: 20px;">TESTIMONIAL</h1>
          <h2 style="font-family: 'Times New Roman', Times, serif; font-size: 75px;">Simple and Effective Healing Process</h2>
          <p style="font-size: 16px;">Our patients have experienced profound relief and rejuvenation through our personalized Ayurvedic treatments. From chronic pain to stress management, the simple yet effective healing process has transformed their health and well-being, helping them live more balanced and fulfilling lives.

</p>

          <div class="tescont" style="height: 400px; width: 500px; border-radius: 20px 100px 20px 20px; padding-top: 10px;">
          <div id="cardCarousel2" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <!-- First Card -->
        <div class="carousel-item active">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><strong>Rahul Sharma</strong></h5>
                    <p class="card-text">
                        <span style="color: gold;">★★★★★</span> <br>
                        "The treatments at Sahane Ayurvedalaya have significantly improved my overall health and well-being. I feel more balanced and energetic!"
                        <br>
                        "The staff is very knowledgeable and attentive, making each visit a pleasure."
                    </p>
                </div>
            </div>
        </div>
        <!-- Second Card -->
        <div class="carousel-item">
            <div class="card" style= "height:300px;padding:30px;border-radius:10px 70px 10px 10px;">
                <div class="card-body">
                    <h5 class="card-title"><strong>Priya Desai</strong></h5>
                    <p class="card-text">
                        <span style="color: gold;">★★★★☆</span>  <br>
                        "I experienced great relief from stress after my sessions here. The personalized approach made all the difference."
                        <br>
                        "I would highly recommend their services to anyone seeking true relaxation."
                    </p>
                </div>
            </div>
        </div>
        <!-- Third Card -->
        <div class="carousel-item">
            <div class="card"  style= "height:300px;padding:30px;border-radius:10px 70px 10px 10px;">
                <div class="card-body">
                    <h5 class="card-title"><strong>Anil Kumar</strong></h5>
                    <p class="card-text">
                        <span style="color: gold;">★★★★★</span>  <br>
                        "The joint pain treatment was incredibly effective! I can move more freely now, thanks to the expert care."
                        <br>
                        "I appreciate the holistic approach they take towards healing."
                    </p>
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


<script>
  function checkVisibility() {
      const testleftImg = document.querySelector('.testleft img');
      const section = document.querySelector('.section6');
      const rect = section.getBoundingClientRect();

      // Check if section is in the viewport
      if (rect.top < window.innerHeight && rect.bottom >= 0) {
          testleftImg.style.transform = 'translateX(0)';
      } else {
          testleftImg.style.transform = 'translateX(-100%)';
      }
  }

  window.addEventListener('scroll', checkVisibility);
  window.addEventListener('load', checkVisibility); // To check visibility when the page loads
</script>

<style>
  @media (max-width: 768px) {
    .section6 {
      padding: 50px 20px;
      flex-direction: column;
    }
    .testleft, .testright {
      flex: 1 100%;
      padding: 0;
      margin: 0;
    }
    .testleft img, .tescont img {
      width: 100%;
      height: auto;
    }
    .testright {
      padding-left: 0;
      padding-top: 20px;
    }
  }
</style>


<div class="section7" id="con"style="background-color: #fff4e4; padding-top: 100px;">
  <div class="contactcont" style="border-radius: 20px 250px 20px 20px; background-color: orange; width: 80%; background-size: cover; color: white; align-self: center; justify-content: center; margin-left: 150px; padding-top: 50px; padding-left: 150px; padding-right: 150px; padding-bottom: 100px; background-attachment: fixed; display: flex;">

      <div class="contactleft" style="width: 50%;">
          <h1 style="font-family: 'Times New Roman', Times, serif; font-size: 20px;">CONTACT US</h1>
          <h2 style="font-family: 'Times New Roman', Times, serif; font-size: 65px;">Get in Touch <br>with Us Today</h2>

          <div style="width: 500px; height: 500px; padding: 20px; box-sizing: border-box; background-color: white; border-radius: 20px 100px 20px 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding-top: 90px;">
              <form style="display: flex; flex-direction: column; gap: 20px; padding: 10px;">
                  <div style="display: flex; gap: 20px;">
                      <input type="text" name="name" placeholder="Name" style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                      <input type="email" name="email" placeholder="Email" style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                  </div>
                  <div style="display: flex; gap: 20px;">
                      <input type="tel" name="number" placeholder="Number" style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                      <input type="text" name="subject" placeholder="Subject" style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                  </div>
                  <textarea name="message" placeholder="Message" rows="6" style="width: 80%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;"></textarea>
                  <button type="submit" style="padding: 10px; background-color: orange; color: white; border: none; border-radius: 25px; font-size: 16px; cursor: pointer; width: 200px;">Send Message</button>
              </form>
          </div>
      </div>

      <div class="contactright" style="padding-left: 50px; padding-top: 20px;">
          <img src="lf.jpg" alt="Description of Image">
      </div>
  </div>
</div>

<script>
  window.addEventListener('scroll', function() {
      const contactRightImg = document.querySelector('.contactright img');
      const section7 = document.querySelector('.section7');
      const section7Position = section7.getBoundingClientRect().top;
      const triggerPoint = window.innerHeight * 0.75; // Trigger when section7 is 75% visible

      if (section7Position < triggerPoint) {
          contactRightImg.style.transform = 'translateY(0)';
      } else {
          contactRightImg.style.transform = 'translateY(100%)';
      }
  });
</script>

<div class="section8" style="background-color: #fff4e4; padding-top: 100px; padding-bottom: 100px; color: black;">
  <div id="top" style="color: black; font-family: 'Times New Roman', Times, serif; align-items: center; justify-content: center; padding-bottom: 50px;">
      <h1 style="font-family: 'Times New Roman', Times, serif; font-size: 20px; display: flex; align-items: center; justify-content: center;">BLOG POST</h1>
      <h2 style="font-family: 'Times New Roman', Times, serif; font-size: 70px; display: flex;align-items: center; justify-content: center; text-align: center;">Discover Ayurvedic <br> Wellness Insights</h2>
  </div>

  <div class="blogcrd" style="padding-left: 150px; padding-right: 150px; display: flex; align-items: center; justify-content: center;">
      <div class="bc1" style="height: 450px; width: 400px; background-color: white; border-radius: 20px 100px 20px 20px; border-width: 2px; margin: 20px;">
          <img src="p11.jpg" style="height: 60%; width: 100%; object-fit: cover; border-radius: 20px 100px 0px 0px;">
          <h1 style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 20px; padding-left: 20px; padding-top: 30px; padding-right: 20px;">Yoga and Ayurveda: A Perfect Combination</h1>
          <p style="color: rgb(142, 142, 213); font-size: 25px; padding: 20px;">Learn More</p>
      </div>

      <div class="bc1" style="height: 450px; width: 400px; background-color: white; border-radius: 20px 100px 20px 20px; border-width: 2px; margin: 20px;">
          <img src="p12.png" style="height: 60%; width: 100%; object-fit: cover; border-radius: 20px 100px 0px 0px;">
          <h1 style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 20px; padding-left: 20px; padding-top: 30px; padding-right: 20px;">Yoga and Ayurveda: A Perfect Combination</h1>
          <p style="color: rgb(142, 142, 213); font-size: 25px; padding: 20px;">Learn More</p>
      </div>

      <div class="bc1" style="height: 450px; width: 400px; background-color: white; border-radius: 20px 100px 20px 20px; border-width: 2px; margin: 20px;">
          <img src="p13.jpg" style="height: 60%; width: 100%; object-fit: cover; border-radius: 20px 100px 0px 0px;">
          <h1 style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 20px; padding-left: 20px; padding-top: 30px; padding-right: 20px;">Yoga and Ayurveda: A Perfect Combination</h1>
          <p style="color: rgb(142, 142, 213); font-size: 25px; padding: 20px;">Learn More</p>
      </div>
  </div>
</div>

<script>
  // JavaScript to detect scroll and trigger animations
  document.addEventListener('scroll', function() {
      const section8 = document.querySelector('.section8');
      const cards = document.querySelectorAll('.bc1');
      const section8Position = section8.getBoundingClientRect().top;
      const screenPosition = window.innerHeight;

      if (section8Position < screenPosition) {
          cards.forEach(card => {
              card.classList.add('slide-up');
          });
      }
  });
</script>


<div class="footer" style="padding: 100px; color: white;">
  <div class="footerleft">
    <h1 style="padding-bottom: 30px;">Sahane Ayurvedalaya</h1>
<div class="fono" style="display: flex; justify-content: center; align-items: center;">
    <div class="timings" style="padding: 50px;">
      <h2>Working Hours</h2>
      <div class="tim" style="display: flex;">
        <p style="margin: 5px 0; font-size: 16px;">Monday - Friday<br>08:00 AM - 08:00 PM</p>
        <p style="margin: 5px 0; font-size: 16px;">Saturday - Sunday<br>10:00 AM - 08:00 PM</p>
      </div>
    </div>

    <div class="timings" style="padding: 50px;">
      <h2>Social Media Links</h2>
      <div class="tim" style="display:flex; justify-content: space-between;">
        <i class="ri-instagram-line" style="font-size: 30px;"></i>
        <i class="ri-twitter-x-line" style="font-size: 30px;"></i>
        <i class="ri-linkedin-line" style="font-size: 30px;"></i>
        
      </div>
    </div>

    <div class="timings" style="padding: 50px;">
      <h2>Working Hours</h2>
      <div class="tim" style="display: flex;">
        <p style="margin: 5px 0; font-size: 16px;">Monday - Friday<br>08:00 AM - 08:00 PM</p>
        <p style="margin: 5px 0; font-size: 16px;">Saturday - Sunday<br>10:00 AM - 08:00 PM</p>
      </div>
    </div>
  </div>

  </div>
</div>
    
    </body>
  </html>

