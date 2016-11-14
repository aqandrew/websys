insert into customers (fname,lname) values('Johnny','Jones');
insert into customers (fname,lname) values('Jane','Jones');
insert into customers (fname,lname) values('John','Doe');

INSERT INTO `products`(`name`, `price`) VALUES ('Candy',1.29);
INSERT INTO `products`(`name`, `price`) VALUES ('Pretzels',1.99);
INSERT INTO `products`(`name`, `price`) VALUES ('Soda',0.25);
INSERT INTO `products`(`name`, `price`) VALUES ('Toothpaste',4.56);


SELECT fname FROM `customers`;

SELECT * FROM `customers` WHERE id=2;

UPDATE customers SET fname='Jane',lname='Smith' WHERE id=2;

DELETE FROM `products` WHERE id=4;


CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `custid` int(11) NOT NULL,
  `prodid` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `quantity` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY ('custid') references customers('id'),
  FOREIGN KEY ('prodid') references products('id')
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



Show items in users 
SELECT `customers`.`lname`, `products`.`name`, `products`.`price`
FROM orders
LEFT JOIN customers ON orders.custid = customers.id
LEFT JOIN products ON orders.prodid = products.id
WHERE customers.id=1;


