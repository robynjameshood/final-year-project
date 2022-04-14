
let linesups = document.getElementsByClassName("lineups");

let statistics = document.getElementsByClassName("statistics");

for (i = 0; i< linesups.length;i++ ) {
    let fixtureID = linesups[i].getAttribute('name');
    let homeTeam = linesups[i].getAttribute("homeTeam");
    let awayTeam = linesups[i].getAttribute("awayTeam");
   linesups[i].addEventListener("click", function () {
       openLineups(fixtureID, homeTeam, awayTeam);
   });
}

for (let i = 0; i< statistics.length;i++ ) {
    statistics[i].addEventListener("click", openStatistics);
}


function openLineups(fixtureID, homeTeam, awayTeam) {
    window.open("lineups.php?id="+fixtureID+"&homeTeam="+homeTeam+"&awayTeam="+awayTeam, "popup", "width=600px, height=600px");
}

function openStatistics() {
    window.open("statistics.php", "popup", "width=600px, height=600px");
}

