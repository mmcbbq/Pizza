drop database IF EXISTS pizza;
create database pizza;
use pizza;

CREATE TABLE topping
(
    id    int auto_increment PRIMARY KEY,
    name  varchar(255),
    preis DECIMAL(4, 2)
);



Create TABLE Kunde
(
    id       int auto_increment PRIMARY KEY,
    vorname  varchar(255),
    nachname varchar(255),
    plz      varchar(255),
    ort      varchar(255),
    strasse  varchar(255),
    email    varchar(255)

);

CREATE TABLE getraenk
(
    id    int auto_increment PRIMARY KEY,
    name  varchar(255),
    preis DECIMAL(4, 2)
);

CREATE TABLE pizza
(
    id      int auto_increment PRIMARY KEY,
    groesse bool

);

CREATE Table pizza_topping
(
    id        int auto_increment PRIMARY KEY,
    pizzaid   int,
    toppingid int,
    FOREIGN KEY (pizzaid) REFERENCES pizza (id) ON DELETE CASCADE,
    FOREIGN KEY (toppingid) REFERENCES topping (id) ON DELETE CASCADE
);

CREATE TABLE lieferung
(
    bestellnummer int auto_increment PRIMARY KEY,
    kundenid     int,
    FOREIGN KEY (kundenid) REFERENCES Kunde (id) ON DELETE CASCADE
);


CREATE TABLE pizza_lieferung
(
    id int auto_increment PRIMARY KEY ,
    bestellnummer int,
    pizzaid      int,
    FOREIGN KEY (pizzaid) REFERENCES pizza (id) ON DELETE CASCADE,
    FOREIGN KEY (bestellnummer) REFERENCES lieferung (bestellnummer) ON DELETE CASCADE
);

CREATE TABLE getraenke_lieferung
(
    id           int auto_increment PRIMARY KEY,
    bestellnummer int,
    getraenkeid  int,
    FOREIGN KEY (bestellnummer) REFERENCES lieferung (bestellnummer) ON DELETE CASCADE,
    FOREIGN KEY (getraenkeid) REFERENCES getraenk (id) ON DELETE CASCADE
);
