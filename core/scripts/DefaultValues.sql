SET FOREIGN_KEY_CHECKS = 0;

INSERT INTO profession(profession_name) VALUES ("Etudiant"),("Agriculteur exploitant"),
("Artisan"),("Commerçant et assimilé"),("Chef d'entreprise de 10 salariés ou plus"),
("Profession libérale et assimilé"),("Cadre de la fonction publique, profession intellectuelle et artistique"),
("Cadre d'entreprise"),("Profession intermédiaire de l'enseignement, de la santé, de la fonction publique et assimilé"),
("Profession intermédiaire administrative et commerciale des entreprises"),("Technicien"),("Contremaître, agent de maîtrise"),
("Employé de la fonction publique"),("Employé administratif d'entreprise"),("Employé de commerce"),("Personnel des services directs aux particuliers"),
("Ouvrier qualifié"),("Ouvrier non qualifié"),("Ouvrier agricole"),("Ancien agriculteur exploitant"),("Ancien artisan, commerçant, chef d'entreprise"),
("Ancien cadre et profession intermédiaire"),("Ancien employé et ouvrier"),("Chômeur n'ayant jamais travaillé"),("Inactif divers (autres que retraité)");

                                                                         -- mdp : qfahrner
INSERT INTO user VALUES (1,"quentfahrner@hotmail.fr","Quentin","FAHRNER",UNHEX("562ca6ca385f0e09207334df75adc5bfb7faffcf"), CURRENT_TIMESTAMP, "http://www.renrhaf.fr", 1, NULL, 1);

SET FOREIGN_KEY_CHECKS = 1;