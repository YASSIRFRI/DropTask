

CREATE database ToDo;

CREATE TABLE users (
    user_id INT PRIMARY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
);


CREATE TABLE tasks(
    task_id INT PRIMARY,
    task_name VARCHAR(255) NOT NULL,
    task_description TEXT NOT NULL,
    due_date TIMESTAMP,
    status ENUM('pending', 'completed') DEFAULT 'pending',
);


CREATE TABLE category(
    category_id INT PRIMARY,
    category_name VARCHAR(255)
);


CREATE TABLE task_category(
    task_id INT NOT NULL,
    catergory_id INT NOT NULL,
    FOREIGN KEY task_id REFERENCES categories(category_id)
);




