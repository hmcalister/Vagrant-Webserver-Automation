CREATE TABLE IF NOT EXISTS admin(
	username VARCHAR(50) NOT NULL,
    passwd varchar(255) NOT NULL,

    PRIMARY KEY (username)
);

CREATE TABLE IF NOT EXISTS gamemode(
	gametype VARCHAR(50) NOT NULL,
    width int NOT NULL,
    height int NOT NULL,
    bomb_ratio float(8) NOT NULL,

    PRIMARY KEY (gametype)
);

CREATE TABLE IF NOT EXISTS scores(
	id INT(7) NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    time TIMESTAMP,

    PRIMARY KEY (id)
);