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
