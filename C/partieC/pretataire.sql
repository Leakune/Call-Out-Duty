create table prestataire(
prestataire_id INT NOT NULL AUTO_INCREMENT,
lastname VARCHAR(100) NOT NULL,
firstname VARCHAR(40) NOT NULL,
birth_date DATE,
address VARCHAR(100),
cp INT,
city VARCHAR(40),
phonehome INT,
phonepro INT,
phonepers INT,
numid INT,
placeid INT,
dateid INT,
qrcode VARCHAR(100),
PRIMARY KEY ( prestataire_id )
);