var sidebar = document.querySelector('.sidebar');
var sidebarBtn = document.getElementsByClassName('sidebar-button');
var body = document.querySelector('body');

body.addEventListener('click', function(e) {
    if (e.target.className == 'dashboard' && sidebar.className == 'sidebar') {
        sidebar.className = 'sidebar active';
        document.querySelector('.home-section').style.left = '240px';
    } else {
        sidebar.className = 'sidebar';
    }

    if (e.target.className == 'bx bx-menu sidebarBtn' && sidebar.className == 'sidebar') {
        sidebar.className = 'sidebar active';
        document.querySelector('.home-section').style.left = '240px';
        document.querySelector('.sidebar > .nav-links').style.marginTop = '120px';
        document.querySelector('.sidebar .logo-details .logo_name').style.marginTop = '200px';
    } else {
        sidebar.className = 'sidebar';
        document.querySelector('.home-section').style.left = '60px';
    }
    // hom section left
    // sidebar active
})