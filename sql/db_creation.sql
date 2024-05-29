CREATE TABLE users (
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    prenom varchar(32) NOT NULL,
    nom varchar(32) NOT NULL,
    classe varchar(64) NOT NULL,
    isadmin boolean DEFAULT FALSE
);
CREATE TABLE reponse (
    id int PRIMARY KEY auto_increment,
    question_id int,
    enonce_reponse varchar(128),
    FOREIGN KEY (question_id) references question(id)
);

CREATE TABLE question (
    id int NOT NULL PRIMARY KEY auto_increment,
    enonce varchar(255),
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