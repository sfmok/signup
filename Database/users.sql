CREATE TABLE IF NOT EXISTS users ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(50) NOT NULL , 
    `email` VARCHAR(255) NOT NULL , 
    `password_hash` VARCHAR(255) NOT NULL ,
    `password_reset_hash` VARCHAR(64) NULL DEFAULT NULL ,
    `password_reset_expires_at` DATETIME NULL DEFAULT NULL ,   
    PRIMARY KEY (`id`), 
    UNIQUE (`email`, `password_reset_hash`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS remembered_logins ( 
    `token_hash` VARCHAR(64) NOT NULL , 
    `user_id` INT NOT NULL , 
    `expires_at` DATETIME NOT NULL , 
    PRIMARY KEY (`token_hash`), 
    INDEX (`user_id`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE remembered_logins ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE CASCADE ON UPDATE CASCADE;