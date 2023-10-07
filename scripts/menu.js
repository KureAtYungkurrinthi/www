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
document.getElementById('username').innerHTML = "Maggie Reynolds";

// Update footer year
document.getElementById('currentYear').innerHTML = new Date().getFullYear();