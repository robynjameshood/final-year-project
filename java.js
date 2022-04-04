
let linesups = document.getElementsByClassName("lineups");

let statistics = document.getElementsByClassName("statistics");

for (i = 0; i< linesups.length;i++ ) {
    linesups[i].addEventListener("click", openLineups);
}

for (let i = 0; i< statistics.length;i++ ) {
    statistics[i].addEventListener("click", openStatistics);
}


function openLineups() {
    window.open("lineups.php", "popup", "width=600px, height=600px");
}

function openStatistics() {
    window.open("statistics.php", "popup", "width=600px, height=600px");
}

