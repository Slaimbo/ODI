-- source ./init.sql

USE projet;

insert into user values
	('toto', '1234', 'toto@toto.fr', 'M', 'Toto', 'OtOt', '1995-04-28');

insert into user values
	('tata', '1234', 'tata@toto.fr', 'M', 'Tata', 'Atat', '1995-04-29');


insert into client values
	('toto', 0);


insert into magasinier values
	('tata', 5, 1500);



insert into produit values
	(0, 'Patate', 42, 69, True);

insert into produit values
	(1, 'Secret', 50, 1, False);
