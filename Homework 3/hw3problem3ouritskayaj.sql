DROP DATABASE IF EXISTS stellargrocerystore;
CREATE DATABASE IF NOT EXISTS stellargrocerystore;
USE stellargrocerystore;

CREATE TABLE chain (
chain_id INT PRIMARY KEY,
street_num INT,
street_name VARCHAR(64),
zip CHAR(5),
state VARCHAR(2),
open_time TIME,
closing_time TIME
);

CREATE TABLE productGenre (
type ENUM('bakery', 'non-perishable', 'produce', 'meat', 'dairy') PRIMARY KEY
);

CREATE TABLE product (
name VARCHAR(64) PRIMARY KEY,
type ENUM('bakery', 'non-perishable', 'produce', 'meat', 'dairy') NOT NULL,
FOREIGN KEY (type) REFERENCES productGenre(type)
	ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE staff (
staff_no INT PRIMARY KEY,
first_name VARCHAR(64) NOT NULL,
last_name VARCHAR(64) NOT NULL,
manager_status BOOL DEFAULT FALSE,
chain_id INT NOT NULL,
FOREIGN KEY (chain_id) REFERENCES chain(chain_id)
	ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE chainProduct (
chain_id INT NOT NULL,
name VARCHAR(64) NOT NULL,
num_items INT,
PRIMARY KEY (chain_id, name),
FOREIGN KEY (chain_id) REFERENCES chain(chain_id)
	ON UPDATE CASCADE ON DELETE RESTRICT,
FOREIGN KEY (name) REFERENCES product(name)
	ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE identification (
type ENUM('credit card', 'driving license', 'passport') PRIMARY KEY
);

CREATE TABLE customer (
customer_id INT PRIMARY KEY,
first_name VARCHAR(64) NOT NULL,
last_name VARCHAR(64) NOT NULL,
street_num INT,
street_name VARCHAR(64),
zip CHAR(5),
state VARCHAR(2)
);

CREATE TABLE creditCard (
number CHAR(16) PRIMARY KEY,
type ENUM('VISA', 'AMEX', 'Mastercard'),
exp_date DATE, 
customer_id INT NOT NULL
);

CREATE TABLE customerCreditCard (
number CHAR(16) NOT NULL,
customer_id INT NOT NULL,
PRIMARY KEY (number, customer_id),
FOREIGN KEY (number) REFERENCES creditCard(number)
	ON UPDATE CASCADE ON DELETE RESTRICT,
FOREIGN KEY (customer_id) REFERENCES customer(customer_id)
	ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE orders (
order_id INT PRIMARY KEY,
chain_id INT NOT NULL,
name VARCHAR(64) NOT NULL,
type ENUM('credit card', 'driving license', 'passport') NOT NULL,
customer_id INT NOT NULL,
FOREIGN KEY (chain_id) REFERENCES chain(chain_id)
	ON UPDATE CASCADE ON DELETE RESTRICT,
FOREIGN KEY (name) REFERENCES product(name)
	ON UPDATE CASCADE ON DELETE RESTRICT,
FOREIGN KEY (type) REFERENCES identification(type)
	ON UPDATE CASCADE ON DELETE RESTRICT,
FOREIGN KEY (customer_id) REFERENCES customer(customer_id)
	ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE orderProduct (
order_id INT NOT NULL,
name VARCHAR(64) NOT NULL,
quantity INT,
PRIMARY KEY (order_id, name),
FOREIGN KEY (order_id) REFERENCES orders(order_id)
	ON UPDATE CASCADE ON DELETE RESTRICT,
FOREIGN KEY (name) REFERENCES product(name)
	ON UPDATE CASCADE ON DELETE RESTRICT
);
