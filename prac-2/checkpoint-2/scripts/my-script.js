function init()
{
    const player = document.getElementById("player-name");
    player.innerText = getUrlParam("name"); 
}

init();
