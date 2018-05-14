use lib_db;
LOAD DATA LOCAL INFILE '/var/www/html/library_system_KtQiu/book.csv'  
INTO TABLE book
FIELDS TERMINATED BY ','   
OPTIONALLY ENCLOSED BY '"'   
LINES TERMINATED BY '\n'
(book_id, img, book_name, author,remain_num,book_type);
-- select * from book;



-- select book_name from book where remain_num = 0;
INSERT INTO reader (reader_id,passward,job,reader_name) VALUES ("123456","123456","S","Student_Test");
INSERT INTO reader (reader_id,passward,job,reader_name) VALUES ("100000","100000","T","Teacher_Test");

select * from reader;
-- select passward from reader where reader_id = 123456;