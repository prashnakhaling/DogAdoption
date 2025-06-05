<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Happy Tails Dog Adoption</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #fefefe;
            color: #333;
        }

        header {
            background-color: #adb2d4;
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        nav {
            display: flex;
            justify-content: center;
            background: #f2f2f2;
            padding: 1rem;
        }

        nav a {
            margin: 0 1rem;
            text-decoration: none;
            color: #333;
        }

        .hero-image {
            background-image: url("images/bgimage.jpg");
            height: 800px;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .hero-text {
            color: transparent;
            background: linear-gradient(to right, rgb(244, 244, 246) 50%, rgb(67, 75, 121) 50%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }


        .hero-text h1 {
            font-size: 3rem;
        }

        .hero-text p {
            font-size: 1.2rem;
        }

        .quizzle-container {
            width: 80%;
            margin: 2rem auto;
        }

        .quizzle-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            /* space between cards */
            justify-content: center;
        }

        .quizzle-card {
            flex: 1 1 calc(50% - 1.5rem);
            /* 50% width minus gap */
            max-width: calc(20% - 1.5rem);
            box-sizing: border-box;
        }

        .quizzle-card button,
        .quizzle-card a {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            background: #fff;
            border: 2px solid #ddd;
            border-radius: 12px;
            padding: 1.5rem 1rem;
            width: 100%;
            cursor: pointer;
            color: #333;
            transition: all 0.3s ease;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .quizzle-card button:hover,
        .quizzle-card a:hover {
            border-color: #5a9;
            box-shadow: 0 8px 15px rgba(90, 153, 100, 0.3);
            color: #2a6a2a;
        }

        .quizzle-card i {
            font-size: 3rem;
            margin-bottom: 0.75rem;
            color: #5a9;
        }

        .quizzle-title {
            font-size: 1.2rem;
            font-weight: 600;
            text-align: center;
        }

        @media (max-width: 600px) {
            .quizzle-card {
                flex: 1 1 100%;
                max-width: 100%;
            }
        }

        .fa-dog {
            color: #ff6f61;
            font-size: 120px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, color 0.3s ease;
            cursor: pointer;
        }

        .fa-dog:hover {
            color: #ff3b1f;
            transform: scale(1.2) rotate(10deg);
        }

        .fa-house {
            color: #4a90e2;
            font-size: 100px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, color 0.3s ease;
            cursor: pointer;
        }

        .fa-house:hover {
            color: #2c5dab;
            transform: scale(1.1) translateY(-10px);
        }


        .fa-hippo {
            color: #9b59b6;

            font-size: 110px;
            text-shadow: 1.5px 1.5px 4px rgba(0, 0, 0, 0.25);
            transition: transform 0.3s ease, color 0.3s ease;
            cursor: pointer;
        }

        .fa-hippo:hover {
            color: #6c3483;
            transform: scale(1.15) rotate(-10deg);
        }


        .fa-cat {
            color: #f39c12;
            font-size: 105px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, color 0.3s ease;
            cursor: pointer;
        }

        .fa-cat:hover {
            color: #d35400;
            transform: scale(1.2) translateX(10px);
        }

        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .center-container p {
            display: inline-block;
            font-size: 24px;
            text-align: center;
        }

        .animated-text {
            font-size: 24px;
            text-align: center;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }

        .animated-text.visible {
            /* Animation styles */
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s ease-out forwards;
        }

        .dogs-showcase {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 2rem;
        }

        .dog-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 1rem;
            padding: 1rem;
            width: 250px;
            text-align: center;
            background-color: #fff;
        }

        .dog-card img {
            width: 100%;
            border-radius: 8px;
        }

        .viewmore {
            text-align: right;
            margin: 2rem;
            margin-top: 50px;
        }

        .btn {
            background-color: white;
            color: black;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-color: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:active {
            transform: scale(0.98);
            background-color: #3e8e41;
        }

        .users-section.hide {
            display: none;
        }

        footer {
            background: #adb2d4;
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: 2rem;
        }

        #page-slide-container {
            position: fixed;
            top: 0;
            right: -100%;
            width: 100%;
            height: 100%;
            background: white;
            z-index: 1000;
            transition: right 0.5s ease;
        }

        #page-slide-container.open {
            right: 0;
        }
    </style>
    <script>
        function loadPage(pageUrl) {
            fetch(pageUrl)
                .then((response) => response.text())
                .then((html) => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, "text/html");
                    const bodyContent = doc.body.innerHTML;
                    document.getElementById("slide-content").innerHTML = bodyContent;
                    document
                        .getElementById("page-slide-container")
                        .classList.add("open");
                })
                .catch((err) => console.error("Failed to load page:", err));
        }

        function closeSlide() {
            document
                .getElementById("page-slide-container")
                .classList.remove("open");
        }

        function showhideUsers() {
            const userSection = document.getElementById("userSection");
            const viewMoreButton = document.querySelector(".viewmore");

            userSection.classList.toggle("hide");

            if (!userSection.classList.contains("hide")) {
                // Move the button inside at the end
                userSection.appendChild(viewMoreButton);

                // Scroll into view
                userSection.scrollIntoView({
                    behavior: "smooth",
                    block: "center"
                });
            }
        }


        function showLoginModal() {
            document.getElementById('loginModal').style.display = 'flex';
            showTab('login'); // Default to login tab
        }

        function hideLoginModal() {
            document.getElementById('loginModal').style.display = 'none';
        }

        function showTab(tab) {
            const loginForm = document.getElementById('loginForm');
            const signupForm = document.getElementById('signupForm');
            const loginTab = document.getElementById('loginTab');
            const signupTab = document.getElementById('signupTab');

            if (tab === 'login') {
                loginForm.style.display = 'block';
                signupForm.style.display = 'none';
                loginTab.style.fontWeight = 'bold';
                signupTab.style.fontWeight = 'normal';
            } else {
                loginForm.style.display = 'none';
                signupForm.style.display = 'block';
                loginTab.style.fontWeight = 'normal';
                signupTab.style.fontWeight = 'bold';
            }
        }
    </script>
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
    <div id="loginModal"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.6); z-index:10000; justify-content:center; align-items:center;">
        <div
            style="background:white; padding:2rem; border-radius:8px; width:300px; text-align:center; position:relative;">

            <!-- Tabs -->
            <div>
                <button onclick="showTab('login')" id="loginTab"
                    style="margin-right: 10px;">Login</button>
                <button onclick="showTab('signup')" id="signupTab">Sign
                    Up</button>
            </div>



            <!-- Login Form -->
            <form action="login.php" method="post">
                <div id="loginForm">
                    <h2>Login</h2>
                    <input type="text" name="email" placeholder="Email"
                        style="width:100%; padding:0.5rem; margin-bottom:1rem;" required><br>

                    <input type="password" name="password" placeholder="Password"
                        style="width:100%; padding:0.5rem; margin-bottom:1rem;" required><br>

                    <button type="submit" style="padding:0.5rem 1rem;">Sign In</button>
                </div>
            </form>


            <!-- Sign Up Form -->
            <form action="signup.php" method="POST">
                <div id="signupForm" style="display:none;">
                    <h2>Sign Up</h2>
                    <input type="text" name="username" placeholder="Username"
                        style="width:100%; padding:0.5rem; margin-bottom:1rem;"><br>
                    <input type="email" name="email" placeholder="Email"
                        style="width:100%; padding:0.5rem; margin-bottom:1rem;"><br>
                    <input type="password" name="password" placeholder="Password"
                        style="width:100%; padding:0.5rem; margin-bottom:1rem;"><br>

                    <button style="padding:0.5rem 1rem;">Register</button>
            </form>
        </div>

        <!-- Close Button -->
        <button onclick="hideLoginModal()"
            style="background:red; color:white; padding:0.5rem; position:absolute; top:10px; right:10px;">X</button>
    </div>
    </div>




    <div id="page-slide-container">
        <button onclick="closeSlide()"
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
    <div class="quizzle-container">
        <ul class="quizzle-list">
            <li class="quizzle-card">
                <button onclick="alert('Dogs clicked')">

                    <i class="fa-solid fa-dog"></i>

                    <div class="quizzle-title">Dogs</div>
                </button>
            </li>
            <li class="quizzle-card">
                <button onclick="alert('Cats clicked')">
                    <i class="fa-solid fa-cat"></i>
                    <div class="quizzle-title">Cats</div>
                </button>
            </li>
            <li class="quizzle-card">
                <button onclick="alert('Other Animals clicked')">
                    <i class="fa-solid fa-hippo"></i>
                    <div class="quizzle-title">Other Animals</div>
                </button>
            </li>
            <li class="quizzle-card">
                <button onclick="alert('Shelters & Rescues clicked')">
                    <i class="fa-solid fa-house"></i>
                    <div class="quizzle-title">Shelters & Rescues</div>
                    </a>
            </li>
        </ul>
    </div>


    <h1 style="color: #adb2d4; text-align:center;">Happy Tails Dog Adoption</h1>
    <div class="center-container">

        <p>
            Adopting a dog is one of the most rewarding and compassionate
            choices
            you can make. Every year, millions of dogs end up in shelters or
            rescue
            organizations, many of them waiting for someone to give them a
            second
            chance at life. By choosing adoption over purchasing from breeders
            or
            pet stores, you not only provide a loving home to a dog in need, but
            you
            also help reduce the demand for puppy mills and overbreeding.
            <br /><br />
            Adopted dogs come in all shapes, sizes, and temperaments—from
            energetic
            puppies to calm senior dogs. Shelters often assess each dog’s
            personality and health, helping you find a pet that matches your
            lifestyle. Plus, adopted dogs are usually spayed or neutered,
            vaccinated, and sometimes even microchipped before going to their
            new
            homes.
            <br /><br />
            The bond between an adopted dog and their owner can be incredibly
            strong. Many adopters say their dogs seem to know they were rescued
            and
            return the favor with endless love and loyalty.
        </p>
    </div>

    <section id="dogs-showcase" class="dogs-showcase">
        <div class="dog-card">
            <img src="images/buddy.jfif" alt="Dog 1" />
            <h3>Buddy</h3>
            <p>2-year-old Golden Retriever</p>
        </div>
        <div class="dog-card">
            <img src="images/dd1.jfif " alt="Dog 2" />
            <h3>Luna</h3>
            <p>3-year-old German Shepherd</p>
        </div>
        <div class="dog-card">
            <img src="images/dd2.jfif" alt="Dog 3" />
            <h3>Luna</h3>
            <p>3-year-old German Shepherd</p>
        </div>
        <div class="dog-card">
            <img src="images/dd3.jfif" alt="Dog 4" />
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
                <img src="images/dd4.jfif" alt="Dog 1" />
                <h3>Buddy</h3>
                <p>2-year-old Golden Retriever</p>
            </div>
            <div class="dog-card">
                <img src="images/dd8.jfif" alt="Dog 2" />
                <h3>Luna</h3>
                <p>3-year-old German Shepherd</p>
            </div>
            <div class="dog-card">
                <img src="images/dd6.jfif" alt="Dog 3" />
                <h3>Luna</h3>
                <p>3-year-old German Shepherd</p>
            </div>
            <div class="dog-card">
                <img src="images/dd7.jfif" alt="Dog 4" />
                <h3>Luna</h3>
                <p>3-year-old German Shepherd</p>
            </div>
            <div class="dog-card">
                <img src="images/dd5.jfif" alt="Dog 2" />
                <h3>Luna</h3>
                <p>3-year-old German Shepherd</p>
            </div>
            <div class="dog-card">
                <img src="images/dd9.jfif" alt="Dog 3" />
                <h3>Luna</h3>
                <p>3-year-old German Shepherd</p>
            </div>
            <div class="dog-card">
                <img src="images/luna.jfif" alt="Dog 4" />
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