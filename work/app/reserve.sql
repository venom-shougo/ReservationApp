DROP TABLE IF EXISTS reservation;
DROP TABLE IF EXISTS users;

CREATE TABLE shop (
    id INT NOT NULL AUTO_INCREMENT,
    shop_name varchar(128) NOT NULL,
    shop_id varchar(16) NOT NULL,
    email varchar(256) NOT NULL,
    password INT NOT NULL,
    reservable_date INT NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    max_reserve_num INT NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE reservation (
    id INT NOT NULL AUTO_INCREMENT,
    reserve_date DATE NOT NULL,
    reserve_time TIME NOT NULL,
    reserve_num INT NOT NULL,
    name varchar(100) NOT NULL,
    email varchar(254) NOT NULL,
    tel varchar(20) NOT NULL,
    comment mediumtext,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

INSERT INTO users (email) VALUES("beat0729pp1@gamil.com");
