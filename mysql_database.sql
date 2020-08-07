CREATE TABLE users(
	`id` int(11) AUTO_INCREMENT PRIMARY KEY NOT null,
  `name` text not null,
	`uname` tinytext not null,
  `email` tinytext not null,
  `pwd` longtext not null
);

CREATE TABLE pwdReset(
	`pwdResetId` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL ,
	`pwdResetEmail` TEXT NOT NULL,
	`pwdResetSelector` TEXT NOT NULL,
	`pwdResetToken` TEXT NOT NULL,
	`pwdExpiration` TEXT NOT NULL
);
