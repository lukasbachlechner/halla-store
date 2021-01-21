-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 21. Jan 2021 um 13:50
-- Server-Version: 8.0.22-0ubuntu0.20.04.3
-- PHP-Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `halla-store`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `addresses`
--

CREATE TABLE `addresses` (
  `id` int NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `user_id` int DEFAULT NULL,
  `country` varchar(2) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `addresses`
--

INSERT INTO `addresses` (`id`, `first_name`, `last_name`, `street`, `city`, `zip`, `user_id`, `country`, `email`) VALUES
(1, 'Lukas', 'Bachlechner', 'Hirschengasse 4/11', 'Wien', '1060', 2, 'at', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `deliverymethods`
--

CREATE TABLE `deliverymethods` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `deliverymethods`
--

INSERT INTO `deliverymethods` (`id`, `name`, `price`, `is_active`) VALUES
(1, 'Standard', 5.99, 1),
(2, 'Express', 13.99, 1),
(4, 'Same-Day', 21.99, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `images_products`
--

CREATE TABLE `images_products` (
  `id` int NOT NULL,
  `image_id` int NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `products` json NOT NULL COMMENT 'serialized products',
  `billing_address_id` int NOT NULL,
  `delivery_address_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `paymentmethod_id` int NOT NULL,
  `deliverymethod_id` int NOT NULL,
  `payment_state` enum('open','paid','refunded') NOT NULL DEFAULT 'open',
  `order_state` enum('created','in_progress','shipped','refunded') NOT NULL DEFAULT 'created',
  `total` float NOT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `orders`
--

INSERT INTO `orders` (`id`, `products`, `billing_address_id`, `delivery_address_id`, `user_id`, `paymentmethod_id`, `deliverymethod_id`, `payment_state`, `order_state`, `total`, `tracking_number`, `created_at`) VALUES
(1, '[{\"id\": 25, \"name\": \"SENNHEISER Momentum True Wireless 2\", \"slug\": \"sennheiser-momentum-true-wireless-2\", \"price\": 249.99, \"quantity\": \"1\", \"subtotal\": 249.99, \"tax_rate\": 20, \"is_active\": 1, \"description\": \"Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\", \"collection_id\": 0, \"quantity_sold\": 1, \"datetime_added\": \"2021-01-21 13:45:44\", \"datetime_updated\": \"\", \"quantity_available\": 99}]', 1, 1, 2, 0, 1, 'paid', 'created', 255.98, '', '2021-01-21 13:49:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `paymentmethods`
--

CREATE TABLE `paymentmethods` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `paymentmethods`
--

INSERT INTO `paymentmethods` (`id`, `name`, `price`, `is_active`) VALUES
(1, 'Rechnung', 0, 0),
(2, 'Nachnahme', 3.99, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `permissions`
--

CREATE TABLE `permissions` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `level`) VALUES
(1, 'Kunde', 1),
(2, 'Super-Admin', 10),
(3, 'Verkauf', 20),
(4, 'Einkauf', 30),
(5, 'Support', 40);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `quantity_available` int NOT NULL,
  `quantity_sold` int NOT NULL,
  `collection_id` int DEFAULT NULL,
  `datetime_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datetime_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `slug` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `tax_rate` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity_available`, `quantity_sold`, `collection_id`, `datetime_added`, `datetime_updated`, `slug`, `is_active`, `tax_rate`) VALUES
(23, 'SENNHEISER HD 450BT', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 149.99, 100, 0, NULL, '2021-01-21 13:42:08', '2021-01-21 13:47:33', 'sennheiser-hd-450bt', 1, 20),
(24, 'SENNHEISER Momentum 3 Wireless', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 299.99, 50, 0, NULL, '2021-01-21 13:43:57', '2021-01-21 13:45:50', 'sennheiser-momentum-3-wireless-2', 1, 20),
(25, 'SENNHEISER Momentum True Wireless 2', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 249.99, 99, 1, NULL, '2021-01-21 13:45:44', '2021-01-21 13:49:00', 'sennheiser-momentum-true-wireless-2-2', 1, 20);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission_id` int NOT NULL,
  `datetime_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `permission_id`, `datetime_registered`, `newsletter`, `deleted_at`) VALUES
(2, 'Super', 'Admin', 'super@admin.com', '$2y$10$VV4HcIFUvXV19xobuOqL1u7Eq9/3fe0ztYMxDzxvuk3ZxV9TB.Ixy', 2, '2020-11-18 14:07:37', 1, NULL),
(6, 'Max', 'Verkauf', 'verkauf@halla.store', '$2y$10$eRFL4ImGr25c3FflbGx8r.yS71Zon5CQEAitxb062GP9nt5kaSVu2', 3, '2021-01-20 21:01:28', 0, NULL),
(7, 'Moritz', 'Einkauf', 'einkauf@halla.store', '$2y$10$QCgkW2TTdnRpYb02aZhYWO7avkwWE7XjzpTjszUzJYarjxSSTx6Ly', 4, '2021-01-20 21:02:01', 1, NULL),
(13, 'Erika', 'Support', 'support@halla.store', '$2y$10$8S0e3siKJOzKCZzlmDXEMungfOow1.MvoM10I0NwwuVcaifV2.vE.', 5, '2021-01-21 11:05:46', 0, NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `deliverymethods`
--
ALTER TABLE `deliverymethods`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `images_products`
--
ALTER TABLE `images_products`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `paymentmethods`
--
ALTER TABLE `paymentmethods`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `level` (`level`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `deliverymethods`
--
ALTER TABLE `deliverymethods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `images_products`
--
ALTER TABLE `images_products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `paymentmethods`
--
ALTER TABLE `paymentmethods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
