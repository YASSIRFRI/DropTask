
CREATE DATABASE IF NOT EXISTS ToDo;
USE ToDo;

CREATE TABLE IF NOT EXISTS User (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) UNIQUE NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS Task (
  task_id INT AUTO_INCREMENT PRIMARY KEY,
  task_name VARCHAR(255) NOT NULL,
  task_description VARCHAR(255),
  due_date DATE,
  status ENUM('in progress', 'completed') NOT NULL
);

CREATE TABLE IF NOT EXISTS Category (
  category_id INT AUTO_INCREMENT PRIMARY KEY,
  category_name VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS Task_Category (
  task_id INT,
  category_id INT,
  PRIMARY KEY(task_id, category_id),
  FOREIGN KEY (task_id) REFERENCES Task(task_id),
  FOREIGN KEY (category_id) REFERENCES Category(category_id)
);

CREATE TABLE IF NOT EXISTS User_Task (
  user_id INT,
  task_id INT,
  PRIMARY KEY(user_id, task_id),
  FOREIGN KEY (user_id) REFERENCES User(user_id),
  FOREIGN KEY (task_id) REFERENCES Task(task_id)
);

CREATE TABLE IF NOT EXISTS Task_Reminder (
  task_id INT,
  reminder_date_time DATETIME NOT NULL,
  reminder_triggered BOOLEAN DEFAULT false,
  PRIMARY KEY(task_id, reminder_date_time),
  FOREIGN KEY (task_id) REFERENCES Task(task_id)
);





