DROP TABLE devices;
DROP TABLE devicemodels;
DROP TABLE devicetypes;
DROP TABLE cathedras;
DROP TABLE statuses;

PRAGMA foreign_keys = ON;

CREATE TABLE statuses (
	id INTEGER PRIMARY KEY,
	name TEXT
	);

CREATE TABLE cathedras (
	id INTEGER PRIMARY KEY,
	name TEXT
	);

CREATE TABLE devicetypes (
	id INTEGER PRIMARY KEY,
	name TEXT,
	periodverify INTEGER
	);

CREATE TABLE devicemodels (
	id INTEGER PRIMARY KEY,
        typeid INTEGER DEFAULT 0,
	name TEXT,
	periodverify INTEGER,
        FOREIGN KEY(typeid) REFERENCES devicetypes(id) ON UPDATE CASCADE ON DELETE RESTRICT
	);

CREATE TABLE devices (
	id INTEGER PRIMARY KEY,
	cathedraid INTEGER DEFAULT 0,
	modelid INTEGER DEFAULT 0,
	serial TEXT,
	datemanufacture DATE,
	dateaccept DATE,
	lastverify DATE,
	statusid INTEGER DEFAULT 0,
	lastupdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY(modelid) REFERENCES devicemodels(id) ON UPDATE CASCADE ON DELETE RESTRICT,
        FOREIGN KEY(cathedraid) REFERENCES cathedras(id) ON UPDATE CASCADE ON DELETE RESTRICT,
        FOREIGN KEY(statusid) REFERENCES statuses(id) ON UPDATE CASCADE ON DELETE RESTRICT
	);
