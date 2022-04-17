
let linesups = document.getElementsByClassName("lineups");

let statistics = document.getElementsByClassName("statistics");


for (let i = 0; i< linesups.length;i++ ) {
    let fixtureID = linesups[i].getAttribute('name');
    let homeTeam = linesups[i].getAttribute("homeTeam");
    let awayTeam = linesups[i].getAttribute("awayTeam");
   linesups[i].addEventListener("click", function () {
       openLineups(fixtureID, homeTeam, awayTeam);
   });
}

for (let x = 0; x< statistics.length;x++ ) {
    let id = statistics[x].getAttribute("name");
    let home = statistics[x].getAttribute("home");
    let away = statistics[x].getAttribute("away");
    statistics[x].addEventListener("click", function () {
       openStatistics(id, home, away);
    });
}


function openLineups(fixtureID, homeTeam, awayTeam) {
    window.open("lineups.php?id="+fixtureID+"&homeTeam="+homeTeam+"&awayTeam="+awayTeam, "popup", "width=600px, height=600px");
}

function openStatistics(fixtureID, homeTeam, awayTeam) {
    window.open("statistics.php?id="+fixtureID+"&homeTeam="+homeTeam+"&awayTeam="+awayTeam, "popup", "width=600px, height=600px");
}

