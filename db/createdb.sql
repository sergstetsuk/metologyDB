CREATE TABLE cathedras(
    id INTEGER,
    name TEXT NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE devices(
    id INTEGER NOT NULL,
    cathedra_id INTEGER,
    name TEXT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (cathedra_id)
        REFERENCES cathedras(id)
        ON DELETE RESTRICT
);
--INSERT INTO cathedras (name) VALUES ("акушерства"),("хірургії");

