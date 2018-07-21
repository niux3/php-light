PRAGMA foreign_keys = ON;

-- -----------------------------------------------------
-- Table 'confbox'.'roles'
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS pages (
  'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  'name' VARCHAR(255) NOT NULL,
  'slug' VARCHAR(255) NOT NULL,
  'content' text NOT NULL,
  'created' DATETIME NOT NULL DEFAULT (datetime('now','localtime')),
  'updated' DATETIME NOT NULL DEFAULT (datetime('now','localtime'))
);
