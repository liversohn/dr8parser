CREATE DATABASE `parser` CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE USER 'parser'@'localhost' IDENTIFIED BY 'abc124D';
GRANT ALL ON parser.* TO 'parser'@'localhost';

USE `parser`;

-- DROP TABLE IF EXISTS simulcasting;
-- DROP TABLE IF EXISTS participants;
-- DROP TABLE IF EXISTS records;
-- DROP TABLE IF EXISTS reports;

CREATE TABLE reports (
    id BIGINT AUTO_INCREMENT NOT NULL,
    station VARCHAR(512) NOT NULL,
    dateFrom DATE NOT NULL,
    dateTo DATE NOT NULL,
    usageType ENUM('commercial', 'mix', 'broadcast', 'internet', 'jingle') NOT NULL,
    filename VARCHAR(1024) NOT NULL,
    sender VARCHAR(256),
    PRIMARY KEY (id)
)  ENGINE=INNODB CHARACTER SET=UTF8;

CREATE TABLE records (
    id BIGINT AUTO_INCREMENT NOT NULL,
    reportId BIGINT NOT NULL,
    title VARCHAR(512) NOT NULL,
    spins INT UNSIGNED NOT NULL,
    ISRC CHAR(12) NOT NULL,
    year INT UNSIGNED,
    producer VARCHAR(100),
    label VARCHAR(100),
    recordNo VARCHAR(100),
    serialNumber VARCHAR(100),
    isPremiere TINYINT(1) DEFAULT 0,
    `usage` ENUM('commercial', 'broadcast', 'jingle'),
    ISWC VARCHAR(100),
    AKA VARCHAR(100),
    genre ENUM('classical', 'spoken word', 'pop', 'composed', 'commercial', 'jingle'),
    broadcastedFrom DATETIME,
    broadcastedTo DATETIME,
    runtime INT UNSIGNED NOT NULL,
    origin ENUM('self', 'live broadcasting', 'live stream', 'recorded stream', 'free usage', 'report', 'free of charge', 'commerce', 'commercial'),
    alternativeTitle VARCHAR(100),
    recordedFootage INT UNSIGNED,
    PRIMARY KEY (id),
    FOREIGN KEY (reportId)
        REFERENCES reports (id)
)  ENGINE=INNODB CHARACTER SET=UTF8;

CREATE TABLE participants (
    id BIGINT AUTO_INCREMENT NOT NULL,
    recordId BIGINT NOT NULL,
    name VARCHAR(1024) NOT NULL,
    role ENUM('performer', 'arranger', 'composer', 'music director', 'producer', 'remixer', 'scriptwriter', 'sound engineer', 'subscriptwriter') NOT NULL,
    IPDN VARCHAR(100),
    performance ENUM('main', 'supporting', 'soloist', 'conductor', 'dirigent', 'master'),
    grossFee DECIMAL(10 , 2),
    modifier ENUM('A', 'B', 'C'),
    IPI VARCHAR(100),
    birthDate DATE,
    PRIMARY KEY (id),
    FOREIGN KEY (recordId)
        REFERENCES records (id)
)  ENGINE=INNODB CHARACTER SET=UTF8;

CREATE TABLE simulcasting (
    id BIGINT AUTO_INCREMENT NOT NULL,
    reportId BIGINT NOT NULL,
    `from` DATETIME NOT NULL,
    `to` DATETIME NOT NULL,
    station VARCHAR(512) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (reportId)
        REFERENCES reports (id)
)  ENGINE=INNODB CHARACTER SET=UTF8;