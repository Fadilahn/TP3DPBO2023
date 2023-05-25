-- Membuat database
CREATE DATABASE db_combo_food;

-- Menggunakan database
USE db_combo_food;

-- Membuat tabel food
CREATE TABLE food (
    food_id INT PRIMARY KEY AUTO_INCREMENT,
    food_name VARCHAR(255) NOT NULL
);

-- Membuat tabel sauce
CREATE TABLE sauce (
    sauce_id INT PRIMARY KEY AUTO_INCREMENT,
    sauce_name VARCHAR(255) NOT NULL
);

-- Membuat tabel menu
CREATE TABLE menu (
    menu_id INT PRIMARY KEY AUTO_INCREMENT,
    menu_image VARCHAR(255),
    menu_name VARCHAR(255) NOT NULL,
    menu_price INT(15) NOT NULL,
    menu_desc TEXT,
    food_id INT,
    sauce_id INT,
    FOREIGN KEY (food_id) REFERENCES food(food_id),
    FOREIGN KEY (sauce_id) REFERENCES sauce(sauce_id)
);

-- Memasukkan data makanan
INSERT INTO food (food_name) VALUES
    ('Nasi Goreng'),
    ('Pizza'),
    ('Burger'),
    ('Sushi'),
    ('Spaghetti'),
    ('Tacos'),
    ('Chicken Rice'),
    ('Steak'),
    ('Dim Sum'),
    ('Curry');

-- Memasukkan data saus
INSERT INTO sauce (sauce_name) VALUES
    ('Sambal'),
    ('Mayonnaise'),
    ('Barbecue Sauce'),
    ('Teriyaki Sauce'),
    ('Tomato Sauce'),
    ('Guacamole'),
    ('Chili Sauce'),
    ('Soy Sauce'),
    ('Tartar Sauce'),
    ('Sweet and Sour Sauce');

-- Memasukkan data menu combo food dengan kombinasi random
INSERT INTO menu (menu_image, menu_name, menu_price, menu_desc, food_id, sauce_id)
SELECT
    image.image_name,
    CONCAT(food.food_name, ' with ', sauce.sauce_name),
    FLOOR(RAND() * 20) + 5,
    CONCAT('Delicious combo of ', food.food_name, ' with ', sauce.sauce_name),
    food.food_id,
    sauce.sauce_id
FROM
    (SELECT
        '8-bajftGxnN35HqVV.png' AS image_name UNION ALL
    SELECT '8-BeJTIrbYxhlvc9Q.png' UNION ALL
    SELECT '8-bIMo90ecMSvEAas.png' UNION ALL
    SELECT '8-eDUakKtZiZQX0Ho.png' UNION ALL
    SELECT '8-fbBTFhVJth9SrQ8.png' UNION ALL
    SELECT '8-ft93EHGnIsRf94b.png' UNION ALL
    SELECT '8-HkWkuHrrS5TzlVP.png' UNION ALL
    SELECT '8-jeP0iRbdBfLlqPx.png' UNION ALL
    SELECT '8-oK7YBAyHLu1jLsP.png' UNION ALL
    SELECT '8-PevcjN20hNuPpVJ.png') AS image
    CROSS JOIN food
    CROSS JOIN sauce
ORDER BY RAND()
LIMIT 10;


-- Memasukkan data menu combo food
INSERT INTO menu (menu_image, menu_name, menu_price, menu_desc, food_id, sauce_id) VALUES
    ('menu1.jpg', 'Nasi Goreng with Sambal', 10, 'Delicious fried rice with spicy sambal sauce', 1, 1),
    ('menu2.jpg', 'Pizza with Barbecue Sauce', 12, 'Classic pizza topped with tangy barbecue sauce', 2, 3),
    ('menu3.jpg', 'Burger with Mayonnaise', 8, 'Juicy burger dressed with creamy mayonnaise', 3, 2),
    ('menu4.jpg', 'Sushi with Teriyaki Sauce', 15, 'Fresh sushi rolls drizzled with savory teriyaki sauce', 4, 4),
    ('menu5.jpg', 'Spaghetti with Tomato Sauce', 10, 'Pasta dish served with rich tomato sauce', 5, 5),
    ('menu6.jpg', 'Tacos with Guacamole', 9, 'Tasty tacos topped with flavorful guacamole', 6, 6),
    ('menu7.jpg', 'Chicken Rice with Chili Sauce', 11, 'Savory chicken rice accompanied by spicy chili sauce', 7, 7),
    ('menu8.jpg', 'Steak with Soy Sauce', 20, 'Grilled steak seasoned with savory soy sauce', 8, 8),
    ('menu9.jpg', 'Dim Sum with Tartar Sauce', 13, 'Assortment of delicious dim sum served with tangy tartar sauce', 9, 9),
    ('menu10.jpg', 'Curry with Sweet and Sour Sauce', 14, 'Flavorful curry dish enhanced with sweet and sour sauce', 10, 10);

-- Memasukkan data menu combo food dengan kombinasi random
INSERT INTO menu (menu_image, menu_name, menu_price, menu_desc, food_id, sauce_id)
SELECT 
    'menu11.jpg',
    CONCAT(f.food_name, ' with ', s.sauce_name),
    FLOOR(RAND() * 20) + 5,
    CONCAT('Delicious combo of ', f.food_name, ' with ', s.sauce_name),
    f.food_id,
    s.sauce_id
FROM
    food f
    CROSS JOIN sauce s
ORDER BY RAND()
LIMIT 10;

