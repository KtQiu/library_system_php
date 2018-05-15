drop database lib_db;
create database lib_db;
use lib_db;

create table reader(
    reader_id varchar(10) not null,
    passward varchar (20) not null DEFAULT "123456",
    -- 默认 初始化 reader是student，最多借20本书,已经借了0本
    job varchar(1) DEFAULT "S",
    max_number int(2) DEFAULT 20, 
    borrow_number int(2) DEFAULT 0,

    reader_name varchar(20),
    email varchar(40) ,

    PRIMARY KEY(reader_id)
    );

create table manager(
    manager_id varchar(10) not null,
    email varchar(40),
    passward varchar (20),
    manager_name varchar(20),

    PRIMARY KEY(manager_id)
    );

create table book(
    book_id int(6) NOT NULL AUTO_INCREMENT,
    img varchar(100), -- 书的封面图片的网址
    book_name varchar(200),
    author varchar(50),
    remain_num int(3), -- 剩余的书的数量
    book_type varchar(50),
    press varchar(100),
    amount int(5),

    PRIMARY KEY (book_id)
);


create table borrow_info(
    borrow_id int(10) NOT NULL AUTO_INCREMENT,
    book_id int(10) NOT NULL ,
    reader_id varchar(10) NOT NULL ,
    manager_id varchar(10) NOT NULL,
    borrow_time date NOT NULL, -- 借出的时间
    should_back_time date , -- 应该归还的时间

    PRIMARY KEY(borrow_id),
    FOREIGN KEY(book_id) REFERENCES book(book_id),
    FOREIGN KEY(reader_id) REFERENCES reader(reader_id),
    FOREIGN KEY(manager_id) REFERENCES manager(manager_id)
);

create table return_info(
    return_id int(10) NOT NULL AUTO_INCREMENT,
    borrow_id int(10) NOT NULL,
    book_id int(10) NOT NULL,
    reader_id varchar(10) NOT NULL,
    manager_id varchar(10) NOT NULL,
    back_time date , -- 归还的时间
    is_late tinyint(1) DEFAULT 0, -- 默认没有迟归还书本

    PRIMARY KEY(return_id),
    FOREIGN KEY(borrow_id) REFERENCES borrow_info(borrow_id),
    FOREIGN KEY(book_id) REFERENCES book(book_id),
    FOREIGN KEY(reader_id) REFERENCES reader(reader_id),
    FOREIGN KEY(manager_id) REFERENCES manager(manager_id)
);


-- create view Login_usr
-- as
-- select r.id,r.password,r.name,ut.usrtype
-- from Readerinfo r,Usertype ut
-- where r.typeid=ut.id
-- union
-- select m.id,m.password,m.name,ut.usrtype
-- from Managerinfo m,Usertype ut
-- where m.typeid=ut.id
