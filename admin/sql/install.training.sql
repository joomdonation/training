CREATE TABLE IF NOT EXISTS #__training_categories (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NULL,
  alias VARCHAR(255) NULL,
  description TEXT NULL,
  `access` TINYINT UNSIGNED NULL,
  ordering INT NOT NULL DEFAULT 0,
  published TINYINT UNSIGNED NULL,
  PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS #__training_items (
  id INT NOT NULL AUTO_INCREMENT,
  category_id INT NULL,
  title VARCHAR(255) NULL,
  alias VARCHAR(255) NULL,
  description TEXT NULL,
  `access` INT NULL,
  ordering INT NOT NULL DEFAULT 0,
  published INT NULL,
  PRIMARY KEY(id),
  INDEX jos_training_items_FKIndex1(category_id)
);

