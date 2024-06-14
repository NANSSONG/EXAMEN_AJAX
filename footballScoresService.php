<?php

class FootballScoresService {

    private $pdo;

    public function __construct() {
        $dsn = 'mysql:host=localhost;dbname=examenajax;charset=utf8';
        $username = 'root';
        $password = '';
        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getMatchScores($matchId) {
        $stmt = $this->pdo->prepare('SELECT team_home_score, team_away_score FROM scores WHERE match_id = :matchId');
        $stmt->execute(['matchId' => $matchId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return [
                'teamHomeScore' => $result['team_home_score'],
                'teamAwayScore' => $result['team_away_score']
            ];
        } else {
            throw new SoapFault('Server', 'Match not found');
        }
    }
}

$options = [
    'uri' => 'http://localhost:81/',
    'location' => 'http://localhost:81/ajax/footballScoresService.php'
];

$server = new SoapServer('footballScores.wsdl', $options);
$server->setClass('FootballScoresService');
$server->handle();

?>
