
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `url` varchar(256) DEFAULT NULL,
  `session_id` varchar(256) DEFAULT NULL,
  `username` varchar(256) DEFAULT NULL,
  `remember_token` varchar(256) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `users` (`id`, `email`, `password`, `url`, `session_id`, `username`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'321432432trantunghn196@gmail.com','123456','tunglaso1',NULL,'tunglaso1',NULL,NULL,NULL),
	(2,'trantunghn196@gmail.com',NULL,'tunglaso2',NULL,NULL,NULL,'2016-08-07 17:28:37','2016-08-07 17:28:37');


DROP TABLE IF EXISTS `users1`;

CREATE TABLE `users1` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `url` varchar(256) DEFAULT NULL,
  `session_id` varchar(256) DEFAULT NULL,
  `username` varchar(256) DEFAULT NULL,
  `remember_token` varchar(256) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `users1` (`id`, `email`, `password`, `url`, `session_id`, `username`, `remember_token`, `created_at`, `updated_at`)
VALUES
  (1,'321432432trantunghn196@gmail.com','123456','tunglaso1',NULL,'tunglaso1',NULL,NULL,NULL),
  (2,'trantunghn196@gmail.com',NULL,'tunglaso2',NULL,NULL,NULL,'2016-08-07 17:28:37','2016-08-07 17:28:37')

