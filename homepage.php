<!DOCTYPE html>
<title>Dog Adoption</title>
<link rel="stylesheet" href="adoptionstyle.css">
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('show');
    }

    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('show');
        document.getElementById('overlay').classList.remove('show');
    }
</script>
<div class="dogadotion-main">
    <header>
        <nav class="header-nav">
            <a href="">
                <img src="images/logo-42.png" alt="littlepaws" class="header-logo"></img>
            </a>
            <a href="#dogs">Dogs for Adoption</a>
            <a href="#about">About Us</a>
        </nav>

        <div class="sidebar-toggle" onclick="toggleSidebar()">☰</div>

    </header>
    <aside class="sidebar" id="sidebar">
        <div class="close-btn" onclick="closeSidebar()">✖</div>
        <button ><a href ="login.php"></a>Login</button>
        <button><a href ="signup.php"></a>Sign Up</button>
        <button>Logout</button>
        


    </aside>
</div>


</html>