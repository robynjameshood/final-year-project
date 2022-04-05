
let linesups = document.getElementsByClassName("lineups");

let statistics = document.getElementsByClassName("statistics");

for (i = 0; i< linesups.length;i++ ) {
    let value = linesups[i].getAttribute('name');
   linesups[i].addEventListener("click", function () {
       openLineups(value);
   });
}

for (let i = 0; i< statistics.length;i++ ) {
    statistics[i].addEventListener("click", openStatistics);
}


function openLineups(test) {
    window.open("lineups.php?id="+test, "popup", "width=600px, height=600px");
}

function openStatistics() {
    window.open("statistics.php", "popup", "width=600px, height=600px");
}

