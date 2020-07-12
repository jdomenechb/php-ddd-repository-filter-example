USE demo;

CREATE TABLE students (
  `id` varchar(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `school_class` varchar(15) NOT NULL,
  `registered_in` datetime NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO demo.students
(id, name, school_class, registered_in)
VALUES('a1b2c3', 'Gumball Watterson', 'first', '2018-09-07 10:00:00.0');
INSERT INTO demo.students
(id, name, school_class, registered_in)
VALUES('d4e5f6', 'Finn The Human', 'third', '2018-08-01 10:00:00.0');
INSERT INTO demo.students
(id, name, school_class, registered_in)
VALUES('g7h8i9', 'Steven Universe', 'third', '2019-03-20 10:00:00.0');
INSERT INTO demo.students
(id, name, school_class, registered_in)
VALUES('j1k2l3', 'Phineas Flynn', 'second', '2019-04-18 10:00:00.0');
INSERT INTO demo.students
(id, name, school_class, registered_in)
VALUES('m4n5o6', 'Ferb Fletcher', 'third', '2019-05-20 10:00:00.0');
INSERT INTO demo.students
(id, name, school_class, registered_in)
VALUES('p7q8r9', 'Marinette Dupain-Cheng', 'third', '2020-01-20 10:00:00.0');
INSERT INTO demo.students
(id, name, school_class, registered_in)
VALUES('s1t2u3', 'Adrien Agreste', 'first', '2020-01-20 10:00:00.0');

