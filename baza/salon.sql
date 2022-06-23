CREATE TABLE Konto (
  idKonto INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Login VARCHAR(30) NULL,
  Email VARCHAR(45) NULL,
  Haslo VARCHAR(100) NULL,
  Rola VARCHAR(1) NULL,
  PRIMARY KEY(idKonto)
);

CREATE TABLE Samochod (
  idSamochod INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Marka VARCHAR(30) NULL,
  Model VARCHAR(30) NULL,
  Rocznik YEAR NULL,
  Cena DECIMAL NULL,
  Przebieg INTEGER UNSIGNED NULL,
  Nowy VARCHAR(1) NULL,
  Zdjecie VARCHAR(50) NULL,
  PRIMARY KEY(idSamochod)
);

CREATE TABLE Forma_platnosci (
  idForma_platnosci INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Nazwa VARCHAR(30) NULL,
  PRIMARY KEY(idForma_platnosci)
);

CREATE TABLE Pracownik (
  idPracownik INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  idKonto INTEGER UNSIGNED NOT NULL,
  Imie VARCHAR(30) NULL,
  Nazwisko VARCHAR(30) NULL,
  Pesel INTEGER UNSIGNED NULL,
  Stanowisko VARCHAR(30) NULL,
  Data_zatrudnienia DATE NULL,
  Ulica VARCHAR(45) NULL,
  Numer VARCHAR(10) NULL,
  Kod VARCHAR(6) NULL,
  Miasto VARCHAR(45) NULL,
  Telefon INTEGER UNSIGNED NULL,
  Email VARCHAR(45) NULL,
  PRIMARY KEY(idPracownik),
  INDEX Pracownik_FKIndex1(idKonto),
  FOREIGN KEY(idKonto)
    REFERENCES Konto(idKonto)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Koszyk (
  idKoszyk INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  idSamochod INTEGER UNSIGNED NOT NULL,
  Data_dodania DATE NULL,
  Ilosc INTEGER UNSIGNED NULL,
  PRIMARY KEY(idKoszyk),
  INDEX Koszyk_FKIndex1(idSamochod),
  FOREIGN KEY(idSamochod)
    REFERENCES Samochod(idSamochod)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Klient (
  idKlient INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  idKonto INTEGER UNSIGNED NOT NULL,
  idKoszyk INTEGER UNSIGNED NOT NULL,
  Imie VARCHAR(30) NULL,
  Nazwisko VARCHAR(30) NULL,
  Ulica VARCHAR(45) NULL,
  Numer VARCHAR(10) NULL,
  Kod VARCHAR(6) NULL,
  Miasto VARCHAR(45) NULL,
  Telefon INTEGER UNSIGNED NULL,
  PRIMARY KEY(idKlient),
  INDEX Klient_FKIndex1(idKonto),
  INDEX Klient_FKIndex2(idKoszyk),
  FOREIGN KEY(idKonto)
    REFERENCES Konto(idKonto)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(idKoszyk)
    REFERENCES Koszyk(idKoszyk)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Sprzedaz (
  idSprzedaz INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  idPracownik INTEGER UNSIGNED NOT NULL,
  idForma_platnosci INTEGER UNSIGNED NOT NULL,
  idKlient INTEGER UNSIGNED NOT NULL,
  Data_sprzedazy DATE NULL,
  PRIMARY KEY(idSprzedaz),
  INDEX Sprzedaz_FKIndex1(idKlient),
  INDEX Sprzedaz_FKIndex2(idPracownik),
  INDEX Sprzedaz_FKIndex3(idForma_platnosci),
  FOREIGN KEY(idKlient)
    REFERENCES Klient(idKlient)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(idPracownik)
    REFERENCES Pracownik(idPracownik)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(idForma_platnosci)
    REFERENCES Forma_platnosci(idForma_platnosci)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Szczegoly_sprzedazy (
  idSprzedaz INTEGER UNSIGNED NOT NULL,
  idSamochod INTEGER UNSIGNED NOT NULL,
  Ilosc INTEGER UNSIGNED NULL,
  PRIMARY KEY(idSprzedaz, idSamochod),
  INDEX Sprzedaz_has_Samochod_FKIndex1(idSprzedaz),
  INDEX Sprzedaz_has_Samochod_FKIndex2(idSamochod),
  FOREIGN KEY(idSprzedaz)
    REFERENCES Sprzedaz(idSprzedaz)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(idSamochod)
    REFERENCES Samochod(idSamochod)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

