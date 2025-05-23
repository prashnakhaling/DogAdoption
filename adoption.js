function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('show');
}

function showForm(formType) {
    document.getElementById('loginForm').style.display = formType === 'login' ? 'block' : 'none';
    document.getElementById('signupForm').style.display = formType === 'signup' ? 'block' : 'none';
}

function logout() {
    alert("Logging out...");
}

function loginUser() {
    alert("Logging in...");
}

function signupUser() {
    alert("Signing up...");
}
