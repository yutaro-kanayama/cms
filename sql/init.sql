DROP DATABASE IF EXISTS cms;
CREATE DATABASE cms;
USE cms;

CREATE TABLE occupation (
	id INTEGER NOT NULL AUTO_INCREMENT,
	name VARCHAR(20) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE KEY name_index(name)	
) ENGINE = INNODB;

CREATE TABLE customer (
	id INTEGER NOT NULL AUTO_INCREMENT,
	name VARCHAR(20) NOT NULL,
	introduction VARCHAR(200),
	occupation_id INTEGER NOT NULL,
	birthday DATE NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	UNIQUE KEY name_index(name)	
) ENGINE = INNODB;

ALTER TABLE customer ADD FOREIGN KEY (occupation_id) REFERENCES occupation(id);

INSERT INTO `occupation` (`id`, `name`) VALUES (NULL, '公務員');
INSERT INTO `occupation` (`id`, `name`) VALUES (NULL, '会社員');
INSERT INTO `occupation` (`id`, `name`) VALUES (NULL, '自営業');
INSERT INTO `occupation` (`id`, `name`) VALUES (NULL, 'フリーター');
INSERT INTO `occupation` (`id`, `name`) VALUES (NULL, '学生');
INSERT INTO `occupation` (`id`, `name`) VALUES (NULL, '専業主婦');
INSERT INTO `occupation` (`id`, `name`) VALUES (NULL, 'その他');

INSERT INTO `customer` (`id`, `name`, `introduction`, `occupation_id`, `birthday`, `created_at`, `updated_at`) VALUES (NULL, 'ゆうたま', 'ゆうたまです。\r\nよろしくです。', '1', '2019-01-01', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `customer` (`id`, `name`, `introduction`, `occupation_id`, `birthday`, `created_at`, `updated_at`) VALUES (NULL, 'たなか', 'たなかです。\r\nよろしくです。', '2', '2019-01-02', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `customer` (`id`, `name`, `introduction`, `occupation_id`, `birthday`, `created_at`, `updated_at`) VALUES (NULL, 'すずき', 'すずきです。\r\nよろしくです。', '3', '2019-01-03', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `customer` (`id`, `name`, `introduction`, `occupation_id`, `birthday`, `created_at`, `updated_at`) VALUES (NULL, 'さとう', 'さとうです。\r\nよろしくです。', '4', '2019-01-04', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `customer` (`id`, `name`, `introduction`, `occupation_id`, `birthday`, `created_at`, `updated_at`) VALUES (NULL, 'わたなべ', 'わたなべです。\r\nよろしくです。', '5', '2019-01-05', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `customer` (`id`, `name`, `introduction`, `occupation_id`, `birthday`, `created_at`, `updated_at`) VALUES (NULL, 'ささき', 'ゆうたまです。\r\nよろしくです。', '6', '2019-01-01', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `customer` (`id`, `name`, `introduction`, `occupation_id`, `birthday`, `created_at`, `updated_at`) VALUES (NULL, 'おだ', 'たなかです。\r\nよろしくです。', '7', '2019-01-02', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `customer` (`id`, `name`, `introduction`, `occupation_id`, `birthday`, `created_at`, `updated_at`) VALUES (NULL, 'かとう', 'すずきです。\r\nよろしくです。', '1', '2019-01-03', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `customer` (`id`, `name`, `introduction`, `occupation_id`, `birthday`, `created_at`, `updated_at`) VALUES (NULL, 'えんどう', 'さとうです。\r\nよろしくです。', '2', '2019-01-04', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `customer` (`id`, `name`, `introduction`, `occupation_id`, `birthday`, `created_at`, `updated_at`) VALUES (NULL, 'てごし', 'わたなべです。\r\nよろしくです。', '3', '2019-01-05', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `customer` (`id`, `name`, `introduction`, `occupation_id`, `birthday`, `created_at`, `updated_at`) VALUES (NULL, 'きたがわ', 'わたなべです。\r\nよろしくです。', '4', '2019-01-05', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
