CREATE TABLE admin(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
name varchar(40),
pass varchar(40) 
);



CREATE TABLE users (
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
name varchar(40),
pass varchar(40),
email varchar(50)
);


create table board (
b_no int unsigned not null primary key auto_increment,
b_id varchar(20) not null,
b_password varchar(100) not null,
b_title varchar(100) not null,
b_content text not null,
b_date datetime not null,
b_hit int unsigned not null default 0,
b_fname varchar(100), 
b_fdata MEDIUMBLOB
);


create table comment(
co_no int unsigned not null primary key auto_increment,
b_no int unsigned not null,
co_order int unsigned default 0,
co_content text not null,
co_id varchar(20) not null,
co_password varchar(100) not null
);
