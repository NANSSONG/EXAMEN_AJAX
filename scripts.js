document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('scoreForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const matchId = document.getElementById('matchId').value;
        const teamHomeScore = document.getElementById('teamHomeScore').value;
        const teamAwayScore = document.getElementById('teamAwayScore').value;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'updateScores.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert('Scores updated successfully!');
            }
        };

        xhr.send(`matchId=${matchId}&teamHomeScore=${teamHomeScore}&teamAwayScore=${teamAwayScore}`);
    });

     // Fonction pour récupérer le score d'un match en direct
     function getLiveScore() {
        fetch('http://localhost:81/ajax/footballScoresService.php?wsdl')
            .then(response => response.json())
            .then(data => {
                document.getElementById('home-team-score').textContent = data.teamHomeScore;
                document.getElementById('away-team-score').textContent = data.teamAwayScore;
            })
            .catch(error => console.error('Error fetching live score:', error));
    }
    // Fonction pour récupérer tous les scores des matchs
    function getAllScores() {
        fetch('http://localhost:81/ajax/footballScoresService.php?wsdl')
            .then(response => response.json())
            .then(data => {
                const tbody = document.querySelector('#matches-table tbody');
                tbody.innerHTML = ''; // Clear existing rows

                data.forEach(match => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${match.id}</td>
                        <td>${match.homeTeam}</td>
                        <td>${match.awayTeam}</td>
                        <td>${match.teamHomeScore}</td>
                        <td>${match.teamAwayScore}</td>
                    `;
                    tbody.appendChild(tr);
                });
            })
            .catch(error => console.error('Error fetching all scores:', error));
    }

    // Appeler les fonctions pour mettre à jour les scores
    getLiveScore();
    getAllScores();

    // Mettre à jour les scores toutes les 30 secondes
    setInterval(getLiveScore, 30000);
    setInterval(getAllScores, 30000);

});


