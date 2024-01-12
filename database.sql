CREATE DATABASE IF NOT EXISTS sales_app;

USE sales_app;

CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);

CREATE TABLE IF NOT EXISTS sales (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT,
    quantity INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    sale_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE IF NOT EXISTS inventory (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT,
    branch_id INT,
    quantity INT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE IF NOT EXISTS expenses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    description VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    expense_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS customers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    credit_limit DECIMAL(10, 2) NOT NULL
);
CREATE TABLE IF NOT EXISTS daily_records (
    id INT PRIMARY KEY AUTO_INCREMENT,
    record_date DATE NOT NULL,
    income DECIMAL(10, 2) DEFAULT 0,
    expense DECIMAL(10, 2) DEFAULT 0
);
CREATE TABLE IF NOT EXISTS general_journal (
    id INT PRIMARY KEY AUTO_INCREMENT,
    entry_date DATE NOT NULL,
    description TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS journal_entry (
    id INT PRIMARY KEY AUTO_INCREMENT,
    general_journal_id INT,
    account_id INT,
    amount DECIMAL(10, 2),
    FOREIGN KEY (general_journal_id) REFERENCES general_journal(id),
    FOREIGN KEY (account_id) REFERENCES accounts(id)
);
CREATE TABLE IF NOT EXISTS ledger (
    id INT PRIMARY KEY AUTO_INCREMENT,
    account_id INT,
    entry_date DATE,
    debit DECIMAL(10, 2),
    credit DECIMAL(10, 2),
    FOREIGN KEY (account_id) REFERENCES accounts(id)
);
CREATE TABLE IF NOT EXISTS deposit_withdraw (
    id INT PRIMARY KEY AUTO_INCREMENT,
    entry_date DATE,
    description TEXT,
    amount DECIMAL(10, 2),
    type ENUM('Deposit', 'Withdraw')
);
CREATE TABLE IF NOT EXISTS cash_discount (
    id INT PRIMARY KEY AUTO_INCREMENT,
    entry_date DATE,
    description TEXT,
    amount DECIMAL(10, 2)
);
CREATE TABLE IF NOT EXISTS sales_returns_allowances (
    id INT PRIMARY KEY AUTO_INCREMENT,
    general_journal_id INT,
    product_id INT,
    quantity INT,
    amount DECIMAL(10, 2),
    FOREIGN KEY (general_journal_id) REFERENCES general_journal(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);
CREATE TABLE IF NOT EXISTS inventory_adjusting_entry (
    id INT PRIMARY KEY AUTO_INCREMENT,
    general_journal_id INT,
    product_id INT,
    new_quantity INT,
    new_cost DECIMAL(10, 2),
    FOREIGN KEY (general_journal_id) REFERENCES general_journal(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- Use appropriate hashing for passwords
    permissions TEXT
);

