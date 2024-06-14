<?php

$options = [
    'uri' => 'http://localhost:81/',
    'location' => 'http://localhost:81/ajax/footballScoresService.php',
    'trace' => 1,
    'exceptions' => 1
];

$wsdl = 'http://127.0.0.1:81/ajax/footballScores.wsdl';

try {
    $client = new SoapClient($wsdl,$options);
    $result = $client->getMatchScores(['matchId' => 1]);
    echo 'Home Team Score: ' . $result->teamHomeScore . '<br>';
    echo 'Away Team Score: ' . $result->teamAwayScore . '<br>';
} catch (SoapFault $e) {
    echo 'Error: ' . $e->getMessage();
}

?>
