function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');

    sidebar.classList.toggle('show');
    mainContent.classList.toggle('shrink');
}

function showForm(formType) {
    document.getElementById('loginForm').style.display = formType === 'login' ? 'block' : 'none';
    document.getElementById('signupForm').style.display = formType === 'signup' ? 'block' : 'none';
}

// Hide the forms on screen touch/click outside sidebar
document.addEventListener('click', function (event) {
    const sidebar = document.querySelector('.sidebar');
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');

    // If the click was outside the sidebar
    if (!sidebar.contains(event.target)) {
        loginForm.style.display = 'none';
        signupForm.style.display = 'none';
    }
});

function logout() {
    alert("Logging out...");
}

function loginUser() {
    alert("Logging in...");
}

function signupUser() {
    alert("Signing up...");
}
