# Create schemas

# Create tables
CREATE TABLE IF NOT EXISTS user
(
    id INT NOT NULL UNIQUE AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    role SMALLINT DEFAULT 0 NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS role
(
    id TINYINT NOT NULL UNIQUE AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL UNIQUE,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS event
(
    id INT NOT NULL UNIQUE AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL UNIQUE,
    description VARCHAR(500) DEFAULT 'This event has no description.',
    type INT NOT NULL,
    creation DATE NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS type
(
    id TINYINT NOT NULL UNIQUE AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL UNIQUE,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS post
(
    id INT NOT NULL UNIQUE AUTO_INCREMENT,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    content BLOB NOT NULL,
    creation DATE NOT NULL,
    PRIMARY KEY(id)
);


# Create FKs
ALTER TABLE post
    ADD    FOREIGN KEY (user_id)
    REFERENCES user(id)
;
    
ALTER TABLE post
    ADD    FOREIGN KEY (event_id)
    REFERENCES event(id)
;
    
ALTER TABLE event
    ADD    FOREIGN KEY (type)
    REFERENCES type(id)
;
    
ALTER TABLE user
    ADD    FOREIGN KEY (role)
    REFERENCES role(id)
;
    

# Create Indexes

