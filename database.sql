-- ============================================================
-- VOLTMIX Energy Drink Konfigurator – SQL Dump
-- Datenbank: meine_db (siehe docker-compose.yml)
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;

-- --------------------------------------------------------
-- Tabelle: users
-- Benutzerkonten mit Adressdaten
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `vorname` VARCHAR(100) NOT NULL,
    `nachname` VARCHAR(100) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `passwort_hash` VARCHAR(255) NOT NULL,
    `strasse` VARCHAR(255) DEFAULT '',
    `plz` VARCHAR(10) DEFAULT '',
    `stadt` VARCHAR(100) DEFAULT '',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabelle: configurations
-- Gespeicherte Drink-Konfigurationen
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `configurations` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `caffeine_level` VARCHAR(10) NOT NULL DEFAULT '150',
    `sweetener` VARCHAR(50) NOT NULL DEFAULT 'stevia',
    `size_ml` VARCHAR(10) NOT NULL DEFAULT '300',
    `can_name` VARCHAR(50) DEFAULT '',
    `can_color` VARCHAR(10) DEFAULT '#39FF14',
    `total_price` DECIMAL(8,2) NOT NULL DEFAULT 0.00,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabelle: configuration_flavors
-- Zuordnung: Konfiguration <-> gewählte Geschmacksrichtungen
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `configuration_flavors` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `configuration_id` INT NOT NULL,
    `flavor_id` VARCHAR(50) NOT NULL,
    FOREIGN KEY (`configuration_id`) REFERENCES `configurations`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabelle: configuration_extras
-- Zuordnung: Konfiguration <-> gewählte Extras
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `configuration_extras` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `configuration_id` INT NOT NULL,
    `extra_id` VARCHAR(50) NOT NULL,
    FOREIGN KEY (`configuration_id`) REFERENCES `configurations`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabelle: coupons
-- Gutscheincodes (Extra-Feature)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupons` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `code` VARCHAR(50) NOT NULL UNIQUE,
    `discount_percent` INT NOT NULL DEFAULT 10,
    `valid_until` DATE NOT NULL,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Beispieldaten: Gutscheincodes
-- --------------------------------------------------------
INSERT INTO `coupons` (`code`, `discount_percent`, `valid_until`, `is_active`) VALUES
('WELCOME10', 10, '2026-12-31', 1),
('GAMER20', 20, '2026-06-30', 1),
('ENERGY15', 15, '2026-12-31', 1),
('THM2026', 25, '2026-03-31', 1),
('ABGELAUFEN', 50, '2024-01-01', 1);

-- --------------------------------------------------------
-- Beispieldaten: Testbenutzer
-- Passwort: test123 (bcrypt Hash)
-- --------------------------------------------------------
INSERT INTO `users` (`vorname`, `nachname`, `email`, `passwort_hash`, `strasse`, `plz`, `stadt`) VALUES
('Max', 'Mustermann', 'max@test.de', '$2b$10$3VCvIJUDfFJTA.uwtE6A6e4R/PIwcSZOwWPt6Rc3cDjfLH/.B7csS', 'Musterstraße 1', '35390', 'Gießen');

-- Beispiel-Konfiguration für Testbenutzer
INSERT INTO `configurations` (`user_id`, `caffeine_level`, `sweetener`, `size_ml`, `can_name`, `can_color`, `total_price`) VALUES
(1, '200', 'stevia', '1000', 'THM', '#39FF14', 13.75);

INSERT INTO `configuration_flavors` (`configuration_id`, `flavor_id`) VALUES
(1, 'pfirsich'),
(1, 'yuzu'),
(1, 'litschi');

INSERT INTO `configuration_extras` (`configuration_id`, `extra_id`) VALUES
(1, 'ltheanin'),
(1, 'elektrolyte'),
(1, 'taurin'),
(1, 'bvitamine');

COMMIT;
