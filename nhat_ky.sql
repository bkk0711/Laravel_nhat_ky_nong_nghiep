-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th12 30, 2020 lúc 12:46 PM
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
-- Cấu trúc bảng cho bảng `tbl_giong`
--

CREATE TABLE `tbl_giong` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nguon_goc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `don_gia` decimal(10,0) NOT NULL,
  `so_luong` decimal(10,0) NOT NULL,
  `id_htx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_giong`
--

INSERT INTO `tbl_giong` (`id`, `ten`, `nguon_goc`, `don_gia`, `so_luong`, `id_htx`) VALUES
(1, '504', 'Campuchia', '12000', '0', 1),
(2, 'Thơm Thái', 'Thái Lan', '1000', '122060', 1);

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
(1, 'Hợp tác xã Bình Minh', '012355214', 2, 'Bình Minh, Vĩnh Long', '012365478'),
(2, 'Hợp tác xã Ô MÔN', '21215454', 5, NULL, NULL);

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
(1, 3, 1),
(2, 4, 1),
(3, 6, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_loai_vattu`
--

CREATE TABLE `tbl_loai_vattu` (
  `id` int(11) NOT NULL,
  `loai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_htx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_loai_vattu`
--

INSERT INTO `tbl_loai_vattu` (`id`, `loai`, `id_htx`) VALUES
(1, 'Thuốc Trừ Sâu', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_log_giong`
--

CREATE TABLE `tbl_log_giong` (
  `id` int(11) NOT NULL,
  `id_giong` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `ngay` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_log_giong`
--

INSERT INTO `tbl_log_giong` (`id`, `id_giong`, `id_user`, `so_luong`, `ngay`) VALUES
(1, 1, 3, 2, '2020-12-08'),
(2, 1, 3, 1000, '2020-12-15'),
(3, 1, 3, 998998, '2020-12-15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_log_lamdat`
--

CREATE TABLE `tbl_log_lamdat` (
  `id` int(11) NOT NULL,
  `ngay` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_log_lamdat`
--

INSERT INTO `tbl_log_lamdat` (`id`, `ngay`, `id_user`, `note`) VALUES
(1, '2020-12-08', 3, 'Cày'),
(2, '2020-12-10', 3, 'Làm cỏ'),
(3, '2020-12-16', 6, 'Cày, bừa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_log_vattu`
--

CREATE TABLE `tbl_log_vattu` (
  `id` int(11) NOT NULL,
  `ngay` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_vattu` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_log_vattu`
--

INSERT INTO `tbl_log_vattu` (`id`, `ngay`, `id_vattu`, `id_user`, `so_luong`) VALUES
(1, '2020-12-10', 1, 3, 110),
(2, '2020-12-09', 1, 3, 12),
(3, '2020-12-15', 1, 3, 1),
(4, '2020-12-09', 1, 3, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_log_xuat_giong`
--

CREATE TABLE `tbl_log_xuat_giong` (
  `id` int(11) NOT NULL,
  `id_xuat` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_log_xuat_giong`
--

INSERT INTO `tbl_log_xuat_giong` (`id`, `id_xuat`, `so_luong`, `time`) VALUES
(1, 1, 100, 1609244094),
(2, 1, 100, 1609244118),
(3, 1, 99881, 1609244164),
(4, 1, 99880, 1609244169),
(5, 1, 800039, 1609244201),
(6, 2, 4, 1609254318),
(7, 2, 44, 1609254323),
(8, 2, 4, 1609254352);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_log_xuat_vattu`
--

CREATE TABLE `tbl_log_xuat_vattu` (
  `id` int(11) NOT NULL,
  `id_xuat` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_log_xuat_vattu`
--

INSERT INTO `tbl_log_xuat_vattu` (`id`, `id_xuat`, `so_luong`, `time`) VALUES
(1, 1, 100, 1609243305),
(2, 1, 20, 1609243324);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_mua_vu`
--

CREATE TABLE `tbl_mua_vu` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bat_dau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_thuc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `xong` int(11) NOT NULL,
  `id_htx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_mua_vu`
--

INSERT INTO `tbl_mua_vu` (`id`, `ten`, `bat_dau`, `ket_thuc`, `xong`, `id_htx`) VALUES
(1, 'Vụ Đông - Xuân', '2020-09-01', '2020-12-31', 0, 1);

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
  `id_htx` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_nccvt`
--

INSERT INTO `tbl_nccvt` (`id`, `MaNCC`, `TenNCC`, `DiaChi`, `SDT`, `Website`, `Email`, `id_htx`) VALUES
(1, 'BMA', 'Nhà thuốc Bình Minh A', '12A Bình Minh, Vĩnh Long', '0123654789', '', 'bma@gmail.com', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_thua`
--

CREATE TABLE `tbl_thua` (
  `id` int(11) NOT NULL,
  `id_htx` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `dien_tich` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Vũ Luân', 'admin@gmail.com', '0123.546.789', 1),
(2, 'vuluan', '124bd1296bec0d9d93c7b52a71ad8d5b', 'Vũ văn Luân', 'vuluan@gmail.com', '0123456789', 2),
(3, 'nd1', '124bd1296bec0d9d93c7b52a71ad8d5b', 'Nông Dân Số 1', 'nd1@gmail.com', '0123545678', 3),
(4, 'ND2', '124bd1296bec0d9d93c7b52a71ad8d5b', 'Nông dân 2', 'nd2@gmail.com', '0123654789', 3),
(5, 'khoidz', '124bd1296bec0d9d93c7b52a71ad8d5b', 'Khoi', 'khoidz@gmail.com', '0123456789', 2),
(6, 'Nd3', '124bd1296bec0d9d93c7b52a71ad8d5b', 'Nông Dân Số 3', 'nd3@gmail.com', '0123456789', 3);

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
  `id_htx` int(11) NOT NULL DEFAULT '0',
  `ngay_nhap` int(11) NOT NULL,
  `so_luong` int(11) DEFAULT '0',
  `don_gia` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_vattu`
--

INSERT INTO `tbl_vattu` (`id`, `id_ncc`, `loai`, `ten`, `hoat_chat`, `doi_tuong`, `hdsd`, `img`, `id_htx`, `ngay_nhap`, `so_luong`, `don_gia`) VALUES
(1, 1, 1, 'Thuốc TS 1', 'ãit', 'lúa 2-3 tháng tuổi', '2ml/lít nước', '', 1, 1609243291, 99880, 5000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_xuat_giong`
--

CREATE TABLE `tbl_xuat_giong` (
  `id` int(11) NOT NULL,
  `id_giong` int(11) NOT NULL,
  `id_nongdan` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `thoi_gian` int(11) NOT NULL,
  `id_htx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_xuat_giong`
--

INSERT INTO `tbl_xuat_giong` (`id`, `id_giong`, `id_nongdan`, `so_luong`, `thoi_gian`, `id_htx`) VALUES
(1, 1, 3, 1000000, 1609244094, 1),
(2, 2, 3, 52, 1609254317, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_xuat_vattu`
--

CREATE TABLE `tbl_xuat_vattu` (
  `id` int(11) NOT NULL,
  `id_vattu` int(11) NOT NULL,
  `id_nongdan` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `thoi_gian` int(11) NOT NULL,
  `id_htx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_xuat_vattu`
--

INSERT INTO `tbl_xuat_vattu` (`id`, `id_vattu`, `id_nongdan`, `so_luong`, `thoi_gian`, `id_htx`) VALUES
(1, 1, 3, 150, 1609243305, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_giong`
--
ALTER TABLE `tbl_giong`
  ADD PRIMARY KEY (`id`);

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
-- Chỉ mục cho bảng `tbl_log_giong`
--
ALTER TABLE `tbl_log_giong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_log_lamdat`
--
ALTER TABLE `tbl_log_lamdat`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_log_vattu`
--
ALTER TABLE `tbl_log_vattu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_log_xuat_giong`
--
ALTER TABLE `tbl_log_xuat_giong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_log_xuat_vattu`
--
ALTER TABLE `tbl_log_xuat_vattu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_mua_vu`
--
ALTER TABLE `tbl_mua_vu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_nccvt`
--
ALTER TABLE `tbl_nccvt`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_thua`
--
ALTER TABLE `tbl_thua`
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
-- Chỉ mục cho bảng `tbl_xuat_giong`
--
ALTER TABLE `tbl_xuat_giong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_xuat_vattu`
--
ALTER TABLE `tbl_xuat_vattu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_giong`
--
ALTER TABLE `tbl_giong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_log_giong`
--
ALTER TABLE `tbl_log_giong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_log_lamdat`
--
ALTER TABLE `tbl_log_lamdat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_log_vattu`
--
ALTER TABLE `tbl_log_vattu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_log_xuat_giong`
--
ALTER TABLE `tbl_log_xuat_giong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tbl_log_xuat_vattu`
--
ALTER TABLE `tbl_log_xuat_vattu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_mua_vu`
--
ALTER TABLE `tbl_mua_vu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_nccvt`
--
ALTER TABLE `tbl_nccvt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_thua`
--
ALTER TABLE `tbl_thua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_vattu`
--
ALTER TABLE `tbl_vattu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_xuat_giong`
--
ALTER TABLE `tbl_xuat_giong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_xuat_vattu`
--
ALTER TABLE `tbl_xuat_vattu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
