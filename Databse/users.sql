CREATE TABLE IF NOT EXISTS users ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(50) NOT NULL , 
    `email` VARCHAR(255) NOT NULL , 
    `password_hash` VARCHAR(255) NOT NULL , 
    PRIMARY KEY (`id`), 
    UNIQUE (`email`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;