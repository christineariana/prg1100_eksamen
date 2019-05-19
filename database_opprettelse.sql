CREATE TABLE hotell (
    hotellnavn VARCHAR(50) NOT NULL,
    sted VARCHAR(50) NOT NULL,
    PRIMARY KEY (hotellnavn)
);

CREATE TABLE romtype (
	romtype VARCHAR(50) NOT NULL,
    PRIMARY KEY (romtype (50))
);

CREATE TABLE hotellromtype (
	hotellnavn VARCHAR(50) NOT NULL,
    romtype VARCHAR(50) NOT NULL,
    antallrom SMALLINT NOT NULL,
    PRIMARY KEY (hotellnavn,romtype (50)),
    FOREIGN KEY (hotellnavn) REFERENCES hotell(hotellnavn),
    FOREIGN KEY (romtype) REFERENCES romtype(romtype)
    );
    
CREATE TABLE rom (
	hotellnavn VARCHAR(50) NOT NULL,
    romtype VARCHAR(50) NOT NULL,
    romnr SMALLINT NOT NULL,
    PRIMARY KEY (hotellnavn,romnr),
    FOREIGN KEY (hotellnavn,romtype (50)) REFERENCES hotellromtype(hotellnavn, romtype)
);

	