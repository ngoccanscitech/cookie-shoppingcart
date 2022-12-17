1. Tạo product detail - truyền id từ products qua product detail
2. Ajax send qua
3. Check cookie get card - so sánh cart và id, nếu có thêm số lượng mới vào

theory: $.ajax, $.get, $.post $ là jQuery
php: exit, để truyền data qua lại giữa php và front end thì dạng json


response = JSON.parse(data). A common use of JSON is to exchange data to/from a web server.
When receiving data from a web server, the data is always a string.
Parse the data with JSON.parse(), and the data becomes a JavaScript object.

create table products (
    id int primary key auto_increment,
    title varchar(250),
    thumbnail varchar(500),
    content longtext,
    price float,
    created_at datetime,
    updated_at datetime
);

create table orders (
    id int primary key auto_increment,
    fullname varchar(100),
    email varchar(150),
    phone_number varchar(20),
    address varchar(200),
    order_date datetime
);

create table order_details (
    id int primary key auto_increment,
    order_id int references orders (id),
    product_id int references products (id),
    num int,
    price float
)