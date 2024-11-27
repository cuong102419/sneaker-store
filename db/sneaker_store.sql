-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2024 at 05:19 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sneaker_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Adidas', 'brands/BeAt8orREBTWREFE1PCCDtLibCXOTulawRSknT5q.png', NULL, '2024-11-15 06:50:58', '2024-11-15 06:50:58'),
(2, 'Nike', 'brands/sn70YxBXWXytvbfjCqKwly1v0CK77NqHyWOfAb1y.jpg', NULL, '2024-11-15 06:51:07', '2024-11-15 06:51:07'),
(3, 'Puma', 'brands/1EM4Pz6Dq3sDiNJhJ7tLJQfrcqMvVDS4LWV3SGoA.jpg', NULL, '2024-11-15 06:51:20', '2024-11-15 06:51:20'),
(4, 'New Balance', 'brands/wDIsTqQagfZjo3KafZCSLb79K3wzy5bBoVsjUJnE.png', NULL, '2024-11-15 06:51:36', '2024-11-15 06:51:36');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(279, '2014_10_12_000000_create_users_table', 1),
(280, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(281, '2019_08_19_000000_create_failed_jobs_table', 1),
(282, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(283, '2024_10_29_040704_create_categories_table', 1),
(284, '2024_10_29_040738_create_products_table', 1),
(285, '2024_10_29_040756_create_sizes_table', 1),
(286, '2024_10_29_040811_create_product_variants_table', 1),
(287, '2024_10_29_040831_create_orders_table', 1),
(288, '2024_10_29_040842_create_order_items_table', 1),
(289, '2024_10_29_040857_create_comments_table', 1),
(290, '2024_10_31_222124_create_product_images_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('pending','processing','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `total_amount` double NOT NULL,
  `payment_status` enum('paid','unpaid','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cod',
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_notes` text COLLATE utf8mb4_unicode_ci,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `total_amount`, `payment_status`, `payment_method`, `shipping_address`, `customer_notes`, `phone_number`, `fullname`, `created_at`, `updated_at`) VALUES
(1, 1, 'completed', 5580000, 'paid', 'cod', 'hà nội', NULL, '0369251248', 'Mạnh Cường', '2024-11-15 07:41:08', '2024-11-15 07:41:58');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `variant_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` double NOT NULL,
  `subtotal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `variant_id`, `quantity`, `unit_price`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 21, 1, 1890000, 1890000, '2024-11-15 07:41:08', '2024-11-15 07:41:08'),
(2, 1, 8, 30, 1, 3690000, 3690000, '2024-11-15 07:41:08', '2024-11-15 07:41:08');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('available','discontinued','out_of_stock') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `view` int NOT NULL DEFAULT '0',
  `sales_count` int NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `image`, `status`, `view`, `sales_count`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'Giày Nike Air Force 1 ’07 ‘Triple White’ (WMNS)', '<p>Nike Air Force 1 ’07 ‘Triple White’ là một trong những đôi giày thể thao nhất định phải có dành cho các sneakerhead bởi sự đơn giản mà thu hút của nó.Được thiết kế phù hợp với xu hướng chunky sneaker, đôi AF1 này mang lại cái nhìn thời thượng và phong cách khi mang chúng trên chân. Được hoàn thiện với dấu Swoosh đặc trưng của Nike và các lỗ đục ở phần mũi giày khiến cho chúng không chỉ đẹp mà còn vô cùng thoải mái và thông thoáng khi sử dụng.</p>\r\nNếu bạn đang tìm kiếm một đôi giày thể thao cao cấp, thì Nike Air Force 1 All White Code Women có thể là lựa chọn hoàn hảo dành cho bạn. Giày được bao phủ bởi lớp da cao cấp với màu trắng sang trọng với ren kim loại mang thương hiệu AF1 màu bạc đặc trưng của Nike để tạo nên sự tương phản lung linh.</p>', 2590000, 'images/Ojtq0YU7kP2FMaZqxLrvIhb0apxRrfywIShkhPzh.webp', 'available', 1, 0, NULL, '2024-11-15 07:02:26', '2024-11-15 07:02:31'),
(2, 2, 'Giày nam Nike Dunk Low Retro ‘Panda’ White Black (2021)', '<p>Nike dự kiến ​​phát hành một số phối màu Dunk mới vào năm 2021, bao gồm phiên bản “Trắng / Đen” này của Dunk Low.</p>\r\nSản phẩm này của Nike Dunk Low được khoác lên mình bộ màu trắng và đen cổ điển. Nó có đế bằng da màu Trắng với lớp phủ màu đen và Swooshes trên đỉnh đế giữa màu trắng và đế ngoài bằng cao su màu đen.</p>', 3250000, 'images/VA5pLjq3lOEDuOmwuTuvS8mKrPKlnvCPkdSLOlTG.webp', 'available', 2, 0, NULL, '2024-11-15 07:04:57', '2024-11-15 07:05:24'),
(3, 1, 'Giày adidas Samba OG ‘White Black Gum’', '<p>Adidas Samba OG ‘White Black Gum’ B75806 là một đôi giày thể thao cổ điển được thiết kế dành cho bóng đá futsal. Nó có phần upper được làm từ da lộn và da bóng với các điểm nhấn màu trắng, đen và nâu gum.</p>\r\nPhần upper của giày có màu trắng chủ đạo với các điểm nhấn màu đen và nâu gum. Nó có một thiết kế đơn giản và cổ điển.</p>\r\nĐế giữa của giày được làm từ EVA, một loại vật liệu nhẹ và đàn hồi. Nó cung cấp khả năng hấp thụ sốc và độ êm ái cho mỗi bước chân.</p>', 2490000, 'images/55fYzh8cNTn3CY8iBgSJFhRIGLYlib8uNI5ihU01.jpg', 'available', 1, 0, NULL, '2024-11-15 07:07:38', '2024-11-15 07:07:44'),
(4, 3, 'Giày Puma Breaker lthr black Man', '<p>Puma Breaker lthr black Man chính hãng với khả năng chống thấm nước trên cả tuyệt vời, độ bền màu, chất liệu êm ái và những đường chỉ may tỉ mỉ từng li từng tí đem đến cho người tiêu dùng 1 sản phẩm đạt đến độ tinh xảo cao và chắc chắn, bền bỉ với thời gian. Không những thế, với vẻ ngoài mang hơi hướng hiện đại còn tôn lên được nét đẹp đến từ cá tính riêng của bạn. </p>', 2190000, 'images/nvCiVkYGglfVFVOhT2bkSbawDP1SN7VJB3ODves0.webp', 'available', 6, 0, NULL, '2024-11-15 07:10:53', '2024-11-27 05:16:48'),
(5, 4, 'Giày New Balance 530 Retro ‘Running Navy’', '<p>New Balance là một thương hiệu thời trang và giày thể thao từ Mỹ. Hơn 100 năm qua, New Balance luôn tìm hiểu nhu cầu của những vận động viên để đầu tư, thiết kế những sản phẩm phù hợp. New Balance luôn tập trung đến từng chuyển động của cơ thể con người để có thể “Tạo-Ra-Điều-Tuyệt-Vời” (Making Excellent Happen)!</p>', 2890000, 'images/tkuJX6NMRnazy3ZDvW34U1hpyuKHV2X3mIa4vsO2.webp', 'available', 2, 0, NULL, '2024-11-15 07:14:28', '2024-11-15 07:26:20'),
(6, 1, 'Giày adidas Superstar ‘White Black’', 'Adidas Superstar ‘White Black’ hiện đã có sẵn tại Sneaker Store, đừng bỏ lỡ cơ hội của mình nhé!', 1890000, 'images/kw6uoANaqhtT84P0njpmYY99qaRe5nEqfOfOUNCt.webp', 'available', 4, 1, NULL, '2024-11-15 07:17:26', '2024-11-15 07:41:08'),
(7, 1, 'Giày Adidas Campus 00s ‘Black White Gum’', '<p>Giày Adidas Campus 00s ‘Black White Gum’ là một phiên bản cập nhật của dòng giày Campus cổ điển của adidas. Đôi giày được ra mắt vào năm 2022, với thiết kế mang đậm phong cách retro và chất liệu cao cấp.</p>\r\nGiày có phần upper được làm từ da nubuck và da lộn, mang lại sự bền bỉ và thoải mái. Phần upper có màu đen chủ đạo, với các chi tiết màu trắng ở lưỡi gà, logo adidas và đế giữa. Phần đế ngoài được làm từ cao su gum, mang lại độ bám tốt trên nhiều bề mặt khác nhau.</p>\r\nGiày Adidas Campus 00s ‘Black White Gum’ có thiết kế đơn giản nhưng tinh tế, phù hợp với nhiều phong cách thời trang khác nhau. Đôi giày là một lựa chọn tuyệt vời cho những người yêu thích giày thể thao cổ điển.</p>', 2790000, 'images/5dwiNMDzQj8eSvLgvYf8BhiHs17DdptjXJf85XfK.webp', 'available', 1, 0, NULL, '2024-11-15 07:20:13', '2024-11-15 07:20:17'),
(8, 4, 'Giày New Balance 574 ‘White Grey’', '<p>Giày New Balance 574 ‘White Grey’ (Mã sản phẩm: U574FOG) là một mẫu giày thể thao phối màu với sự kết hợp giữa màu trắng và màu xám. Đây là một phiên bản mang tính chất cổ điển, phù hợp cho cả các hoạt động thể thao và thời trang hàng ngày.</p>\r\nMô tả này chỉ mang tính chất tổng quan và không đầy đủ chi tiết. Để có mô tả chính xác hơn và hiểu rõ hơn về sản phẩm, bạn nên tham khảo thông tin từ nguồn gốc, như trang web chính thức của New Balance hoặc các trang web mua sắm trực tuyến uy tín.</p>', 3690000, 'images/PZ2i0kYetsS93Xexy0Zk4OqRPfrPeCdwMkSZ6df6.webp', 'available', 3, 1, NULL, '2024-11-15 07:23:11', '2024-11-15 07:41:08'),
(9, 3, 'Giày Puma RS-X Patent Jr ‘White Yellow Alert’', '<p>Giày Puma RS-X Patent Jr ‘White Yellow Alert’ được sản xuất từ chất liệu được chọn lọc cao cấp, đường chỉ may chắc chắn, độ bền cao, nâng niu từng bước chân của bạn. Đế cao su chắc chắn có khả năng ma sát tốt, chống trơn trượt, có thể di chuyển trên nhiều địa hình. Giày Puma dễ dàng phối hợp cùng các trang phục hàng ngày, phù hợp khi đi học, đi chơi, dạo phố, tập thể dục… </p>', 1290000, 'images/lZ5kkSn9zCFYEzniX4ATc4AaD4VEhO7qn4WQiGSk.webp', 'available', 3, 0, NULL, '2024-11-15 07:25:59', '2024-11-27 05:12:03'),
(10, 2, 'Giày nam Dior x Air Jordan 1 High', '<p>Nếu bạn là một fan hâm mộ của Dior AJ1 High, hãy đợi cho đến khi bạn nhìn thấy Dior x Air Jordan 1 High. Chắc chắn là một trong những bản collab sneaker hot nhất trong cả thập kỷ, hình bóng một đôi Air Jordan chưa bao giờ thực sự bùng nổ như thế này trước đây, và đã đến lúc để mọi người phải trầm trồ. Được giới thiệu tại triển lãm “Paris 3020.” của nghệ sĩ đương đại Daniel Arsham, đây là mọi thứ bạn cần biết về đôi Jordan 1 High Dior mới nhất của Kim Jones.</p>\r\nMàu sắc hoàn hảo, Jordan 1 High Dior được sơn trong một bảng màu trắng và xám – cụ thể hơn là “Dior Grey”, một màu chỉ được sử dụng bởi nhà tạo mốt Paris. Thương hiệu “Air Dior” nổi bật ở lưỡi và gót, nơi bạn cũng sẽ tìm thấy họa tiết bóng rổ có cánh mang tính biểu tượng được chạm khắc nổi. Dọc theo các mặt bên và mặt giữa, một logo Swoosh có dây buộc thanh lịch lướt qua như một sự tôn kính đối với mẫu giày B-23 của thương hiệu quý phái, chúng mang tính biểu tượng theo đúng nghĩa.</p>\r\nCác lỗ cổ điển được đục lỗ trên mũi giày để mang lại trải nghiệm thông khí tuyệt vời và bên dưới là nơi bạn sẽ tìm thấy đế giữa Air huyền thoại mang đến sự thoải mái và lớp đệm ảo. Để hoàn thiện công trình nghệ thuật, chi tiết đồng thương hiệu được in khắp phần dưới của mỗi đôi giày, được trình bày qua đế ngoài bằng cao su màu xanh băng giá trong suốt giống như một tác phẩm nghệ thuật trong bảo tàng.</p>\r\nSố lượng sản xuất giới hạn chỉ 4.700 đôi, ám chỉ sự ra mắt của Christian Dior’s New Look vào năm 1947, Dior x Jordan 1 High là một đôi giày không giống bất cứ thứ gì khác ngoài thị trường. Nếu bạn là một tay chơi đẳng cấp, hay là một tín đồ thời trang chính hiệu, hãy nhanh tay đặt ngay cho mình một đôi trước khi chúng biến mất khỏi thị trường.\r\n</p>', 230000000, 'images/BMjSFOdBagQMQqhOoy9vUBQW1MzlxBrrTIJrhNOl.webp', 'available', 2, 0, NULL, '2024-11-15 07:30:22', '2024-11-15 07:40:26'),
(11, 2, 'Giày Spider-Man × Nike Air Jordan 1 Retro High OG SP ‘Next Chapter’', '<p>Giày Spider-Man × Nike Air Jordan 1 Retro High OG SP ‘Next Chapter’ DV1748-601 là một sản phẩm độc đáo được Nike phát hành nhân kỷ niệm 1 năm của bộ phim Spider-Man: Into the Spider-Verse. Được thiết kế bởi giám đốc sáng tạo của phim, Peter Ramsey, và tay đua xe đạp BMX người Mỹ-Pháp, Thibaut Grevet, bộ sản phẩm này là một sự kết hợp độc đáo giữa hai thương hiệu lừng danh.</p>\r\nVới màu đỏ chủ đạo của Jordan 1, giày cũng được trang trí bằng các chi tiết màu xanh lá cây và xanh dương, cùng với đường viền trắng phản chiếu ánh sáng trong bóng tối. Đặc biệt, logo của Spider-Man được in trên đế giày, đem lại sự tinh tế và độc đáo cho sản phẩm.</p>\r\nGiày Spider-Man × Nike Air Jordan 1 Retro High OG SP ‘Next Chapter’ DV1748-601 được làm từ chất liệu da cao cấp, đảm bảo độ bền và thoải mái khi sử dụng. Với kiểu dáng hiện đại và trẻ trung, giày là sự kết hợp hoàn hảo giữa phong cách và sự độc đáo của Spider-Man và thương hiệu Nike.</p>\r\nBộ sản phẩm có một bộ đôi giày cùng hộp đựng được trang trí bằng hình ảnh Spider-Man, tạo nên một món quà tuyệt vời cho các fan của phim hoặc những người yêu thích giày sneaker độc đáo.</p>', 5690000, 'images/cphm6WjzTMIu0Kd7FiAHQcRHRTlNdltG352J2nDi.webp', 'available', 9, 0, NULL, '2024-11-15 07:35:27', '2024-11-26 08:21:58'),
(12, 4, 'Giày New Balance 550 ‘White Team Red\'', '<p>New Balance là một thương hiệu thời trang và giày thể thao từ Mỹ. Hơn 100 năm qua, New Balance luôn tìm hiểu nhu cầu của những vận động viên để đầu tư, thiết kế những sản phẩm phù hợp. New Balance luôn tập trung đến từng chuyển động của cơ thể con người để có thể “Tạo-Ra-Điều-Tuyệt-Vời” (Making Excellent Happen)!</p>', 4090000, 'images/GBV4jjT6pIazVOCYiVUsbsSQKglStHXANTPXwaDA.webp', 'available', 4, 0, NULL, '2024-11-15 07:37:41', '2024-11-27 05:17:35'),
(13, 2, 'hihi', '12', 12345, 'images/emlN9rviy3G4c4J4pmXHuDXtxRmxEJVxnm8JqgiS.webp', 'available', 0, 0, '2024-11-26 08:42:01', '2024-11-26 08:39:43', '2024-11-26 08:42:01'),
(14, 3, 'ahihi', '23', 2222, 'images/MGpm1GynoJfvjjoEatEcXwlXBOHz7FbXrb8XEkXe.webp', 'available', 0, 0, '2024-11-26 08:42:52', '2024-11-26 08:42:49', '2024-11-26 08:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'album-images/iWV4pStq5p0dvfW2HjZDtvxvhlkRL4E4BsDQufjZ.webp', NULL, '2024-11-15 07:02:26', '2024-11-15 07:02:26'),
(2, 1, 'album-images/Doi4kgloFwTi6wjGtmgONRePw1V7YIAh7iFuiKAb.webp', NULL, '2024-11-15 07:02:26', '2024-11-15 07:02:26'),
(3, 1, 'album-images/9wKJedNob7h8QhRXB9FFGayyeXyJPwtRpMMKu4tr.webp', NULL, '2024-11-15 07:02:26', '2024-11-15 07:02:26'),
(4, 1, 'album-images/A4Gs5XMuPv2NlL9chDo1QtTu9VgBcDajQAhLpo3e.webp', NULL, '2024-11-15 07:02:26', '2024-11-15 07:02:26'),
(5, 2, 'album-images/oHjiKfyPFPadTKtyFBnaCml2CuYetFeoyukI5zKR.webp', NULL, '2024-11-15 07:04:57', '2024-11-15 07:04:57'),
(6, 2, 'album-images/rjHLhnQ6uEIgFzfho8shypYq7Fd1aeaQSG91MWCa.webp', NULL, '2024-11-15 07:04:57', '2024-11-15 07:04:57'),
(7, 2, 'album-images/iG7Fh2MCpAzH17Fd2LpaDrcgvs22qHaUyqh3vkLs.webp', NULL, '2024-11-15 07:04:57', '2024-11-15 07:04:57'),
(8, 2, 'album-images/R9LOnafLE85lnHhoLfODyPbE9HEIApoY0WpYaMrW.webp', NULL, '2024-11-15 07:04:57', '2024-11-15 07:04:57'),
(9, 2, 'album-images/nkvlfDphtKqbP8m32dZF9E10MAvDNctuhlsRtoGZ.webp', NULL, '2024-11-15 07:04:57', '2024-11-15 07:04:57'),
(10, 3, 'album-images/2JWexnSfn74LVe9Y8OOvI2AwVqEOSWUR0hE2c0sc.webp', NULL, '2024-11-15 07:07:38', '2024-11-15 07:07:38'),
(11, 3, 'album-images/DzVtnDKbuF33ui00E5RKdjJvHoQcaGacexnW0Ra4.webp', NULL, '2024-11-15 07:07:39', '2024-11-15 07:07:39'),
(12, 3, 'album-images/d8QJcf7E3Nu2zGckAozb4IqgEjjaxSgTblX5OL6o.webp', NULL, '2024-11-15 07:07:39', '2024-11-15 07:07:39'),
(13, 3, 'album-images/KkSDzYylzj5VP9hvq9cmqPh7ovyXnbSLHF9WTSAW.webp', NULL, '2024-11-15 07:07:39', '2024-11-15 07:07:39'),
(14, 3, 'album-images/GqMLNj1o4e58BhVBxQFVtXymF3acoZ9sK0cYzxAF.webp', NULL, '2024-11-15 07:07:39', '2024-11-15 07:07:39'),
(15, 4, 'album-images/JKJwzh3K7R1Uo0XN8g8SNDn8Uk8KYPFof0AgGACq.webp', NULL, '2024-11-15 07:10:53', '2024-11-15 07:10:53'),
(16, 5, 'album-images/nkxMTVbGKgT82RpfDxkBhUONXZ6VIbaX20tha3I1.webp', NULL, '2024-11-15 07:14:28', '2024-11-15 07:14:28'),
(17, 5, 'album-images/7dHaojj2ZbrV8H6aaPLy7n352Kq1PFaD4evfBxWK.webp', NULL, '2024-11-15 07:14:28', '2024-11-15 07:14:28'),
(18, 5, 'album-images/8gV6AfXmAn8gr5xk2kAE9Mum3jbfKWUiCkPzamIU.webp', NULL, '2024-11-15 07:14:28', '2024-11-15 07:14:28'),
(19, 5, 'album-images/3zf5kK3rCUYB6ED5OqzImXBQ0VrLXHC6fmUFdQNo.webp', NULL, '2024-11-15 07:14:28', '2024-11-15 07:14:28'),
(20, 5, 'album-images/qK3bdNroBRJBs2VbKRejSMtOmKBGglWlH6A4GxIQ.webp', NULL, '2024-11-15 07:14:28', '2024-11-15 07:14:28'),
(21, 6, 'album-images/QDFpUSEKLqMnSnC7owABdRCcc1FFZDP71eHgG5pD.webp', NULL, '2024-11-15 07:17:26', '2024-11-15 07:17:26'),
(22, 6, 'album-images/4ic9KrGVPFHON5SLqLGuGfENiFV1ax5lIrgl8kan.webp', NULL, '2024-11-15 07:17:26', '2024-11-15 07:17:26'),
(23, 6, 'album-images/n2jCa7v2dPLCLxpRRSI0Y6Y1irkIWtsng16TMcmv.webp', NULL, '2024-11-15 07:17:26', '2024-11-15 07:17:26'),
(24, 6, 'album-images/B6GLxw8Jzgxzxhm7hqtOCcokC85IZ8UdjMj6pWpy.webp', NULL, '2024-11-15 07:17:26', '2024-11-15 07:17:26'),
(25, 7, 'album-images/ip83fCKjMMeSJRvaczfGyjoshogIwlOmn4Re2KA7.webp', NULL, '2024-11-15 07:20:13', '2024-11-15 07:20:13'),
(26, 7, 'album-images/QihFmPGXz6fhy6K69wHuvPb8xcsGdmKIRItKp6P2.webp', NULL, '2024-11-15 07:20:13', '2024-11-15 07:20:13'),
(27, 7, 'album-images/gb5MkJaXJyIuqpq3IQzzZM3d3OaOlNoWxgmvYc7k.webp', NULL, '2024-11-15 07:20:13', '2024-11-15 07:20:13'),
(28, 7, 'album-images/qhD4bS4W1c7JmXNLXfoIoW26L4uEb9MQf0xGw3dh.webp', NULL, '2024-11-15 07:20:13', '2024-11-15 07:20:13'),
(29, 8, 'album-images/IV7WfLT41J8BCVdtTh9kp44i5JXCDgQNLLIwRjOB.webp', NULL, '2024-11-15 07:23:11', '2024-11-15 07:23:11'),
(30, 8, 'album-images/XcWw2NYOgj5j4knSAitAvYU3EXgbCqSKdqgmwWIM.webp', NULL, '2024-11-15 07:23:11', '2024-11-15 07:23:11'),
(31, 8, 'album-images/klr67mb7ij7NDguDTi8lDvFpktFtGXB5SRsqVEOd.webp', NULL, '2024-11-15 07:23:11', '2024-11-15 07:23:11'),
(32, 8, 'album-images/NTUfMcPKo129CZ2GryXxxvQfxUhds9FlO6fN0uLo.webp', NULL, '2024-11-15 07:23:11', '2024-11-15 07:23:11'),
(33, 9, 'album-images/Rua5IyKfrbvx1wkKuyHc1n195JlsHtjjJcfNAPZf.webp', NULL, '2024-11-15 07:25:59', '2024-11-15 07:25:59'),
(34, 9, 'album-images/PtoBq7WJrBCrEhnxhCkf8Wy8JpylPhTXeoxRViit.webp', NULL, '2024-11-15 07:25:59', '2024-11-15 07:25:59'),
(35, 9, 'album-images/or5Lqmy0s8ywFS3MYO7f7HSICwOiW3b64BuDPcdi.webp', NULL, '2024-11-15 07:25:59', '2024-11-15 07:25:59'),
(36, 10, 'album-images/B1fXUlSIeBgUwnPepIrxwUaiVSwDKgwiKMud5SAF.webp', NULL, '2024-11-15 07:30:22', '2024-11-15 07:30:22'),
(37, 10, 'album-images/Inqwcb1nFDmKjtKfJGFOGWFUZgsV0qmXLRmiYksQ.webp', NULL, '2024-11-15 07:30:22', '2024-11-15 07:30:22'),
(38, 10, 'album-images/Zh0TT3XS382GNXf27D686OizuDGfCZFg4uR7DQcD.webp', NULL, '2024-11-15 07:30:22', '2024-11-15 07:30:22'),
(39, 11, 'album-images/C99fsXe0up8SYxWqspXWtgjkc7tydzFufz66Erd7.webp', NULL, '2024-11-15 07:35:27', '2024-11-15 07:35:27'),
(40, 11, 'album-images/yOebQSkFIvLAS86BUs61qqiJdMmPvh1pp4la8pfW.webp', NULL, '2024-11-15 07:35:27', '2024-11-15 07:35:27'),
(41, 11, 'album-images/R1CZBm7eISk4BrCOIx36lSfXqzfI171xoWc1CjaK.webp', NULL, '2024-11-15 07:35:27', '2024-11-15 07:35:27'),
(42, 11, 'album-images/4ZQSVsxnfwBrAV1zkVPLRGI0o07CTZlSqaCtuHaq.webp', NULL, '2024-11-15 07:35:27', '2024-11-15 07:35:27'),
(43, 11, 'album-images/F4diZT1Hc6Ri96mf5Bvq7wc4qU2ljY0qneJdp9D5.webp', NULL, '2024-11-15 07:35:27', '2024-11-15 07:35:27'),
(44, 12, 'album-images/ASTQFZFD4TwT7WPhoVitf6R6uawcN0Y4KHRv2m2z.webp', '2024-11-26 06:43:41', '2024-11-15 07:37:41', '2024-11-26 06:43:41'),
(45, 12, 'album-images/ASTQFZFD4TwT7WPhoVitf6R6uawcN0Y4KHRv2m2z.webp', '2024-11-26 06:43:41', '2024-11-15 07:37:41', '2024-11-26 06:43:41'),
(46, 12, 'album-images/ASTQFZFD4TwT7WPhoVitf6R6uawcN0Y4KHRv2m2z.webp', '2024-11-26 06:43:41', '2024-11-15 07:37:41', '2024-11-26 06:43:41'),
(47, 12, 'album-images/ASTQFZFD4TwT7WPhoVitf6R6uawcN0Y4KHRv2m2z.webp', '2024-11-26 06:43:41', '2024-11-15 07:37:41', '2024-11-26 06:43:41'),
(48, 12, 'album-images/ASTQFZFD4TwT7WPhoVitf6R6uawcN0Y4KHRv2m2z.webp', '2024-11-26 06:42:34', '2024-11-15 07:37:41', '2024-11-26 06:42:34'),
(49, 12, 'album-images/EtiFRsy0SUsgvIOVb7K0KNA3h1ulkY61bZxmPRgL.webp', '2024-11-26 06:43:41', '2024-11-26 06:42:34', '2024-11-26 06:43:41'),
(50, 12, 'album-images/GgOAMRW0dot7MaGKMokWh7YRSdK0iEom33rRDtS4.webp', '2024-11-26 06:43:41', '2024-11-26 06:42:34', '2024-11-26 06:43:41'),
(51, 12, 'album-images/UVrGT19moHdnVA687aI6iPPlEFwnQUQ7fvhIlyoJ.webp', '2024-11-26 06:43:41', '2024-11-26 06:42:34', '2024-11-26 06:43:41'),
(52, 12, 'album-images/t8JreNLYHLAiRnKr3hQyhMtctjiqdzBHu3iLH8LG.webp', '2024-11-26 06:43:41', '2024-11-26 06:42:34', '2024-11-26 06:43:41'),
(53, 12, 'album-images/ytDHLobNj9D0PZg2S3Zema6RAkBOBEY3N80n1Tzn.webp', '2024-11-26 06:43:41', '2024-11-26 06:42:34', '2024-11-26 06:43:41'),
(54, 12, 'album-images/c8m6CnIFvKIWj8e9k7v5Kd27mAN7GT15eRqEFhkr.webp', '2024-11-26 06:45:29', '2024-11-26 06:43:41', '2024-11-26 06:45:29'),
(55, 12, 'album-images/Cd4ZYOBxstn718ukj0GaLbN47IqfTL4WIypglZT2.webp', '2024-11-26 06:45:29', '2024-11-26 06:43:41', '2024-11-26 06:45:29'),
(56, 12, 'album-images/ABgAeImrrzBeuEubzDvnA5q8OsfEr4wcRdORV4aX.webp', '2024-11-26 06:45:29', '2024-11-26 06:43:41', '2024-11-26 06:45:29'),
(57, 12, 'album-images/XALrLQheKCj5656wQnYppJ56HY4eSql5SNbqALHI.webp', '2024-11-26 06:45:29', '2024-11-26 06:43:41', '2024-11-26 06:45:29'),
(58, 12, 'album-images/zitQre0VpKWKJu45T0i3OrWmV0rjgaSNF7TIAyNh.webp', '2024-11-26 06:45:29', '2024-11-26 06:43:41', '2024-11-26 06:45:29'),
(59, 12, 'album-images/Jnk5KRwFGDbN0YJrGAevpRQ8QboTfFF75O5ByWcD.webp', '2024-11-26 07:21:30', '2024-11-26 06:45:29', '2024-11-26 07:21:30'),
(60, 12, 'album-images/1TDNW4uFNCPwXmO4NpyDM9bNAXPqXY3dbqHiPPWT.webp', '2024-11-26 07:22:13', '2024-11-26 07:21:30', '2024-11-26 07:22:13'),
(61, 12, 'album-images/6KycgMRNz9bYy9Jq6baN2FGJGyIc3ql6AkHsbG4b.webp', '2024-11-26 07:22:13', '2024-11-26 07:21:30', '2024-11-26 07:22:13'),
(62, 12, 'album-images/6KSFu4PPpnW4xKAwFfvozgCCpEBNCOsaqOcQWmfH.webp', '2024-11-26 07:22:13', '2024-11-26 07:21:30', '2024-11-26 07:22:13'),
(63, 12, 'album-images/q1zHKRneGHrYpriu1OQyf7ZWkJZhVQ4wYAlchCMn.webp', '2024-11-26 07:22:13', '2024-11-26 07:21:30', '2024-11-26 07:22:13'),
(64, 12, 'album-images/G7xsCy5ja4E3ak0IoGXfplNWdHdkXtVGaL8gSCKl.webp', '2024-11-26 07:22:13', '2024-11-26 07:21:30', '2024-11-26 07:22:13'),
(65, 12, 'album-images/ybUfJeHzTh1bbkNY5EymeCX1Qe5O1iNR4vmPjV61.webp', '2024-11-26 07:22:40', '2024-11-26 07:22:13', '2024-11-26 07:22:40'),
(66, 12, 'album-images/nZsQLvP4ibylKR3fMxwj2GERPUALZyyuz1DwQvtt.webp', '2024-11-26 07:25:26', '2024-11-26 07:22:40', '2024-11-26 07:25:26'),
(67, 12, 'album-images/XfjlENMjRTZdz3JSPuiAUFwWm6fEdSON2FkoPOwn.webp', '2024-11-26 07:29:22', '2024-11-26 07:25:26', '2024-11-26 07:29:22'),
(68, 12, 'album-images/pzeuFvObFGfLyYJS696MbRXEE95ty5oTuC8glYMP.webp', '2024-11-26 07:32:02', '2024-11-26 07:29:22', '2024-11-26 07:32:02'),
(69, 12, 'album-images/cDcfBFVXD7giwQHGWFCKsY6ImyWJGF3ueNAFLMOU.webp', '2024-11-26 07:36:16', '2024-11-26 07:32:02', '2024-11-26 07:36:16'),
(70, 12, 'album-images/bZeOkCGnmeHWIlkdk2B3GvWX9S2SdPd2gSLTAqNn.webp', '2024-11-26 07:36:42', '2024-11-26 07:36:16', '2024-11-26 07:36:42'),
(71, 12, 'album-images/qhpNnUjzAnBMrxCfXv3mVS6T1OXO5taYH6VTnDRk.webp', '2024-11-26 07:39:44', '2024-11-26 07:36:42', '2024-11-26 07:39:44'),
(72, 12, 'album-images/GrBTDtfKRnYMh0H4xjeUDiSc4jPUK1BWhYkbXLAR.webp', '2024-11-26 07:49:37', '2024-11-26 07:39:44', '2024-11-26 07:49:37'),
(73, 12, 'album-images/EhK5eyR8lP83XGyzJ4ETIVxF8kNEBQ4207OBRoZj.webp', '2024-11-26 07:52:31', '2024-11-26 07:49:37', '2024-11-26 07:52:31'),
(74, 12, 'album-images/cUn1qz1SbverYccUaPalfCnVJj5L13HbWnndv70S.webp', '2024-11-26 07:53:39', '2024-11-26 07:52:31', '2024-11-26 07:53:39'),
(75, 12, 'album-images/EJDSgCPQjYl3lVBrmiuAbD3dexCztzAYa9lX61rD.webp', '2024-11-26 07:54:43', '2024-11-26 07:53:39', '2024-11-26 07:54:43'),
(76, 12, 'album-images/TMFXU9gZOGErbiRj7nDHwzkLFJkqGesjhg256Pb9.webp', '2024-11-26 07:58:12', '2024-11-26 07:54:43', '2024-11-26 07:58:12'),
(77, 12, 'album-images/lH6V9mLVOH3jM4dYpCxbm93C3I3FLKlk9IdTvkzz.webp', '2024-11-26 07:58:33', '2024-11-26 07:58:12', '2024-11-26 07:58:33'),
(78, 12, 'album-images/jrIG5cnm85sIahVNvAEwJNRyIk3Wg2SA7hjj1TI1.webp', '2024-11-26 08:01:44', '2024-11-26 07:58:33', '2024-11-26 08:01:44'),
(79, 12, 'album-images/qME3G3kH3hlpOWU8iZ9B4Fr2BJ6EM8XEUhJPQ3kV.webp', '2024-11-26 08:02:27', '2024-11-26 08:01:44', '2024-11-26 08:02:27'),
(80, 12, 'album-images/FI9kNLpxuATyQuKrmgLU2LcubTK26d0R2BkXFBY7.webp', '2024-11-26 08:02:48', '2024-11-26 08:02:27', '2024-11-26 08:02:48'),
(81, 12, 'album-images/SyREyGsa2P4MjODER1JfaM2KuRzFo9VaH3PruIvO.webp', '2024-11-26 08:28:54', '2024-11-26 08:02:48', '2024-11-26 08:28:54'),
(82, 12, 'album-images/BotJmaQAY3JfuBrz5Ro9eRIzWump4TK2lNGLomjI.webp', '2024-11-26 08:28:54', '2024-11-26 08:02:48', '2024-11-26 08:28:54'),
(83, 12, 'album-images/Nau6ykTR2CuvcSKrnVQPEepjmOw0pkggJgz86yff.webp', '2024-11-26 08:28:54', '2024-11-26 08:02:48', '2024-11-26 08:28:54'),
(84, 12, 'album-images/1VHJtwFw0vCGu7Kz7RGGje9TkSkDb3mxZtaa0Yjo.webp', '2024-11-26 08:28:54', '2024-11-26 08:02:48', '2024-11-26 08:28:54'),
(85, 12, 'album-images/KQYs42GooptGRiJwpeDmV2h52XU3H8tpuaU7pxQL.webp', '2024-11-26 08:28:54', '2024-11-26 08:02:48', '2024-11-26 08:28:54'),
(86, 12, 'album-images/8NNzU0wPa8KpQ2aMHNgVfKszuzx61A1ZnYtPsN8O.webp', NULL, '2024-11-26 08:30:41', '2024-11-26 08:30:41'),
(87, 12, 'album-images/t0Dc23nEL8HILOPbLnT2FpaDj5bdaSmECYVGJFxH.webp', NULL, '2024-11-26 08:30:41', '2024-11-26 08:30:41'),
(88, 12, 'album-images/eE8CS4NpDy1qbrJRUE5b3Eq1efTLFaNc9jl4Gl37.webp', NULL, '2024-11-26 08:30:41', '2024-11-26 08:30:41'),
(89, 12, 'album-images/WySdDNSlfYE0otxpBFPTYona2hFwKYXFQD3W5AcS.webp', NULL, '2024-11-26 08:30:41', '2024-11-26 08:30:41'),
(90, 12, 'album-images/pHc8PemUVFGRKxmFsX5VjduALWAucRAy1eoaM0Nm.webp', NULL, '2024-11-26 08:30:41', '2024-11-26 08:30:41'),
(91, 13, 'album-images/UwPHalzQ1OmcdRHROWYGYbe5i8WbMeFSGO8IoIQF.webp', '2024-11-26 08:42:01', '2024-11-26 08:39:43', '2024-11-26 08:42:01'),
(92, 14, 'album-images/PWM6J3AYuJ03PKZXoW25FwkyKFHJTSSniGCssOJE.webp', '2024-11-26 08:42:52', '2024-11-26 08:42:49', '2024-11-26 08:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `size_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `size_id`, `quantity`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10, NULL, '2024-11-15 07:02:26', '2024-11-15 07:02:26'),
(2, 1, 2, 22, NULL, '2024-11-15 07:02:26', '2024-11-15 07:02:26'),
(3, 1, 3, 42, NULL, '2024-11-15 07:02:26', '2024-11-15 07:02:26'),
(4, 1, 4, 12, NULL, '2024-11-15 07:02:26', '2024-11-15 07:02:26'),
(5, 2, 1, 12, NULL, '2024-11-15 07:04:57', '2024-11-15 07:04:57'),
(6, 2, 2, 17, NULL, '2024-11-15 07:04:57', '2024-11-15 07:04:57'),
(7, 2, 3, 22, NULL, '2024-11-15 07:04:57', '2024-11-15 07:04:57'),
(8, 3, 1, 11, NULL, '2024-11-15 07:07:38', '2024-11-15 07:07:38'),
(9, 3, 2, 22, NULL, '2024-11-15 07:07:38', '2024-11-15 07:07:38'),
(10, 3, 3, 21, NULL, '2024-11-15 07:07:38', '2024-11-15 07:07:38'),
(11, 3, 4, 23, NULL, '2024-11-15 07:07:38', '2024-11-15 07:07:38'),
(12, 4, 1, 12, NULL, '2024-11-15 07:10:53', '2024-11-15 07:10:53'),
(13, 4, 2, 22, NULL, '2024-11-15 07:10:53', '2024-11-15 07:10:53'),
(14, 4, 3, 32, NULL, '2024-11-15 07:10:53', '2024-11-15 07:10:53'),
(15, 4, 4, 24, NULL, '2024-11-15 07:10:53', '2024-11-15 07:10:53'),
(16, 5, 1, 11, NULL, '2024-11-15 07:14:28', '2024-11-15 07:14:28'),
(17, 5, 2, 21, NULL, '2024-11-15 07:14:28', '2024-11-15 07:14:28'),
(18, 5, 3, 22, NULL, '2024-11-15 07:14:28', '2024-11-15 07:14:28'),
(19, 5, 4, 21, NULL, '2024-11-15 07:14:28', '2024-11-15 07:14:28'),
(20, 6, 1, 23, NULL, '2024-11-15 07:17:26', '2024-11-15 07:17:26'),
(21, 6, 2, 22, NULL, '2024-11-15 07:17:26', '2024-11-15 07:17:26'),
(22, 6, 3, 24, NULL, '2024-11-15 07:17:26', '2024-11-15 07:17:26'),
(23, 6, 4, 42, NULL, '2024-11-15 07:17:26', '2024-11-15 07:17:26'),
(24, 7, 1, 33, NULL, '2024-11-15 07:20:13', '2024-11-15 07:20:13'),
(25, 7, 2, 21, NULL, '2024-11-15 07:20:13', '2024-11-15 07:20:13'),
(26, 7, 3, 23, NULL, '2024-11-15 07:20:13', '2024-11-15 07:20:13'),
(27, 8, 1, 11, NULL, '2024-11-15 07:23:11', '2024-11-15 07:23:11'),
(28, 8, 2, 23, NULL, '2024-11-15 07:23:11', '2024-11-15 07:23:11'),
(29, 8, 3, 23, NULL, '2024-11-15 07:23:11', '2024-11-15 07:23:11'),
(30, 8, 4, 44, NULL, '2024-11-15 07:23:11', '2024-11-15 07:23:11'),
(31, 9, 2, 22, NULL, '2024-11-15 07:25:59', '2024-11-15 07:25:59'),
(32, 9, 3, 24, NULL, '2024-11-15 07:25:59', '2024-11-15 07:25:59'),
(33, 9, 4, 24, NULL, '2024-11-15 07:25:59', '2024-11-15 07:25:59'),
(34, 10, 2, 22, NULL, '2024-11-15 07:30:22', '2024-11-15 07:30:22'),
(35, 10, 3, 23, NULL, '2024-11-15 07:30:22', '2024-11-15 07:30:22'),
(36, 10, 4, 42, NULL, '2024-11-15 07:30:22', '2024-11-15 07:30:22'),
(37, 11, 1, 12, NULL, '2024-11-15 07:35:27', '2024-11-15 07:35:27'),
(38, 11, 2, 22, NULL, '2024-11-15 07:35:27', '2024-11-15 07:35:27'),
(39, 11, 3, 12, NULL, '2024-11-15 07:35:27', '2024-11-15 07:35:27'),
(40, 12, 1, 13, NULL, '2024-11-15 07:37:41', '2024-11-26 08:31:23'),
(41, 12, 2, 22, NULL, '2024-11-15 07:37:41', '2024-11-26 08:31:23'),
(42, 12, 3, 21, NULL, '2024-11-15 07:37:41', '2024-11-26 08:31:23'),
(43, 12, 4, 15, NULL, '2024-11-15 07:37:41', '2024-11-26 08:31:23'),
(44, 13, 2, 2, '2024-11-26 08:42:01', '2024-11-26 08:39:43', '2024-11-26 08:42:01'),
(45, 13, 3, 2, '2024-11-26 08:42:01', '2024-11-26 08:39:43', '2024-11-26 08:42:01'),
(46, 14, 1, 22, '2024-11-26 08:42:52', '2024-11-26 08:42:49', '2024-11-26 08:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint UNSIGNED NOT NULL,
  `size` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 39, NULL, '2024-11-15 07:00:36', '2024-11-15 07:00:36'),
(2, 40, NULL, '2024-11-15 07:00:40', '2024-11-15 07:00:40'),
(3, 41, NULL, '2024-11-15 07:00:44', '2024-11-15 07:00:44'),
(4, 42, NULL, '2024-11-15 07:00:48', '2024-11-15 07:00:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','deactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `roll` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `status`, `roll`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin123@a.com', '$2y$12$cNkGickpkw8g/xeI7xzEM./NTbMNHydMwZdiifyJt6Yrnjl.MF4jG', 'active', 'admin', NULL, '2024-11-15 06:28:48', '2024-11-15 06:28:48'),
(2, 'Bố mày đây', 'a@gmail.com', '$2y$12$2OSMrWGWKfOCS4yyRCt.2uGSaWovj/2fq3pWJMN.30zt4TLdXh5q6', 'active', 'user', NULL, '2024-11-15 07:42:41', '2024-11-26 13:32:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_variant_id_foreign` (`variant_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`),
  ADD KEY `product_variants_size_id_foreign` (`size_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_items_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_variants_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
