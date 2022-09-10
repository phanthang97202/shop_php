/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3306
 Source Schema         : mobile_store

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 03/07/2022 16:00:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (27, 'Xiaomi', 'xiaomi', 'product');
INSERT INTO `categories` VALUES (31, 'Lumia', 'lumia', 'product');
INSERT INTO `categories` VALUES (32, 'Samsung', 'samsung', 'product');
INSERT INTO `categories` VALUES (35, 'I Phone', 'i-phone', 'product');

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NULL DEFAULT NULL,
  `product_id` int(11) NULL DEFAULT NULL,
  `price_buy` float NULL DEFAULT NULL,
  `quantity` int(11) NULL DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 94 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_details
-- ----------------------------
INSERT INTO `order_details` VALUES (90, 84, 14, 5000000, 2, '1656490653');
INSERT INTO `order_details` VALUES (91, 84, 17, 2000000, 2, '1656490653');
INSERT INTO `order_details` VALUES (92, 85, 16, 2600000, 1, '1656657462');
INSERT INTO `order_details` VALUES (93, 86, 16, 2600000, 1, '1656666079');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `total_money` float NULL DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 87 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (84, 75, 14000000, '1656490653', 2, 'Mua luôn bạn ơi ', 'Hà Nam', '0121282282');
INSERT INTO `orders` VALUES (85, 75, 2600000, '1656657462', 2, 'fgfdg', 'Hà Nam', '0121282282');
INSERT INTO `orders` VALUES (86, 75, 2600000, '1656666079', 1, '', 'Hà Nam', '0121282282');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  `price_sale` decimal(10, 2) NULL DEFAULT NULL,
  `category_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (14, 'Samsung Galaxy S21 Ultra', 'samsung-galaxy-s21-ultra', '                                                                                                                                        Điện thoại Samsung Galaxy S21 Ultra 5G 128GB                                                                                                                 ', '                                                                                                                                        Sự đẳng cấp được Samsung gửi gắm thông qua chiếc smartphone Galaxy S21 Ultra 5G với hàng loạt sự nâng cấp và cải tiến không chỉ ngoại hình bên ngoài mà còn sức mạnh bên trong, hứa hẹn đáp ứng trọn vẹn nhu cầu ngày càng cao của người dùng.\r\nĐột phá trong thiết kế thời thượng                                                                                                                ', 'assets/upload/1655643912_ochiro.png', 5000000.00, 5000000.00, 32);
INSERT INTO `products` VALUES (16, 'Samsung Galaxy Y', 'samsung-galaxy-y', '                                                                                    Điện thoại Samsung Galaxy A20                                                                                                              ', '                                                                                    Samsung Galaxy A20 là chiếc máy rẻ nhất trong dòng Galaxy A của Samsung mang lại cho người dùng những trải nghiệm cao cấp của những chiếc máy tới từ Samsung nhưng vẫn không phải bỏ ra số tiền quá lớn.\r\nMàn hình Infinity-V hoàn toàn mới mẻ                                                                                                          ', 'assets/upload/1654770380_sam.jpg', 3400000.00, 2600000.00, 32);
INSERT INTO `products` VALUES (17, 'Samsung A20', 'samsung-a20', '                            Điện thoại Samsung Galaxy A12 4GB (2021)                         ', '                            Galaxy A12 2021 chiếc điện thoại thông minh giá rẻ đến từ thương hiệu Samsung, nó sở hữu một cấu hình ổn định cùng với viên pin dung lượng lớn 5000 mAh đáp ứng đa dạng nhu cầu sử dụng của người tiêu dùng.\r\nMàn hình lớn, mở rộng không gian trải nghiệm                                                    ', 'assets/upload/1654770410_samsung-a12-trắng.png', 3000000.00, 2000000.00, 32);
INSERT INTO `products` VALUES (18, 'Xiaomi Redmi Note 7', 'xiaomi-redmi-note-7', '                Điện thoại Xiaomi Redmi Note 7 (4GB/64GB)', '                Xiaomi Redmi Note 7 4GB/64GB là chiếc smartphone giá rẻ mới được giới thiệu vào đầu năm 2019 với nhiều trang bị đáng giá như thiết kế notch giọt nước hay camera lên tới 48 MP.\r\nHiệu năng mạnh mẽ trải nghiệm game mượt mà', 'assets/upload/1654782196_126551f758cd6ca321a87959e3510e2c.png', 3500000.00, 2500000.00, 27);
INSERT INTO `products` VALUES (19, 'Điện thoại iPhone 12 Mini 64GB', 'dien-thoai-iphone-12-mini-64gb', '                                                                                                                        Điện thoại iPhone 12 mini 64GB                                                                                        ', '                                                                                                                        Điện thoại iPhone 12 mini 64 GB tuy là phiên bản thấp nhất trong bộ 4 iPhone 12 series, nhưng vẫn sở hữu những ưu điểm vượt trội về kích thước nhỏ gọn, tiện lợi, hiệu năng đỉnh cao, tính năng sạc nhanh cùng bộ camera chất lượng cao.                                                                                        ', 'assets/upload/1654782306_apple-iphone-12-mini-5.png', 12000000.00, 11000000.00, 35);
INSERT INTO `products` VALUES (25, 'Điện thoại Nokia Lumia 520', 'dien-thoai-nokia-lumia-520', 'Nokia Lumia 520 – Smartphone Nokia giá rẻ, thiết kế đẹp chạy Windows Phone 8  ', 'Nokia Lumia 520 là điện thoại thông minh chạy Windows Phone 8 giá rẻ nhất hiện nay mà Nokia dòng Lumia tung ra thị trường. Máy có nhiều màu sắc trẻ trung, và có thiết kế khá “dễ thương”.', 'assets/upload/1655738546_Nokia-Lumia-520-l.jpg', 2300000.00, 2000000.00, 31);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `supperAdmin` tinyint(1) NULL DEFAULT 0,
  `staff` tinyint(1) NULL DEFAULT 0,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 80 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (54, 'Phan Văn Thăng ', 'phanthang97202@gmail.com', '202cb962ac59075b964b07152d234b70', 'Hà Nam', '123344', 1, 0, 'assets/upload/1655530274_fgd.jpg');
INSERT INTO `users` VALUES (75, 'Phan Bình', 'binh@gmail.com', '202cb962ac59075b964b07152d234b70', 'Hà Nam', '0121282282', 0, 0, 'assets/upload/1655783378_©️ 抖音 206550667.jfif');
INSERT INTO `users` VALUES (78, 'Phan Liên', 'lien@gmail.com', '202cb962ac59075b964b07152d234b70', 'Hà Nam', '1312432352', 0, 1, 'assets/upload/1655884339_157298-shhenok-labradudel-sobaka_porody-kot-pes-1080x1920.jpg');
INSERT INTO `users` VALUES (79, 'Trần Đình Cường', 'cuong@gmail.com', '202cb962ac59075b964b07152d234b70', 'Hà Nam', '01299292191', 0, 1, 'assets/upload/1656491326_ex.png');

SET FOREIGN_KEY_CHECKS = 1;
