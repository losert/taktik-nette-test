CREATE TABLE survey (
                        id INT AUTO_INCREMENT NOT NULL,
                        name VARCHAR(255) NOT NULL,
                        comment TEXT NOT NULL,
                        conditions TINYINT(1) NOT NULL,
                        interests VARCHAR(255) DEFAULT NULL,
                        createdAt DATETIME NOT NULL,
                        PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

