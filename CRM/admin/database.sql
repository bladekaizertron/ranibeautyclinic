CREATE DATABASE IF NOT EXISTS coderebuilt_crm;
USE coderebuilt_crm;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(255),
    price DECIMAL(10, 2),
    duration INT,
    is_bookable_online BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    phone VARCHAR(50),
    role VARCHAR(100),
    avatar_color VARCHAR(10) DEFAULT '#9b5de5'
);

CREATE TABLE IF NOT EXISTS service_staff (
    service_id INT,
    staff_id INT,
    is_available BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (service_id, staff_id),
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE,
    FOREIGN KEY (staff_id) REFERENCES staff(id) ON DELETE CASCADE
);

-- Seed some initial data based on current hardcoded values
INSERT IGNORE INTO staff (name, email, phone, role, avatar_color) VALUES 
('Ayla K', 'info@aylamedia.co', '(253) 408-9535', 'Service Provider', '#9b5de5'),
('Jodie X', 'coderebuilt@gmail.com', '(206) 507-8902', 'Admin', '#ff6f91'),
('Laser Room #1', 'ranibeautyclinic13@gmail.com', '(206) 554-9524', 'Service Provider', '#495057'),
('Raj Rai', 'rajvinderkaurnijjar@gmail.com', '(206) 507-8902', 'Service Provider', '#00b4d8'),
('Rina Rai', 'info@ranibeautyclinic.com', '(425) 539-4440', 'Admin', '#f4a261');

INSERT IGNORE INTO services (name, category, price, duration) VALUES
('Botox / Botox Facial', 'Face Fixes', 14.00, 30),
('Sculptra', 'Face Fixes', 950.00, 45),
('Lip Filler', 'Face Fixes', 650.00, 60);

CREATE TABLE IF NOT EXISTS clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    email VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS staff_schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    staff_id INT,
    work_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    FOREIGN KEY (staff_id) REFERENCES staff(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    staff_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    status ENUM('unconfirmed', 'confirmed', 'arrived', 'cancelled') DEFAULT 'unconfirmed',
    services TEXT,
    total_price DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (staff_id) REFERENCES staff(id) ON DELETE CASCADE
);
