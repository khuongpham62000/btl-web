-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 29, 2021 lúc 03:56 PM
-- Phiên bản máy phục vụ: 10.4.19-MariaDB
-- Phiên bản PHP: 8.0.7
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

CREATE DATABASE `fronks`;

USE `fronks`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

--
-- Cơ sở dữ liệu: `fronks`
--
-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `accounts`
--
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `role` varchar(5) NOT NULL DEFAULT 'USER'
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--
INSERT INTO
  `accounts` (
    `id`,
    `name`,
    `email`,
    `password`,
    `phone`,
    `address`,
    `image`,
    `role`
  )
VALUES
  (
    1,
    'Thin White',
    'small_fff@gmail.com',
    '123',
    '098765431',
    'UAS',
    'assets/img/account/account_img_1.jpg',
    'USER'
  ),
  (
    2,
    'A',
    'a@gmail.com',
    '1',
    '0123456789',
    'AAaa',
    'assets/img/account/account_img_2.png',
    'ADMIN'
  ),
  (
    4,
    'b',
    'b',
    'b',
    'b',
    NULL,
    'assets/img/account/account_img_4.jpg',
    'USER'
  ),
  (
    5,
    'b',
    'b@gmail.com',
    '1',
    '0123456789',
    'a',
    'assets/img/account/account_img_5.jpg',
    'USER'
  ),
  (
    17,
    'c',
    'c@gmail.com',
    '1',
    '0123987456',
    '',
    'assets/img/account/account_default.jpg',
    'ADMIN'
  );

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `orderitems`
--
CREATE TABLE `orderitems` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orderitems`
--
INSERT INTO
  `orderitems` (`id`, `order_id`, `product_id`, `quantity`)
VALUES
  (23, 0, 1, 1),
  (24, 0, 3, 1),
  (38, 0, 1, 1),
  (39, 0, 2, 4),
  (40, 0, 3, 2),
  (71, 0, 1, 1),
  (72, 0, 2, 4),
  (73, 0, 3, 2),
  (78, 0, 2, 1),
  (79, 40, 2, 1),
  (80, 40, 3, 3),
  (81, 41, 2, 1),
  (82, 41, 3, 3),
  (83, 42, 2, 1),
  (84, 42, 3, 3),
  (85, 43, 2, 1),
  (86, 43, 3, 8),
  (87, 44, 2, 5),
  (88, 44, 3, 8),
  (89, 45, 2, 5),
  (90, 45, 3, 9);

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `orderlists`
--
CREATE TABLE `orderlists` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 0,
  `total_price` decimal(10, 2) NOT NULL,
  `address` varchar(120) NOT NULL,
  `customer_name` varchar(60) DEFAULT NULL,
  `customer_phone` varchar(11) NOT NULL,
  `order_time` datetime NOT NULL DEFAULT current_timestamp(),
  `finished_time` datetime DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orderlists`
--
INSERT INTO
  `orderlists` (
    `id`,
    `account_id`,
    `total_price`,
    `address`,
    `customer_name`,
    `customer_phone`,
    `order_time`,
    `finished_time`
  )
VALUES
  (
    39,
    -1,
    '283.00',
    'a',
    'a',
    '01234567899',
    '2021-11-29 15:02:59',
    '2020-10-12 15:05:29'
  ),
  (
    40,
    2,
    '1132.87',
    'a',
    'A',
    '0123456789',
    '2021-11-29 15:43:23',
    '2021-11-29 15:49:15'
  ),
  (
    41,
    2,
    '1132.87',
    'b',
    'A',
    '0123456789',
    '2021-11-29 15:43:27',
    '2021-08-17 15:49:16'
  ),
  (
    42,
    2,
    '1132.87',
    'c',
    'A',
    '0123456789',
    '2021-11-29 15:43:30',
    '2021-11-29 15:49:19'
  ),
  (
    43,
    2,
    '2549.32',
    'f',
    'A',
    '0123456789',
    '2021-11-29 15:44:08',
    '2021-06-08 15:49:20'
  ),
  (
    44,
    2,
    '3681.32',
    'aa',
    'A',
    '0123456789',
    '2021-11-29 15:45:00',
    '2021-04-13 15:49:24'
  ),
  (
    45,
    2,
    '3964.61',
    'aa',
    'A',
    '0123456789',
    '2021-11-29 15:49:04',
    '2021-01-13 15:49:25'
  );

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `products`
--
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `image` varchar(200) NOT NULL,
  `stock` int(11) NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `volume` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--
INSERT INTO
  `products` (
    `id`,
    `name`,
    `image`,
    `stock`,
    `price`,
    `volume`,
    `description`
  )
VALUES
  (
    1,
    'Original Nut Milk',
    'https://cdn11.bigcommerce.com/s-ayhps3hr1w/images/stencil/500x659/products/118/416/Fronks_Original_01__45224.1484091301.png?c=2',
    200000,
    '283.00',
    480,
    'The house favorite, made with almonds, cashews, dates, then lightly spiced with cinnamon and sea salt.\n\nIngredients: spring water, organic almonds, organic cashews, organic dates, organic cinnamon, sea salt                                                                                                                                                                                                                                                                                                                                                                                                '
  ),
  (
    2,
    'Simple Nut Milk',
    'https://cdn11.bigcommerce.com/s-ayhps3hr1w/images/stencil/1280x1280/products/114/419/Fronks_Simple_04__73447.1578619147.png?c=2',
    3000,
    '283.00',
    480,
    'An easy, balanced almond & cashew blend, to be used in just about anything.\n\nIngredients: spring water, organic almonds, organic cashews, organic dates, sea salt                                '
  ),
  (
    3,
    'Cocoa Nut Milk',
    'https://cdn11.bigcommerce.com/s-ayhps3hr1w/images/stencil/1280x1280/products/117/415/Fronks_Cocoa_01__28865.1578619123.png?c=2',
    10000,
    '283.29',
    480,
    'The perfect treat with added hazelnuts, a few extra dates and cocoa powder.\n\nIngredients: spring water, organic almonds, organic cashews, organic dates, organic hazelnuts, cocoa powder, sea salt                '
  ),
  (
    4,
    'Fronks Vegan Eggnog',
    'assets/img/product/product_img_4.jpg',
    3000,
    '100.00',
    234,
    'The newest nut milk from Fronks in collaboration with Curcuma. Made with Curcuma\'s signature Golden Turmeric, a blend of heirloom turmeric & Ayurvedic spices like ginger, cinnamon, black pepper & cardamom, paired with Fronks\' organic almond/cashew blend for a smooth, ready to drink golden milk. Serve it over ice, warmed/steamed, or straight out of the bottle! Try a splash of cold brew for a dirty gold latte.'
  ),
  (
    5,
    'Fronks Vegan Eggnog',
    'assets/img/product/product_img_5.jpg',
    2000,
    '90.00',
    161,
    'Vegans rejoice! No longer do you have to miss out on this beloved holiday classic. Fronks limited-edition nut milk eggnog is one of our top picks for a festive holiday sipper. Warm notes of cinnamon and cardamom blend with sweet dates, cashews, and almonds to flavor this smooth and creamy vegan-friendly eggnog. Keep refrigerated and drink within 5-7 days of receiving.'
  );

--
-- Chỉ mục cho các bảng đã đổ
--
--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE
  `accounts`
ADD
  PRIMARY KEY (`id`),
ADD
  UNIQUE KEY `Email_Unique` (`email`);

--
-- Chỉ mục cho bảng `orderitems`
--
ALTER TABLE
  `orderitems`
ADD
  PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orderlists`
--
ALTER TABLE
  `orderlists`
ADD
  PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE
  `products`
ADD
  PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--
--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE
  `accounts`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 19;

--
-- AUTO_INCREMENT cho bảng `orderitems`
--
ALTER TABLE
  `orderitems`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 91;

--
-- AUTO_INCREMENT cho bảng `orderlists`
--
ALTER TABLE
  `orderlists`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 46;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE
  `products`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 7;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;