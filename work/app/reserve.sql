DROP TABLE IF EXISTS reservation;
DROP TABLE IF EXISTS users;

CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT,
    register_token varchar(128),
    register_token_sent_at DATETIME,
    register_token_verified_at DATETIME,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_name varchar(32),
    first_name varchar(32),
    last_name_kana varchar(32),
    first_name_kana varchar(32),
    password varchar(128),
    email varchar(256),
    postcode varchar(8),
    prefectures varchar(16),
    city varchar(256),
    block varchar(256),
    building varchar(128),
    phone_number varchar(32),
    status ENUM("tentative", "public") NOT NULL DEFAULT "tentative",
    PRIMARY KEY (id)
);

CREATE TABLE reservation(
    id INT NOT NULL AUTO_INCREMENT,
    users_id INT,
    room_number varchar(16),
    regist_at DATETIME DEFAULT NOW(),
    reserve_at DATE,
    reserve_at_time TIME,
    price DECIMAL(10,3),
    pay varchar(32),
    cancel_at DATETIME DEFAULT NOW(),
    PRIMARY KEY (id),
    FOREIGN KEY (users_id) REFERENCES users(id)
);

INSERT INTO users (email) VALUES("beat0729pp1@gamil.com");
