===>
1. Create a Mysql Table customer_address with these fields
● id (int, auto incremented)
● customer_id (int)
● address_name (string)
● type (string: 'billing' or 'shipping')
● main (boolean 0 or 1, if is a main address or not)

FINAL QUERY : create TABLE customer_address( id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, customer_id INT(20), address_name VARCHAR(50), type VARCHAR(10), main INT(1) )

===> 
2. generate/store couple of INSERT statements to add some entries in this table
Please note that for a customer
● A. we can have 0, 1 or more ‘shipping’ addresses
● B. we can have 0, 1 or more ‘billing’ addresses
● C. 0 or 1 ‘main’ shipping address
● D. 0 or 1 ‘main’ billing address

FINAL QUERY : 

INSERT INTO customer_address (customer_id, address_name, type, main) VALUES ('1000', 'bucharest', 'billing', 0),  ('1001', 'sao paolo', 'billing', 0)

INSERT INTO customer_address (customer_id, address_name, type, main) VALUES ('1000', 'madris', 'shipping', 0),  ('1001', 'rome', 'shipping', 1),  ('1001', 'rosadsme', 'billing', 0),  ('1001', 'rsdsdosme', 'billing', 0),  ('1002', 'rsadome', 'shipping', 0),  ('1001', 'romsadsde', 'billing', 0),  ('1003', 'safsfrome', 'shipping', 0),  ('1001', 'rosddxme', 'billing', 0)

==>
3. write a mysql statement(s) that needs to change/update existing rows (no delete, no insert),.....

Solution :
To check where customer has any main shipping address
SELECT count(1)  as cnt FROM `customer_address` WHERE customer_id = '1000' AND type = 'shipping' AND main = 1

SELECT count(1)  as cnt FROM `customer_address` WHERE customer_id = '1001' AND type = 'shipping' AND main = 1 

if cnt = 0

SELECT id FROM customer_address WHERE customer_id = '1001' AND type = 'billing' AND main = 0 ORDER BY id DESC LIMIT 1
UPDATE customer_address SET main = 1 WHERE id = 10


SELECT id FROM customer_address WHERE customer_id = '1001' AND type = 'shipping' AND main = 0 ORDER BY id DESC LIMIT 1
UPDATE customer_address SET main = 1 WHERE id = 10

//UPDATE customer_address SET main = 1 WHERE id = (SELECT id FROM customer_address WHERE customer_id = '1001' AND type = 'billing' AND main = 0 ORDER BY id DESC LIMIT 1)

FINAL QUERY : 

SELECT id FROM customer_address WHERE customer_id = '{customer_id}' AND type = '{type}' AND main = {main} ORDER BY id DESC LIMIT 1
UPDATE customer_address SET main = {main} WHERE id = {id}





