CREATE DATABASE food;

CREATE TABLE restaurants(
	rest_id int(100) Auto_increment primary key,
	rest_ownername varchar(100),
	rest_name varchar(100),
	rest_address varchar(500),
	rest_email varchar(50),
	rest_open varchar(5),
	rest_close varchar(5),
	rest_rating float(2,1),
	rest_image varchar(255),
	rest_cuisine varchar(100)
);

CREATE TABLE users(
	user_id int(100) Auto_increment primary key,
	user_name varchar(50),
	user_email varchar(50),
	user_password varchar(100),
	user_haverest int(100) DEFAULT 0
);

CREATE table orders(
	user_name varchar(50),
	order_item varchar(100),
	cost int(100),
	rest_name varchar(100)
);
