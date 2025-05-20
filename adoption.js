function showForm(type) {
      document.getElementById('loginForm').classList.remove('active');
      document.getElementById('signupForm').classList.remove('active');

      if (type === 'login') {
        document.getElementById('loginForm').classList.add('active');
      } else {
        document.getElementById('signupForm').classList.add('active');
      }
    }

    function logout() {
      alert('Logged out');
      document.getElementById('loginForm').classList.remove('active');
      document.getElementById('signupForm').classList.remove('active');
    }

    function loginUser() {
      const username = document.getElementById("loginUsername").value;
      alert("Logging in as: " + username);
    }

    function signupUser() {
      const username = document.getElementById("signupUsername").value;
      alert("Signing up as: " + username);
    }

    function showForm(type) {
      hideForms();
      if (type === 'login') {
        document.getElementById('loginForm').classList.add('active');
      } else if (type === 'signup') {
        document.getElementById('signupForm').classList.add('active');
      }
    }

    function hideForms() {
      document.getElementById('loginForm').classList.remove('active');
      document.getElementById('signupForm').classList.remove('active');
    }

    function logout() {
      alert("Logged out");
      hideForms();
    }

    // Add click event to hide forms if clicked outside
    document.addEventListener('click', function(event) {
      const loginForm = document.getElementById('loginForm');
      const signupForm = document.getElementById('signupForm');
      const sidebar = document.querySelector('.sidebar');

      const clickedInsideLogin = loginForm.contains(event.target);
      const clickedInsideSignup = signupForm.contains(event.target);
      const clickedSidebar = sidebar.contains(event.target);

      // If clicked outside all forms and sidebar, hide them
      if (!clickedInsideLogin && !clickedInsideSignup && !clickedSidebar) {
        hideForms();
      }
    });