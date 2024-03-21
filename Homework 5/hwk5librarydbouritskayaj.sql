  USE librarydbouritskayaj;
  
  -- 1.
  SELECT isbn, title, page_count, publisher_name 
  FROM book;
  
  -- 2.
  SELECT COUNT(*) AS books_on_loan 
  FROM book 
  WHERE available = 0;
  
  -- 3.
  SELECT COUNT(DISTINCT current_holder) AS num_members 
  FROM book 
  WHERE current_holder IS NOT NULL;
  
  -- 4. 
  DROP TABLE books_on_loan;
  CREATE TABLE IF NOT EXISTS books_on_loan AS
  SELECT * 
  FROM book 
  WHERE available = 0;
  
  -- 5. 
  SELECT b.isbn, b.title, b.description, b.page_count, b.publisher_name, a.name 
  FROM book AS b
  JOIN book_author AS ba
  ON b.isbn = ba.isbn
  JOIN author AS a
  ON ba.author = a.name;
  
  -- 6. 
  SELECT bg.isbn, b.title, GROUP_CONCAT(bg.genre) AS genres
  FROM book AS b
  LEFT JOIN book_genre AS bg
  ON b.isbn = bg.isbn
  GROUP BY bg.isbn, b.title;
  
  -- 7. 
  SELECT title
  FROM book 
  WHERE page_count = (
	SELECT MAX(page_count) 
    FROM book
);

-- 8. 
SELECT l.username AS librarian_username, COUNT(rc.name) AS num_clubs
FROM librarian AS l
LEFT OUTER JOIN reading_club AS rc
ON l.username = rc.librarian
GROUP BY librarian_username;

-- 9. 
SELECT * 
FROM book 
WHERE page_count < 300 
ORDER BY page_count DESC;

-- 10. 
SELECT g.name AS genre_name, COUNT(bg.isbn) AS num_books 
FROM genre AS G
LEFT OUTER JOIN book_genre AS bg
ON g.name = bg.genre
GROUP BY genre_name
ORDER BY num_books DESC;

-- 11. 
SELECT b.isbn, b.title, p.name AS publisher, p.books_published, 
	   a.name AS author, a.books_written, l.first_name, l.last_name
FROM book AS b
JOIN publisher AS p
ON b.publisher_name = p.name
JOIN book_author AS ba
ON b.isbn = ba.isbn
JOIN author AS a
ON ba.author = a.name
JOIN reading_club AS rc
ON rc.current_book_isbn = b.isbn
JOIN librarian as l
ON rc.librarian = l.username;

-- 12. 
SELECT rcm.member_username 
FROM reading_club_members AS rcm
GROUP BY rcm.member_username
HAVING COUNT(DISTINCT rcm.club_name) = (
	SELECT COUNT(*) FROM reading_club
);

-- 13. 
SELECT m.first_name, m.last_name 
FROM member AS m
JOIN reading_club_members AS rcm
ON m.username = rcm.member_username
GROUP BY rcm.member_username
HAVING COUNT(DISTINCT rcm.club_name) = (
	SELECT COUNT(*) FROM reading_club
);

-- 14. 
SELECT * 
FROM book 
WHERE publication_date < '2000-01-01';

-- 15. 
SELECT DISTINCT rcm1.member_username AS member1, rcm2.member_username AS member2, rc.name AS book_club
FROM reading_club_members AS rcm1
JOIN reading_club_members AS rcm2
ON rcm1.club_name = rcm2.club_name
JOIN reading_club AS rc
ON rcm1.club_name = rc.name
WHERE rcm1.member_username < rcm2.member_username
ORDER BY rc.name ASC;

-- 16.
SELECT name, books_written AS num_books 
FROM author 
ORDER BY num_books DESC;

-- 17.
SELECT MAX(books_written) AS max_books_written 
FROM author;

-- 18.
SELECT name, books_written 
FROM author 
WHERE books_written = (
	SELECT MAX(books_written) 
    FROM author
);

