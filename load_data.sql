use lib_db;
-- LOAD DATA LOCAL INFILE '/var/www/html/library_system_KtQiu/book.csv'  
-- INTO TABLE book
-- FIELDS TERMINATED BY ','   
-- OPTIONALLY ENCLOSED BY '"'   
-- LINES TERMINATED BY '\n'
-- (book_id, img, book_name, author,remain_num,book_type);
-- -- select * from book;



-- -- select book_name from book where remain_num = 0;
-- INSERT INTO reader (reader_id,passward,job,reader_name) VALUES ("123456","123456","S","Student_Test");
-- INSERT INTO reader (reader_id,passward,job,reader_name) VALUES ("100000","100000","T","Teacher_Test");
-- INSERT INTO manager (manager_id,passward,manager_name) VALUES ("000","000","admin_test");

-- select * from book where book_id = 111;
-- select passward from reader where reader_id = 123456;
-- select * from manager;
-- SELECT * FROM book WHERE (book_name LIKE "%11111111%") or (author LIKE "%Wood%") ;

-- select * from book where (book_name like "%123%") or (author like "%123%") or (book_type like "%123%") or (book_id like "%123%") or (author like "%123%") or (press like "%123%);


-- select * from book where (book_name like "%Wood%") or (author like "%Wood%") or (book_type like "%Wood%") or (book_id like "%Wood%") or (author like "%Wood%") or (press like "%Wood%")
-- INSERT INTO borrow_info()
-- insert into borrow_info values(null,123"12345""admin_test"date10)
-- drop table borrow_info;
-- insert into borrow_info values(null,123,"123456","000","18/05/14","18/06/13");
SELECT * FROM borrow_info;
