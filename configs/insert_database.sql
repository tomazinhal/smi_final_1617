#user role
INSERT INTO role (`id`, `name`) VALUES(0, "Guest");
INSERT INTO role (`id`, `name`) VALUES(1, "User");
INSERT INTO role (`id`, `name`) VALUES(2, "Supporter");
INSERT INTO role (`id`, `name`) VALUES(3, "Administrator");

#event type
INSERT INTO type (`id`, `name`) VALUES(0, "Party");
INSERT INTO type (`id`, `name`) VALUES(1, "Exhibition");
INSERT INTO type (`id`, `name`) VALUES(2, "Art");
INSERT INTO type (`id`, `name`) VALUES(3, "Festival");

#insert users
INSERT INTO user (`name`, `email`, `password`, `role`) VALUES("admin", "admin", "admin", 3)
INSERT INTO user (`name`, `email`, `password`, `role`) VALUES("supporter", "supporter", "supporter", 2)

