document.getElementById("search").focus();

let text = document.getElementById("search");

let player_watch = document.getElementById("player-watch");

player_watch.addEventListener("click", openPlayerWatch);

text.addEventListener("keypress", function (press) {
    if (press.key === "Enter") {
        document.getElementById("submit").click();
    }
})

document.getElementById("search").addEventListener("keypress", function (press) {
    if (press.key === "Enter") {
        getTeam();
    }
});

function getTeam() {
    let team = document.querySelector('input').value;
    window.location.href = "stat-search.php?team=" + team;
}

function openPlayerWatch() {
    window.open("player-watch.php", "popup", "width=900px, height=900px");
}