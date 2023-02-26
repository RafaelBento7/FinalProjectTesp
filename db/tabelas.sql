CREATE SCHEMA IF NOT EXISTS aerocontrol;

CREATE SCHEMA IF NOT EXISTS aerocontrol_tests;

USE aerocontrol;

--
-- Estrutura da tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `username` VARCHAR(30) NOT NULL,
    `auth_key` VARCHAR(32) NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    `password_reset_token` VARCHAR(255) NULL,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `gender` ENUM('Masculino', 'Feminino', 'Outro') NOT NULL,
    `country` VARCHAR(50) NOT NULL,
    `city` VARCHAR(75) NOT NULL,
    `birthdate` DATE NOT NULL,
    `email` VARCHAR(200) NOT NULL,
    `phone` VARCHAR(15) NOT NULL,
    `phone_country_code` VARCHAR(5) NOT NULL,
    `status` SMALLINT(6) NOT NULL DEFAULT '9',
    `created_at` INT(11) NOT NULL,
    `updated_at` INT(11) NOT NULL,
    `verification_token` VARCHAR(255) NULL,
    CONSTRAINT `pk_user_id` PRIMARY KEY(`id`),
    CONSTRAINT `uk_username` UNIQUE KEY(`username`),
    CONSTRAINT `uk_password_reset_token` UNIQUE KEY(`password_reset_token`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
    `admin_id` INT UNSIGNED,
    `status` TINYINT UNSIGNED NOT NULL DEFAULT 1,
    CONSTRAINT `pk_admin_id` PRIMARY KEY(`admin_id`),
    CONSTRAINT `fk_admin_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `user`(`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `client`
--

CREATE TABLE IF NOT EXISTS `client` (
    `client_id` INT UNSIGNED,
    `status` TINYINT UNSIGNED NOT NULL DEFAULT 1,
    CONSTRAINT `pk_client_id` PRIMARY KEY(`client_id`),
    CONSTRAINT `fk_client_client_id` FOREIGN KEY (`client_id`) REFERENCES `user`(`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `employee_function`
--

CREATE TABLE IF NOT EXISTS `employee_function` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `state` TINYINT(1) NOT NULL DEFAULT 1,
    CONSTRAINT `pk_employee_function_id` PRIMARY KEY (`id`),
    CONSTRAINT `uk_name` UNIQUE KEY(`name`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
    `employee_id` INT UNSIGNED,
    `tin` VARCHAR(20) NOT NULL,
    `num_emp` VARCHAR(20) NOT NULL,
    `ssn` VARCHAR(20) NOT NULL,
    `street` VARCHAR(100) NOT NULL,
    `zip_code` VARCHAR(20) NOT NULL,
    `iban` CHAR(25) NOT NULL,
    `qualifications` enum(
        'Até ao 9º ano de escolaridade',
        'Secundário',
        'Curso técnico superior profissional',
        'Diploma de Especialização Tecnológica',
        'Ensino superior - bacharelato ou equivalente',
        'Licenciatura Pré-Bolonha',
        'Licenciatura 1º Ciclo - Pós-Bolonha',
        'Mestrado',
        'Doutoramento'
    ) NOT NULL,
    `status` TINYINT UNSIGNED NOT NULL DEFAULT 1,
    `function_id` INT(11) UNSIGNED NOT NULL,
    CONSTRAINT `pk_employee_id` PRIMARY KEY(`employee_id`),
    CONSTRAINT `fk_employee_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `user`(`id`),
    CONSTRAINT `fk_employee_function_id` FOREIGN KEY (`function_id`) REFERENCES `employee_function`(`id`),
    CONSTRAINT `uk_num_emp` UNIQUE KEY(`num_emp`),
    CONSTRAINT `uk_ssn` UNIQUE KEY(`ssn`),
    CONSTRAINT `uk_tin` UNIQUE KEY(`tin`),
    CONSTRAINT `uk_iban` UNIQUE KEY(`iban`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `store`
--

CREATE TABLE IF NOT EXISTS `store` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `name` VARCHAR(75) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(20) NOT NULL,
    `open_time` TIME NULL,
    `close_time` TIME NULL,
    `logo` VARCHAR(50) NULL,
    `website` VARCHAR(50) NULL,
    CONSTRAINT `pk_store_id` PRIMARY KEY(`id`),
    CONSTRAINT `uk_name` UNIQUE KEY(`name`),
    CONSTRAINT `uk_logo` UNIQUE KEY(`logo`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `restaurant`
--

CREATE TABLE IF NOT EXISTS `restaurant` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `name` VARCHAR(75) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(20) NOT NULL,
    `open_time` TIME NULL,
    `close_time` TIME NULL,
    `logo` VARCHAR(50) NULL,
    `website` VARCHAR(50) NULL,
    CONSTRAINT `pk_restaurant_id` PRIMARY KEY(`id`),
    CONSTRAINT `uk_name` UNIQUE KEY(`name`),
    CONSTRAINT `uk_logo` UNIQUE KEY(`logo`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `restaurant_item`
--

CREATE TABLE IF NOT EXISTS `restaurant_item` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `item` VARCHAR(100) NOT NULL,
    `image` VARCHAR(50) NULL,
    `state` TINYINT(1) NOT NULL DEFAULT 1,
    `restaurant_id` INT(11) UNSIGNED NOT NULL,
    CONSTRAINT `pk_restaurant_item_id` PRIMARY KEY(`id`),
    CONSTRAINT `fk_restaurant_item_restaurant_id` FOREIGN KEY(`restaurant_id`) REFERENCES `restaurant`(`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `manager`
--

CREATE TABLE IF NOT EXISTS `manager` (
    `manager_id` INT UNSIGNED,
    `restaurant_id` INT(11) UNSIGNED NOT NULL,
    `status` TINYINT UNSIGNED NOT NULL DEFAULT 1,
    CONSTRAINT `pk_manager_id` PRIMARY KEY(`manager_id`),
    CONSTRAINT `fk_manager_manager_id` FOREIGN KEY (`manager_id`) REFERENCES `user`(`id`),
    CONSTRAINT `fk_manager_restaurant_id` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant`(`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `airport`
--

CREATE TABLE IF NOT EXISTS `airport` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `country` VARCHAR(50) NOT NULL,
    `city` VARCHAR(75) NOT NULL,
    `name` VARCHAR(75) NOT NULL,
    `website` VARCHAR(50) NOT NULL,
    CONSTRAINT `pk_airport_id` PRIMARY KEY(`id`),
    CONSTRAINT `uk_name` UNIQUE KEY(`name`),
    CONSTRAINT `uk_website` UNIQUE KEY(`website`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `company`
--

CREATE TABLE IF NOT EXISTS `company` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `state` TINYINT(1) NOT NULL,
    CONSTRAINT `pk_company_id` PRIMARY KEY(`id`),
    CONSTRAINT `uk_name` UNIQUE KEY(`name`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `airplane`
--

CREATE TABLE IF NOT EXISTS `airplane` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `name` VARCHAR(75) NOT NULL,
    `capacity` SMALLINT(6) NOT NULL,
    `state` TINYINT(1) NOT NULL,
    `company_id` INT(11) UNSIGNED NOT NULL,
    CONSTRAINT `pk_airplane_id` PRIMARY KEY(`id`),
    CONSTRAINT `fk_airplane_company_id` FOREIGN KEY(`company_id`) REFERENCES `company`(`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `payment_method`
--

CREATE TABLE IF NOT EXISTS `payment_method` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `state` TINYINT(1) NOT NULL,
    CONSTRAINT `pk_payment_method` PRIMARY KEY(`id`),
    CONSTRAINT `uk_name` UNIQUE KEY(`name`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `flight`
--

CREATE TABLE IF NOT EXISTS `flight` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `terminal` VARCHAR(30) NOT NULL,
    `estimated_departure_date` DATETIME NOT NULL,
    `estimated_arrival_date` DATETIME NOT NULL,
    `departure_date` DATETIME NULL,
    `arrival_date` DATETIME NULL,
    `price` DOUBLE NOT NULL,
    `distance` FLOAT NOT NULL,
    `state` ENUM('Previsto','Chegou','Partiu','Cancelado','Embarque','Ultima Chamada') NOT NULL DEFAULT 'Previsto',
    `discount_percentage` TINYINT(4) NOT NULL,
    `passengers_left` INT UNSIGNED NOT NULL,
    `origin_airport_id` INT UNSIGNED NOT NULL,
    `arrival_airport_id` INT UNSIGNED NOT NULL,
    `airplane_id` INT UNSIGNED NOT NULL,
    CONSTRAINT `pk_flight_id` PRIMARY KEY(`id`),
    CONSTRAINT `fk_flight_origin_airport_id` FOREIGN KEY(`origin_airport_id`) REFERENCES `airport`(`id`),
    CONSTRAINT `fk_flight_arrival_airport_id` FOREIGN KEY(`arrival_airport_id`) REFERENCES `airport`(`id`),
    CONSTRAINT `fk_flight_airplane_id` FOREIGN KEY(`airplane_id`) REFERENCES `airplane`(`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `flight_ticket`
--

CREATE TABLE IF NOT EXISTS `flight_ticket` (
    `flight_ticket_id` INT UNSIGNED AUTO_INCREMENT,
    `price` DOUBLE NOT NULL,
    `purchase_date` DATETIME NOT NULL,
    `checkin` TINYINT(1) NOT NULL,
    `client_id` INT(11) UNSIGNED NOT NULL,
    `flight_id` INT(11) UNSIGNED NOT NULL,
    `payment_method_id` INT(11) UNSIGNED NOT NULL,
    CONSTRAINT `pk_flight_ticket` PRIMARY KEY(`flight_ticket_id`,`client_id`,`flight_id`),
    CONSTRAINT `fk_flight_ticket_client_id` FOREIGN KEY(`client_id`) REFERENCES `client`(`client_id`),
    CONSTRAINT `fk_flight_ticket_flight_id` FOREIGN KEY(`flight_id`) REFERENCES `flight`(`id`),
    CONSTRAINT `fk_flight_ticket_payment_method_id` FOREIGN KEY(`payment_method_id`) REFERENCES `payment_method`(`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `passenger`
--

CREATE TABLE IF NOT EXISTS `passenger` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `gender` ENUM('Masculino','Feminino','Outro') NOT NULL,
    `extra_baggage` TINYINT(1) NOT NULL,
    `seat` VARCHAR(3) NOT NULL,
    `flight_ticket_id` INT(11) UNSIGNED NOT NULL,
    CONSTRAINT `pk_passenger_id` PRIMARY KEY (`id`),
    CONSTRAINT `fk_passenger_flight_ticket_id` FOREIGN KEY(`flight_ticket_id`) REFERENCES `flight_ticket`(`flight_ticket_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `lost_item`
--

CREATE TABLE IF NOT EXISTS `lost_item` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `description` VARCHAR(100) NOT NULL,
    `state` ENUM('Entregue','Por entregar','Perdido') NOT NULL DEFAULT 'Por entregar',
    `image` VARCHAR(75) NULL,
    CONSTRAINT `pk_lost_item_id` PRIMARY KEY(`id`),
    CONSTRAINT `uk_image` UNIQUE KEY(`image`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `support_ticket`
--

CREATE TABLE IF NOT EXISTS `support_ticket` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `title` VARCHAR(20) NOT NULL,
  `state` ENUM('Por Rever','Em Progresso','Concluido') NOT NULL DEFAULT 'Por Rever',
  `client_id` INT(11) UNSIGNED NOT NULL,
  CONSTRAINT `pk_support_ticket_id` PRIMARY KEY (`id`),
  CONSTRAINT `fk_support_ticket_client_id` FOREIGN KEY (`client_id`) REFERENCES `client`(`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `ticket_item`
--

CREATE TABLE IF NOT EXISTS `ticket_item` (
    `lost_item_id` INT UNSIGNED,
    `support_ticket_id` INT(11) UNSIGNED NOT NULL,
    CONSTRAINT `pk_ticket_item_lost_item_id` PRIMARY KEY(`lost_item_id`),
    CONSTRAINT `fk_ticket_item_lost_item_id`  FOREIGN KEY (`lost_item_id`) REFERENCES `lost_item` (`id`),
    CONSTRAINT `fk_ticket_item_support_ticket_id` FOREIGN KEY (`support_ticket_id`) REFERENCES `support_ticket` (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `ticket_message`
--

CREATE TABLE IF NOT EXISTS `ticket_message` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `message` VARCHAR(255) NOT NULL,
    `sender_id` INT(11) UNSIGNED NOT NULL,
    `support_ticket_id` INT(11) UNSIGNED NOT NULL,
    CONSTRAINT `pk_ticket_message` PRIMARY KEY(`id`),
    CONSTRAINT `fk_ticket_message_support_ticket_id` FOREIGN KEY(`support_ticket_id`) REFERENCES `support_ticket`(`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;