CREATE TABLE users (
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    prenom varchar(32) NOT NULL,
    nom varchar(32) NOT NULL,
    classe varchar(64) NOT NULL,
    isadmin boolean DEFAULT FALSE
);

CREATE TABLE admin (
    id int NOT NULL PRIMARY KEY,
    prenom varchar(32),
    nom varchar(32),
    FOREIGN KEY (id) REFERENCES users(id)
);

CREATE TABLE reponse (
    id int PRIMARY KEY auto_increment,
    enonce_reponse varchar(128)
);

CREATE TABLE question (
    id int NOT NULL PRIMARY KEY auto_increment,
    enonce varchar(128),
    reponse_id int,
    partie_id int,
    FOREIGN KEY (reponse_id) references reponse(id)
);

CREATE TABLE resultat (
    user_id int,
    question_id int,
    temps int,
    PRIMARY KEY (user_id, question_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (question_id) REFERENCES question(id)
);

CREATE TABLE score (
    id int PRIMARY KEY auto_increment,
    temps int NOT NULL,
    points int NOT NULL
);

CREATE TABLE score_user (
    user_id int,
    score_id int,
    points int,
    PRIMARY KEY (user_id, score_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (score_id) REFERENCES score(id)
);

CREATE TABLE bonne_reponse (
    question_id int,
    reponse_id int,
    PRIMARY KEY (question_id, reponse_id),
    FOREIGN KEY (question_id) REFERENCES question(id),
    FOREIGN KEY (reponse_id) REFERENCES reponse(id)
);