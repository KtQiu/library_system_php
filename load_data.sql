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
-- INSERT INTO manager (manager_id,passward,manager_name) VALUES ("000","000","admin000");

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
-- SELECT * FROM borrow_info;
-- SELECT * FROM reader;
-- SELECT job FROM reader where job = "T";
-- UPDATE reader set borrow_number=borrow_number+1 where reader_id = 100000;
-- select * from reader;


-- DELETE FROM borrow_info where reader_id =100000;
-- update book set remain_num=remain_num-1 where book_id=2;
-- SELECT * from book where book_id=2;

-- DELETE FROM borrow_info where borrow_id=7;

-- SELECT * from borrow_info;
-- SELECT DATEDIFF("2008-12-30","2008-12-29") AS DiffDate;
-- SELECT DATEDIFF("2018-06-14","2018-05-15") AS DiffDate;
-- SELECT DATEDIFF("2018-06-14","2018-05-15") AS DiffDate;
-- insert into book values ( "111111","", "2", "4", 3, "", "5", 6);
-- delete from book where book_id=1123123;
-- select * from book where book_id=;
-- SELECT * FROM book;
-- INSERT INTO reader VALUES ("233","233","T",100,0,"233","233@zju.edu.cn");
-- DELETE FROM reader where reader_id =100000;
-- SELECT * from reader;
SELECT * from borrow_info;
-- SELECT DATEDIFF("2018-06-14","2018-05-15") AS DiffDate;