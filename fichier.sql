CREATE TABLE teams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL
);

CREATE TABLE matches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team_home_id INT,
    team_away_id INT,
    match_date DATETIME,
    FOREIGN KEY (team_home_id) REFERENCES teams(id),
    FOREIGN KEY (team_away_id) REFERENCES teams(id)
);

CREATE TABLE scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    match_id INT,
    team_home_score INT,
    team_away_score INT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (match_id) REFERENCES matches(id)
);


INSERT INTO teams (name, city) VALUES ('Damissa FC', ' Ndali'), ('Pahou FC', 'Pahou');
INSERT INTO matches (team_home_id, team_away_id, match_date) VALUES (1, 2, '2024-06-10 15:00:00');
INSERT INTO scores (match_id, team_home_score, team_away_score) VALUES (1, 2, 1);


INSERT INTO teams (name, city) VALUES ('FC BORGOU', 'Borgou'), ('Ajijas', 'Cotonou');
INSERT INTO matches (team_home_id, team_away_id, match_date) VALUES (1, 2, '2024-06-10 15:00:00');
INSERT INTO scores (match_id, team_home_score, team_away_score) VALUES (1, 2, 1);


INSERT INTO teams (name, city) VALUES ('Béké FC', 'Bembèrèkè'), ('Buffles FC', 'Parakou');
INSERT INTO matches (team_home_id, team_away_id, match_date) VALUES (1, 2, '2024-06-10 15:00:00');
INSERT INTO scores (match_id, team_home_score, team_away_score) VALUES (1, 2, 1);
