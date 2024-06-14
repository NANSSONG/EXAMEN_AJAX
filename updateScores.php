<?php

$dsn = 'mysql:host=localhost;dbname=examenajax;charset=utf8';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $matchId = $_POST['matchId'];
    $teamHomeScore = $_POST['teamHomeScore'];
    $teamAwayScore = $_POST['teamAwayScore'];

    $stmt = $pdo->prepare('UPDATE scores SET team_home_score = :teamHomeScore, team_away_score = :teamAwayScore WHERE match_id = :matchId');
    $stmt->execute([
        'teamHomeScore' => $teamHomeScore,
        'teamAwayScore' => $teamAwayScore,
        'matchId' => $matchId
    ]);

    echo 'Scores updated successfully';
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

?>
