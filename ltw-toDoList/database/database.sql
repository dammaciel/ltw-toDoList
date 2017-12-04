CREATE TABLE users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username VARCHAR,
	fullName VARCHAR,
	birthDate VARCHAR,
	photoId VARCHAR,
	gender VARCHAR,
  password VARCHAR
);

CREATE TABLE lists (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	title VARCHAR,
  category_id INTEGER REFERENCES categories,
	color VARCHAR,
	user_id INTEGER REFERENCES users
);

CREATE TABLE items (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  title VARCHAR,
  dataDue VARCHAR,
  color VARCHAR
);

CREATE TABLE list_items (
  list_id INTEGER REFERENCES lists,
  item_id INTEGER REFERENCES items
);

CREATE TABLE categories (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name VARCHAR
);

INSERT INTO categories VALUES (NULL,
                            'Home'
);

INSERT INTO categories VALUES (NULL,
                               'Work'
);

INSERT INTO categories VALUES (NULL,
                               'Games'
);

INSERT INTO categories VALUES (NULL,
                               'Shopping'
);

INSERT INTO categories VALUES (NULL,
                               'Family'
);
