CREATE TABLE users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username VARCHAR,
	fullName VARCHAR,
  email VARCHAR,
	birthDate VARCHAR,
	photoId VARCHAR,
	gender VARCHAR,
  password VARCHAR
);

CREATE TABLE lists (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	title VARCHAR,
  category_id INTEGER REFERENCES categories,
  color_id INTEGER REFERENCES colors,
	user_id INTEGER REFERENCES users
);

CREATE TABLE items (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  title VARCHAR,
  dataDue VARCHAR,
  color_id INTEGER REFERENCES colors,
  completed INTEGER
);

CREATE TABLE user_list (
  list_id INTEGER REFERENCES lists,
  user_id INTEGER REFERENCES users,
  isPublic VARCHAR
);

CREATE TABLE list_items (
  list_id INTEGER REFERENCES lists,
  item_id INTEGER REFERENCES items,
  user_id INTEGER REFERENCES users
);

CREATE TABLE categories (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name VARCHAR
);

CREATE TABLE colors (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name VARCHAR,
  mean VARCHAR
);

CREATE TABLE shares (
  id   INTEGER PRIMARY KEY AUTOINCREMENT,
  list_id INTEGER REFERENCES lists,
  from_user_id INTEGER REFERENCES users,
  to_user_id INTEGER REFERENCES users,
  accepted INTEGER
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

INSERT INTO colors VALUES (NULL,
                               'Red',
                               'High Urgency'
);

INSERT INTO colors VALUES (NULL,
                           'Yellow',
                           'Medium Urgency'
);

INSERT INTO colors VALUES (NULL,
                           'Green',
                           'Low Urgency'
);