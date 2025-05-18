//  for side bar
 function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('show');
    }

    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('show');
        document.getElementById('overlay').classList.remove('show');
    }