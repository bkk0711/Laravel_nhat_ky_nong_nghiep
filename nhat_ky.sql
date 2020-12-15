-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th12 15, 2020 lúc 06:45 AM
-- Phiên bản máy phục vụ: 8.0.18
-- Phiên bản PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nhat_ky`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_htx`
--

CREATE TABLE `tbl_htx` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ma_so_thue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chu_nhiem` int(11) DEFAULT NULL,
  `dia_chi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `so_dien_thoai` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_htx`
--

INSERT INTO `tbl_htx` (`id`, `ten`, `ma_so_thue`, `chu_nhiem`, `dia_chi`, `so_dien_thoai`) VALUES
(1, 'Hợp Tác Xã Tân An', '012365241', 3, 'Tân An, Vĩnh Long', '0123.654.789'),
(2, 'Hợp Tác Xã Tân Bình', '012365241', 2, 'Tân An, Vĩnh Long', '0123.654.789');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_htx_member`
--

CREATE TABLE `tbl_htx_member` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_htx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_htx_member`
--

INSERT INTO `tbl_htx_member` (`id`, `id_user`, `id_htx`) VALUES
(1, 4, 1),
(2, 5, 1),
(3, 5, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_loai_vattu`
--

CREATE TABLE `tbl_loai_vattu` (
  `id` int(11) NOT NULL,
  `loai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_loai_vattu`
--

INSERT INTO `tbl_loai_vattu` (`id`, `loai`, `id_user`) VALUES
(1, 'Thuốc trừ sâu', 0),
(2, 'Thuốc trừ sâu', 0),
(3, 'Thuốc trừ sâu', 0),
(4, 'Thuốc trừ sâu', 0),
(6, 'TESST', 0),
(7, 'ABCDEF', 0),
(8, 'aaaaaaaaaa', 0),
(9, 'Thuốc trừ sâu', 0),
(10, 'sssss', 0),
(11, 'sssssssssss', 0),
(12, 'aaaaaaaaaaaaaaaaaaaa', 3),
(13, 'Thuốc Bảo vệ thực vật', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_nccvt`
--

CREATE TABLE `tbl_nccvt` (
  `id` int(11) NOT NULL,
  `MaNCC` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenNCC` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `DiaChi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `SDT` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_nccvt`
--

INSERT INTO `tbl_nccvt` (`id`, `MaNCC`, `TenNCC`, `DiaChi`, `SDT`, `Website`, `Email`, `id_user`) VALUES
(1, 'XUANHOA', 'Nhà Thuốc Xuân Hòa', '121 KV3 Ninh Kiều Cần Thơ', '', '', '', 0),
(2, 'NCC_BP', 'Cty TNHH phân bón Bích Phương', 'Cà Mau', '0123.256.851', '', 'pbbp@gmai.com', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdt` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `name`, `email`, `sdt`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Vũ Luân', 'vuluan@localhost', '0123456789', 1),
(2, 'htx', '124bd1296bec0d9d93c7b52a71ad8d5b', 'Vũ Luân', 'vuluan@localhost', '0123456789', 2),
(3, 'bkkhoi', '124bd1296bec0d9d93c7b52a71ad8d5b', 'Bùi Khôi', 'boylaboy8@gmail.com', '15034215214', 2),
(4, 'ND1', '124bd1296bec0d9d93c7b52a71ad8d5b', 'Noong Dan So 1', 'nd1@gmail.com', '0123.456.789', 3),
(5, 'ND2', '124bd1296bec0d9d93c7b52a71ad8d5b', 'Noong Dan So 2', 'nd2@gmail.com', '0123.456.789', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_vattu`
--

CREATE TABLE `tbl_vattu` (
  `id` int(11) NOT NULL,
  `id_ncc` int(11) NOT NULL,
  `loai` int(11) DEFAULT NULL,
  `ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hoat_chat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `doi_tuong` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hdsd` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `donvi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngay_nhap` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_vattu`
--

INSERT INTO `tbl_vattu` (`id`, `id_ncc`, `loai`, `ten`, `hoat_chat`, `doi_tuong`, `hdsd`, `img`, `id_user`, `donvi`, `ngay_nhap`) VALUES
(1, 1, 1, 'NANO BẠC', 'Nano Bạc 500 ppm, Phụ gia sinh học đặc biệt: Enzym Tricoderma, Enzym Bacillus', 'Đặc trị nấm Phytopthora, Fusarium', 'Pha 50ml Nano Bạc vào bình 16-25 lít nước hoặc 1 lít pha với 300 – 420 lít nước. Sau đó phun xịt ướt đều hai mặt lá tán cây, đổ gốc hoặc tưới.', 'images/F0baWxnPdSPnCIvDHaNq7wGC16uralFOjA0Wentd.jpeg', 3, 'ml', 1607865819);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_htx`
--
ALTER TABLE `tbl_htx`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_htx_member`
--
ALTER TABLE `tbl_htx_member`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_loai_vattu`
--
ALTER TABLE `tbl_loai_vattu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_nccvt`
--
ALTER TABLE `tbl_nccvt`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_vattu`
--
ALTER TABLE `tbl_vattu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_htx`
--
ALTER TABLE `tbl_htx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_htx_member`
--
ALTER TABLE `tbl_htx_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_loai_vattu`
--
ALTER TABLE `tbl_loai_vattu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `tbl_nccvt`
--
ALTER TABLE `tbl_nccvt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_vattu`
--
ALTER TABLE `tbl_vattu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
