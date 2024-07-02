CREATE TABLE users (
    id SERIAL PRIMARY KEY NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    active INTEGER NOT NULL DEFAULT(1),
    last_access TIMESTAMP WITHOUT TIME ZONE,
    created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT(NOW())
);

CREATE TABLE categories (
    id SERIAL PRIMARY KEY NOT NULL,
    name VARCHAR(255) NOT NULL,
    active INTEGER NOT NULL DEFAULT(1),
    created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT(NOW())
);

CREATE TABLE products (
    id SERIAL PRIMARY KEY NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price FLOAT NOT NULL,
    category_id INT NOT NULL,
    active INTEGER NOT NULL DEFAULT(1),
    created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT(NOW()),
    
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE taxes (
    id SERIAL PRIMARY KEY NOT NULL,
    name VARCHAR(255) NOT NULL,
    rate DECIMAL(5,2),
    region VARCHAR(255)
);

CREATE TABLE category_taxes (
    id SERIAL PRIMARY KEY NOT NULL,
    category_id INT NOT NULL,
    tax_id INT NOT NULL,
    created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT(NOW())
);

ALTER TABLE category_taxes ADD CONSTRAINT category_id FOREIGN KEY (category_id)
REFERENCES categories(id) ON DELETE CASCADE;

ALTER TABLE category_taxes ADD CONSTRAINT tax_id FOREIGN KEY (tax_id)
REFERENCES taxes(id) ON DELETE CASCADE;

CREATE TABLE sales (
    id SERIAL PRIMARY KEY NOT NULL,
    created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT(NOW())
);

CREATE TABLE product_sale (
    id SERIAL PRIMARY KEY NOT NULL,
    product_id INT NOT NULL,
    sale_id INT NOT NULL,
    created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT(NOW()),

    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (sale_id) REFERENCES sales(id)
);

-- PASSWORD HASH ADMIN = "123456"
INSERT INTO users (id, name, email, password, active, last_access) VALUES (1, 'admin', 'admin@admin.com', '$2y$10$d/jodesdEdVAmbwgrH.GA.O1FaB47mAwCiI1IGmW.q2xcnc5G1foy',1, now());