DROP TABLE IF EXISTS Ratings;
DROP TABLE IF EXISTS BookRequest;
DROP TABLE IF EXISTS BookCheckout;
DROP TABLE IF EXISTS MeetingRoomStatus;
DROP TABLE IF EXISTS StudyRoomStatus;
DROP TABLE IF EXISTS Book;
DROP TABLE IF EXISTS BookAddition;
DROP TABLE IF EXISTS Librarian;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS AllTimes;
DROP VIEW IF EXISTS BookRatings;

CREATE TABLE Librarian (
   librarian_id INT UNSIGNED,
   librarian_name VARCHAR (30),
   PRIMARY KEY(librarian_id)
);

CREATE TABLE BookAddition(
    book_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    librarian_id INT UNSIGNED,
    add_date DATE,
    PRIMARY KEY(book_id),
    FOREIGN KEY(librarian_id) REFERENCES Librarian(librarian_id)
);

CREATE TABLE Book (
   book_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
   book_title VARCHAR(30),
   author VARCHAR (30),
   genre VARCHAR (30),
   publisher VARCHAR (30),
   year_published YEAR,
   PRIMARY KEY(book_id),
   FOREIGN KEY(book_id) REFERENCES BookAddition(book_id),
   INDEX title_index(book_title)
);
 
CREATE TABLE AllTimes(
   start_time TIME,
   end_time TIME,
   PRIMARY KEY(start_time)
);

CREATE TABLE Users(
   us_id INT UNSIGNED,
   u_name VARCHAR (30),
   PRIMARY KEY(us_id)
);
 
CREATE TABLE StudyRoomStatus (
   us_id INT UNSIGNED,
   reserve_time TIME,
   PRIMARY KEY(us_id, reserve_time),
   FOREIGN KEY(us_id) REFERENCES Users(us_id)
);
 
CREATE TABLE MeetingRoomStatus (
   us_id INT UNSIGNED,
   reserve_time TIME,
   PRIMARY KEY(us_id, reserve_time),
   FOREIGN KEY(us_id) REFERENCES Users(us_id)
); 
 
CREATE TABLE BookCheckout (
   book_id INT UNSIGNED,
   us_id INT UNSIGNED,
   checkout_date DATE,
   PRIMARY KEY (book_id),
   FOREIGN KEY(book_id) REFERENCES Book(book_id),
   FOREIGN KEY(us_id) REFERENCES Users(us_id)
);


CREATE TABLE Ratings(
    us_id INT UNSIGNED,
    book_title VARCHAR(30),
    book_author VARCHAR(30),
    rating INT UNSIGNED,
    PRIMARY KEY(us_id, book_title, book_author),
    FOREIGN KEY(us_id) REFERENCES Users(us_id),

    CONSTRAINT check_rating
      CHECK(rating >= 1 AND rating <= 5)
);


CREATE TABLE BookRequest(
    request_id INT UNSIGNED AUTO_INCREMENT,
    title VARCHAR(30),
    author VARCHAR(30),
    us_id INT UNSIGNED,
    request_date DATE,
    PRIMARY KEY(request_id, title, author, us_id),
    FOREIGN KEY(us_id) REFERENCES Users(us_id)
);

CREATE VIEW BookRatings AS
SELECT book_title, book_author, AVG(rating) as rating
FROM Ratings
GROUP BY book_title, book_author;


INSERT INTO Users VALUES 
(68142651, 'Aidan'),
(68142652, 'Dan'),
(68142653, 'JR'),
(68142654, 'Buddy'),
(68142655, 'Carson'),
(68142656, 'Logan'),
(68142657, 'Finn'),
(68142658, 'Ryan'),
(68142659, 'Pete'),
(68142660, 'Peter'),
(68142661, 'Josh'),
(68142662, 'Emily'),
(68142663, 'Sandra'),
(68142664, 'Tony'),
(68142665, 'Isaac'),
(68142666, 'Barbara');

INSERT INTO Librarian VALUES
(1, 'Karen'), (2, 'JR'), (3, 'Aidan');

INSERT INTO BookAddition VALUES
(book_id, 1, '2020-05-17'), (book_id,1, '2010-02-22'), (book_id, 2, '2019-04-13'), (book_id, 3, '2019-06-23'), (book_id, 3, '2019-06-22'), (book_id, 3, '2019-06-22'), (book_id,1,'2019-06-23'),
(book_id, 1, '2000-05-17'), (book_id,1, '2011-02-22'), (book_id, 2, '2018-04-13'), (book_id, 3, '2019-06-23'), (book_id, 3, '2019-06-22'), (book_id, 3, '2019-06-22'), (book_id,1,'2019-06-23'),
(book_id, 1, '2010-05-17'), (book_id,1, '2013-02-22'), (book_id, 2, '2017-04-13'), (book_id, 3, '2019-06-23'), (book_id, 3, '2019-06-22'), (book_id, 3, '2019-06-22'), (book_id,1,'2019-06-23'),
(book_id, 1, '2012-05-17'), (book_id,1, '2014-02-22'), (book_id, 2, '2016-04-13'), (book_id, 3, '2019-06-23'), (book_id, 3, '2019-06-22'), (book_id, 3, '2019-06-22'), (book_id,1,'2019-06-23'),
(book_id, 1, '2020-12-14'), (book_id,1, '2020-12-14'), (book_id, 2, '2020-10-16');

INSERT INTO Book VALUES
(book_id, 'The Bluest Eye', 'Toni Morrison', 'African American Literature', 'Penguin Group', 1990), 
(book_id, 'The Heart of Darkness', 'Joseph Conrad', 'Novella', 'Blackwoods Magazine', 1970), 
(book_id, 'Love Yourself', 'JR Palmer', 'Self-Help', 'Penguin Group', 2020), 
(book_id, 'SQL for Beginners', 'Aidan Lewis', 'Textbook', 'Pearson', 1990),
(book_id, 'The Bluest Eye', 'Toni Morrison', 'African American Literature', 'Penguin Group', 1990),
(book_id, 'The Bluest Eye', 'Toni Morrison', 'African American Literature', 'Penguin Group', 1990),
(book_id, 'The Greenest Eye', 'Bologna Morrison', 'African American Literature', 'Pearson', 1999), 
(book_id, 'The Bluest Eye', 'Toni Morrison', 'African American Literature', 'Penguin Group', 1990), 
(book_id, 'The Heart of Darkness', 'Joseph Conrad', 'Novella', 'Blackwoods Magazine', 1970), 
(book_id, 'Love Yourself', 'JR Palmer', 'Self-Help', 'Penguin Group', 2020), 
(book_id, 'SQL for Beginners', 'Aidan Lewis', 'Textbook', 'Pearson', 1990),
(book_id, 'The Bluest Eye', 'Toni Morrison', 'African American Literature', 'Penguin Group', 1990),
(book_id, 'The Bluest Eye', 'Toni Morrison', 'African American Literature', 'Penguin Group', 1990),
(book_id, 'The Greenest Eye', 'Bologna Morrison', 'African American Literature', 'Pearson', 1999),
(book_id, 'The Bluest Eye', 'Toni Morrison', 'African American Literature', 'Penguin Group', 1990), 
(book_id, 'The Heart of Darkness', 'Joseph Conrad', 'Novella', 'Blackwoods Magazine', 1970), 
(book_id, 'Love Yourself', 'JR Palmer', 'Self-Help', 'Penguin Group', 2020), 
(book_id, 'SQL for Beginners', 'Aidan Lewis', 'Textbook', 'Pearson', 1990),
(book_id, 'The Bluest Eye', 'Toni Morrison', 'African American Literature', 'Penguin Group', 1990),
(book_id, 'The Bluest Eye', 'Toni Morrison', 'African American Literature', 'Penguin Group', 1990),
(book_id, 'The Greenest Eye', 'Bologna Morrison', 'African American Literature', 'Pearson', 1999),
(book_id, 'The Bluest Eye', 'Toni Morrison', 'African American Literature', 'Penguin Group', 1990), 
(book_id, 'The Heart of Darkness', 'Joseph Conrad', 'Novella', 'Blackwoods Magazine', 1970), 
(book_id, 'Love Yourself', 'JR Palmer', 'Self-Help', 'Penguin Group', 2020), 
(book_id, 'SQL for Beginners', 'Aidan Lewis', 'Textbook', 'Pearson', 1990),
(book_id, 'The Bluest Eye', 'Toni Morrison', 'African American Literature', 'Penguin Group', 1990),
(book_id, 'The Bluest Eye', 'Toni Morrison', 'African American Literature', 'Penguin Group', 1990),
(book_id, 'The Greenest Eye', 'Bologna Morrison', 'African American Literature', 'Pearson', 1999),
(book_id, 'Ubuntu', 'Patrick Baraza', 'African Culture', 'Penguin', 2005), 
(book_id, 'Bahasa Indonesia', 'Billy Bob Joe', 'Language', 'Penguin', 1990),
(book_id, 'Visions of the Universe', 'James Wiseman', 'Fiction', 'Penguin', 2019);


INSERT INTO AllTimes VALUES
('9:00', '10:00'), ('10:00', '11:00'), ('11:00', '12:00'), ('12:00', '13:00'), ('13:00', '14:00'), ('14:00', '15:00'), ('15:00', '16:00'), ('16:00', '17:00');
 

 INSERT INTO Ratings VALUES
 (68142655, 'The Bluest Eye', 'Toni Morrison', 4), (68142656, 'The Bluest Eye', 'Toni Morrison', 5), (68142657, 'The Bluest Eye', 'Toni Morrison', 3), (68142658, 'The Bluest Eye', 'Toni Morrison', 2);