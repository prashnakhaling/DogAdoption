<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Happy Tails Dog Adoption</title>
    <link rel="stylesheet" href="adoptionstyle.css">
    <script src="adoption.js"></script>

    <!DOCTYPE html>
    <html lang="en">

    <head>

    </head>

<body>
    <header>
        <h1>Happy Tails Dog Adoption</h1>
        <p>Find your new best friend today!</p>
    </header>

    <nav>
        <a href="#">Home</a>
        <a href="#dogs-showcase">Available Dogs</a>
        <a href="#" onclick="showLoginModal()">Adopt Dog</a>
        <a href="#contact-section">Contact</a>
    </nav>
    <div id="loginModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.6); z-index:10000; justify-content:center; align-items:center;">
        <div style="background:white; padding:2rem; border-radius:8px; width:300px; text-align:center; position:relative;">

            <!-- Tabs -->
            <div>
                <button onclick="showTab('login')" id="loginTab" style="margin-right: 10px;">Login</button>
                <button onclick="showTab('signup')" id="signupTab">Sign Up</button>
            </div>

            <!-- Login Form -->
            <div id="loginForm">
                <h2>Login</h2>
                <form action="login.php" method="POST">
                    <label for="login-name">Name:</label><br>
                    <input type="text" id="login-name" name="name" required><br><br>

                    <label for="login-password">Password:</label><br>
                    <input type="password" id="login-password" name="password" required><br><br>

                    <input type="submit" value="Log In">
                    <h5><a href="signup.html">Create new Account</a></h5>
                </form>
            </div>

            <!-- Sign Up Form -->
            <div id="signupForm" >
                                <h2>Sign Up</h2>
                <form action="signup.php" method="POST">
                    <label for="name">Full Name:</label><br>
                    <input type="text" id="name" name="name" required><br><br>

                    <label for="phone">Phone Number:</label><br>
                    <input type="tel" id="phone" name="phone" placeholder="1234567890" required><br><br>

                    <label for="email">Email Address:</label><br>
                    <input type="email" id="email" name="email" required><br><br>

                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password" required><br><br>

                    <input type="submit" value="Sign Up">
                </form>
            </div>

            <!-- Close Button -->
            <button onclick="hideLoginModal()" style="background:red; color:white; padding:0.5rem; position:absolute; top:10px; right:10px;">X</button>
        </div>
    </div>




    <div id="page-slide-container">
        <button
            onclick="closeSlide()"
            style="position: absolute; top: 10px; right: 20px; padding: 10px">
            Close
        </button>
        <div id="slide-content" style="padding: 60px 20px"></div>
    </div>

    <div class="hero-image">
        <div class="hero-text">
            <h1>Adopt. Love. Repeat.</h1>
            <p>Every dog deserves a forever home. Make a difference today!</p>
        </div>
    </div>

    <div class="center-container">
        <p>
            Adopting a dog is one of the most rewarding and compassionate choices
            you can make. Every year, millions of dogs end up in shelters or rescue
            organizations, many of them waiting for someone to give them a second
            chance at life. By choosing adoption over purchasing from breeders or
            pet stores, you not only provide a loving home to a dog in need, but you
            also help reduce the demand for puppy mills and overbreeding.
            <br /><br />
            Adopted dogs come in all shapes, sizes, and temperaments—from energetic
            puppies to calm senior dogs. Shelters often assess each dog’s
            personality and health, helping you find a pet that matches your
            lifestyle. Plus, adopted dogs are usually spayed or neutered,
            vaccinated, and sometimes even microchipped before going to their new
            homes.
            <br /><br />
            The bond between an adopted dog and their owner can be incredibly
            strong. Many adopters say their dogs seem to know they were rescued and
            return the favor with endless love and loyalty.
        </p>
    </div>

    <section id="dogs-showcase" class="dogs-showcase">
        <div class="dog-card">
            <img src="buddy.jpg" alt="Dog 1" />
            <h3>Buddy</h3>
            <p>2-year-old Golden Retriever</p>
        </div>
        <div class="dog-card">
            <img src="luna.jfif " alt="Dog 2" />
            <h3>Luna</h3>
            <p>3-year-old German Shepherd</p>
        </div>
        <div class="dog-card">
            <img src="luna.jpg" alt="Dog 3" />
            <h3>Luna</h3>
            <p>3-year-old German Shepherd</p>
        </div>
        <div class="dog-card">
            <img src="luna.jpg" alt="Dog 4" />
            <h3>Luna</h3>
            <p>3-year-old German Shepherd</p>
        </div>
        <section class="viewmore">
            <button onclick="showhideUsers()" class="btn">View More</button>
        </section>
    </section>

    <section id="userSection" class="users-section hide">
        <section class="dogs-showcase">
            <!-- Repeat dog cards or dynamically load -->
            <div class="dog-card">
                <img src="buddy.jpg" alt="Dog 1" />
                <h3>Buddy</h3>
                <p>2-year-old Golden Retriever</p>
            </div>
            <div class="dog-card">
                <img src="luna.jpg" alt="Dog 2" />
                <h3>Luna</h3>
                <p>3-year-old German Shepherd</p>
            </div>
            <div class="dog-card">
                <img src="luna.jpg" alt="Dog 3" />
                <h3>Luna</h3>
                <p>3-year-old German Shepherd</p>
            </div>
            <div class="dog-card">
                <img src="luna.jpg" alt="Dog 4" />
                <h3>Luna</h3>
                <p>3-year-old German Shepherd</p>
            </div>
            <div class="dog-card">
                <img src="luna.jpg" alt="Dog 2" />
                <h3>Luna</h3>
                <p>3-year-old German Shepherd</p>
            </div>
            <div class="dog-card">
                <img src="luna.jpg" alt="Dog 3" />
                <h3>Luna</h3>
                <p>3-year-old German Shepherd</p>
            </div>
            <div class="dog-card">
                <img src="luna.jpg" alt="Dog 4" />
                <h3>Luna</h3>
                <p>3-year-old German Shepherd</p>
            </div>
            <!-- Add more dog-cards as needed -->
        </section>
    </section>
    <footer class="simple-footer">
        <div class="footer-content" id="contact-section">
            <div class="footer-content">
                <p>&copy; 2025 Happy Tails Dog Adoption</p>
                <p>Email: info@dogadoption.org | Phone: (123) 456-7890</p>
            </div>
        </div>
    </footer>

</body>

</html>