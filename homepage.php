<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dog Adoption</title>
    <!-- JavaScript -->
    <script src="adoption.js"></script>
    <link rel="stylesheet" href="adoptionstyle.css">
</head>

<body>
    <div class="container" id="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <button class="close-btn" onclick="toggleSidebar()">✖</button><br><br>
            <button onclick="showForm('login')">Login</button>
            <button onclick="showForm('signup')">Sign Up</button>
            <button onclick="logout()">Log Out</button>
        </div>
        <div class="wrapper" id="wrapper">
            <!-- Main Content -->
            <div class="main-content">
                <header>
                    <div class="navbar">
                        <h1><img src="images\dogadoption-logo.png" alt="littlepaws" class="dogadoptionlogo"></h1>
                        <nav class="nav-elements">
                           <a href="">About</a>
                           <a href="">Dog Adoption</a>
                           <a href="">Contact Us</a>
                        </nav>
                        <!-- <form action="/search" method="GET">
                                <input type="text" name="q" placeholder="Search..." />
                                <button type="submit">Search</button>
                            </form> -->
                        <button class="menu-btn" onclick="toggleSidebar()">☰ Menu</button>

                    </div>

                    <div class="hero">
                        <h2>Find Your New Best Friend</h2>
                        <p>Thousands of loving dogs are waiting for a forever home. Start your journey today.</p>
                        <button onclick="alert('View Available Dogs')">View Dogs</button>
                    </div>

                    <!-- Login Form -->
                    <div id="loginForm" class="form-container">
                        <form action="/submit_login" method="POST">

                            <h2>Log In</h2>

                            <label for="login-name">Name:</label><br>
                            <input type="text" id="loginUsername" placeholder="Username" required><br><br>

                            <label for="login-password">Password:</label><br>
                            <input type="password" id="loginpassword" placeholder="Password" required><br><br>

                            <button onclick="loginUser()">Login</button>
                            <h5>Create new Account</h5>

                        </form>
                    </div>

                    <!-- Sign Up Form -->
                    <div id="signupForm" class="form-container">
                        <h2>Sign Up</h2>
                        <form action="signup.php" method="POST">
                            <label for="name">Full Name:</label><br>
                            <input type="text" id="signupUsername" placeholder="Username" required><br><br>

                            <label for="phone">Phone Number:</label><br>
                            <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required><br><br>

                            <label for="email">Email Address:</label><br>
                            <input type="email" id="signupEmail" placeholder="Email" required><br><br>

                            <label for="password">Password:</label><br>
                            <input type="password" id="signupPassword" placeholder="Password" required><br><br>
                        </form>

                        <button onclick="signupUser()">Sign Up</button>
                        <h5>Create new Account</h5>

                        </form>

                    </div>

                </header>

            </div>


        </div>
    </div>
</body>

</html>