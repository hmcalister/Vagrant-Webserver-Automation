CREATE TABLE IF NOT EXISTS admin(
    id INT(7) NOT NULL AUTO_INCREMENT,
	username VARCHAR(50) NOT NULL,
    passwd varchar(255) NOT NULL,

    PRIMARY KEY (id)
);
