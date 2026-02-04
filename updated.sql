CREATE TABLE eupdated (
    id INT PRIMARY KEY,
    bname VARCHAR(255),
    service VARCHAR(255),
    money DECIMAL(10, 2),
    method VARCHAR(50),
    dte DATE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
