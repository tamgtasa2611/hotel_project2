CREATE DATABASE project2;
USE project2;

CREATE TABLE admins (
	id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
	last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    level INT NOT NULL,
    image TEXT,
    deleted_at TIMESTAMP NULL
);

CREATE TABLE activities (
	id INT AUTO_INCREMENT PRIMARY KEY,
	date DATETIME NOT NULL,
    detail TEXT NOT NULL,
    admin_id INT,
    deleted_at TIMESTAMP NULL,
	FOREIGN KEY (admin_id) REFERENCES admins(id)
);

CREATE TABLE guests (
	id INT AUTO_INCREMENT PRIMARY KEY,
	first_name VARCHAR(255) NOT NULL,
	last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    status INT NOT NULL,
    image TEXT,
    deleted_at TIMESTAMP NULL
);

CREATE TABLE room_types (
	id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    max_capacity INT,
    price DECIMAL(10,2) NOT NULL,
    deleted_at TIMESTAMP NULL
);

CREATE TABLE room_type_images (
	id INT AUTO_INCREMENT PRIMARY KEY,
	path TEXT NOT NULL,
    room_type_id INT,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (room_type_id) REFERENCES room_types(id)
);

CREATE TABLE rooms (
	id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    status INT NOT NULL,
    room_type_id INT,
    deleted_at timestamp NULL,
    FOREIGN KEY (room_type_id) REFERENCES room_types(id)
);

CREATE TABLE ratings (
	id INT AUTO_INCREMENT PRIMARY KEY,
    rating INT NOT NULL,
    review TEXT,
    rate_date DATE NOT NULL,
    guest_id INT,
    room_type_id INT,
	deleted_at TIMESTAMP NULL,
	FOREIGN KEY (guest_id) REFERENCES guests(id),
    FOREIGN KEY (room_type_id) REFERENCES room_types(id)
);

CREATE TABLE amenities (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	deleted_at TIMESTAMP NULL
);

CREATE TABLE room_type_amenities (
	room_type_id INT,
    amenity_id INT,
    PRIMARY KEY (room_type_id, amenity_id),
    FOREIGN KEY (room_type_id) REFERENCES room_types(id),
    FOREIGN KEY (amenity_id) REFERENCES amenities(id)
);

CREATE TABLE bookings (
	id INT AUTO_INCREMENT PRIMARY KEY,
    date DATETIME NOT NULL,
	status INT NOT NULL,
    checkin DATE NOT NULL,
    checkout DATE NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    note TEXT,
    guest_lname VARCHAR(100),
	guest_fname VARCHAR(100),
    guest_email VARCHAR(255),
    guest_phone VARCHAR(20),
    guest_id INT,
    admin_id INT,
    FOREIGN KEY (guest_id) REFERENCES guests(id),
    FOREIGN KEY (admin_id) REFERENCES admins(id)
);

CREATE TABLE booked_room_types (
	booking_id INT,
    room_type_id INT,
    number_of_room INT NOT NULL,
    PRIMARY KEY (booking_id, room_type_id),
    FOREIGN KEY (booking_id) REFERENCES bookings(id),
	FOREIGN KEY (room_type_id) REFERENCES room_types(id)
);

CREATE TABLE booked_rooms (
    room_id INT,
    booking_id INT,
	PRIMARY KEY (booking_id, room_id),
	FOREIGN KEY (booking_id) REFERENCES bookings(id),
	FOREIGN KEY (room_id) REFERENCES rooms(id)
);

-- CREATE TABLE services (
-- 	id INT AUTO_INCREMENT PRIMARY KEY,
-- 	name VARCHAR(255) NOT NULL,
-- 	price DECIMAL(10,2) NOT NULL,
--     description TEXT,
-- 	deleted_at TIMESTAMP NULL
-- );

-- CREATE TABLE booked_services (
-- 	booking_id INT,
--     service_id INT,
--     PRIMARY KEY(booking_id, service_id),
-- 	FOREIGN KEY (booking_id) REFERENCES bookings(id),
-- 	FOREIGN KEY (service_id) REFERENCES services(id)
-- );

CREATE TABLE payment_methods (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	deleted_at TIMESTAMP NULL
);

CREATE TABLE payments (
	id INT AUTO_INCREMENT PRIMARY KEY,
    date DATETIME NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    note TEXT,
    status INT NOT NULL,
    guest_id INT,
    booking_id INT,
    method_id INT,
    admin_id INT,
	FOREIGN KEY (guest_id) REFERENCES guests(id),
	FOREIGN KEY (booking_id) REFERENCES bookings(id),
    FOREIGN KEY (method_id) REFERENCES payment_methods(id),
	FOREIGN KEY (admin_id) REFERENCES admins(id)
);

/*============TEST=============*/

USE project2;
INSERT INTO admins VALUES 
(1, 'System', 'Admin', 'admin@gmail.com', '$2y$10$A/750cSQNbGRx3fn4wJ1WOzguMbCK.3uS9g6USAJSlGr7c6Fy1ERi', '+84123456789', 0, '', NULL);

INSERT INTO guests VALUES 
(1, 'Tam', 'Nguyen', 'tam.ad.php@gmail.com', '$2y$10$A/750cSQNbGRx3fn4wJ1WOzguMbCK.3uS9g6USAJSlGr7c6Fy1ERi', '+84123456789', 1, '', NULL);

INSERT INTO payment_methods(name) VALUES
('Thanh toán trực tiếp'),
('Thanh toán online');


SELECT * FROM bookings;
update bookings set date = "2024-05-30 16:00:00" where id = 1;