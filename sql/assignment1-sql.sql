CREATE TABLE pizzaOrder (
    id int not null auto_increment,
    pizza varchar(255) NOT NULL,
    fname varchar(255) NOT NULL,
    lname varchar(255) NOT NULL,
    phonenum varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    address varchar(255) NOT NULL,
    primary key (id)
);

INSERT INTO pizzaOrder(pizza, fname, lname, phonenum, email, address)
VALUES
    ('Cheese', 'Sehee', 'Hong', '333-333-3333', 'sehee@email.ca', '123 Ave Street');