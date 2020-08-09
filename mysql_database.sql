CREATE TABLE users(
	`id` int(11) AUTO_INCREMENT PRIMARY KEY NOT null,
  `name` text not null,
	`uname` tinytext not null,
  `email` tinytext not null,
  `pwd` longtext not null,
	`marks` int not null
);

CREATE TABLE pwdReset(
	`pwdResetId` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL ,
	`pwdResetEmail` TEXT NOT NULL,
	`pwdResetSelector` TEXT NOT NULL,
	`pwdResetToken` TEXT NOT NULL,
	`pwdExpiration` TEXT NOT NULL
);

CREATE TABLE q_a_users(
	`Id` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL ,
	`user_name` TEXT NOT NULL,
	`question` TEXT NOT NULL,
	`answer` TEXT NOT NULL,
	`done` int not null
);
