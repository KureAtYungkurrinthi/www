// Account Dropdown
document.getElementById("dropdown-button").addEventListener('click', function() {
    let content = document.getElementById('dropdown-content');
    if (content.style.display === 'none' || content.style.display === '') {
        content.style.display = 'block';
    } else {
        content.style.display = 'none';
    }
});

// Set sidebar menu as selected
function setMenuSelected() {
    const menu = document.querySelectorAll("#side-nav a");
    for (let opt of menu) {
        if (document.location.href.includes(opt.href)) {
            opt.classList.add("selected");
            break;
        }
    }
}

setMenuSelected();

// Populate Header navigation bar account name
document.getElementById('avatar').src = "images/avatar.png";
document.getElementById('dropdown-button').innerHTML = "Maggie Reynolds";

// Update footer year
document.getElementById('currentYear').innerHTML = new Date().getFullYear();