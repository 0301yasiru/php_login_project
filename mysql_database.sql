CREATE TABLE users(
	`id` int(11) AUTO_INCREMENT PRIMARY KEY NOT null,
  `name` text not null,
	`uname` tinytext not null,
  `email` tinytext not null,
  `pwd` longtext not null
);
