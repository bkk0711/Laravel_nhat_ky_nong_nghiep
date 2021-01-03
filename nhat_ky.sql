-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th1 03, 2021 lúc 05:24 PM
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
  `don_gia` float NOT NULL,
  `so_luong` decimal(10,0) NOT NULL,
  `id_htx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_giong`
--

INSERT INTO `tbl_giong` (`id`, `ten`, `nguon_goc`, `don_gia`, `so_luong`, `id_htx`) VALUES
(6, 'Lúa a cuốc', 'Việt Nam', 2000, '5000000', 2),
(7, 'Ba lá Nghệ An', 'Việt Nam', 3000, '2000', 2),
(8, 'Chiêm số 1', 'Việt Nam', 3000, '5999700', 2),
(9, 'Chiêm trắng', 'Việt Nam', 2000, '2999500', 2),
(10, 'Nếp cẩm', 'Việt Nam', 2500, '99000', 2);

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
(2, 'Hợp tác xã Bình Tân', '123321123', 2, 'Vĩnh Long', '126321451'),
(3, 'Hợp tác xã Tân Bình', '0123654', 10, 'Cà Mau', '027456987');

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
(6, 4, 2),
(8, 6, 2),
(9, 8, 2),
(10, 4, 3);

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
(2, 'Phân bón lá', 3),
(5, 'Phân Bón', 2),
(6, 'Thuốc Trừ Sâu', 2),
(7, 'Thuốc Cỏ', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_log_giong`
--

CREATE TABLE `tbl_log_giong` (
  `id` int(11) NOT NULL,
  `id_giong` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `ngay` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_thua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_log_giong`
--

INSERT INTO `tbl_log_giong` (`id`, `id_giong`, `id_user`, `so_luong`, `ngay`, `id_thua`) VALUES
(6, 10, 4, 300, '2021-01-01', 0),
(7, 10, 4, 20, '2021-01-01', 0),
(8, 10, 4, 10, '2021-01-01', 0),
(9, 10, 4, 200, '2020-12-29', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_log_lamdat`
--

CREATE TABLE `tbl_log_lamdat` (
  `id` int(11) NOT NULL,
  `ngay` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_thua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_log_lamdat`
--

INSERT INTO `tbl_log_lamdat` (`id`, `ngay`, `id_user`, `note`, `id_thua`) VALUES
(1, '2020-12-08', 3, 'Cày', 0),
(2, '2020-12-10', 3, 'Làm cỏ', 0),
(3, '2020-12-16', 6, 'Cày, bừa', 0),
(4, '2020-12-23', 3, 'Bón phân', 0),
(5, '2020-12-28', 4, 'Làm cỏ', 0),
(6, '2020-12-27', 4, 'Làm cỏ', 0),
(7, '2020-12-28', 4, 'làm cỏ', 0);

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
(5, '2021-01-01', 6, 4, 10);

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
(6, 2, 4, 1609254318),
(7, 2, 44, 1609254323),
(8, 2, 4, 1609254352),
(9, 3, 20, 1609333146),
(10, 4, 1000, 1609512456),
(11, 5, 300, 1609512468),
(12, 6, 500, 1609512478);

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
(3, 2, 20, 1609332989),
(5, 4, 20, 1609512301),
(6, 5, 5, 1609512323),
(7, 6, 30, 1609512345);

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
(2, 'Vụ Xuân - Hạ', '2021-01-01', '2021-06-24', 0, 2);

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
(2, 'NCC_01', 'Nhà thuốc Kim Liên', 'tân bình cà mau', '0123454854', 'ggggg.com', 'aaa@gmail.com', 3),
(5, 'NCC01', 'Nhà thuốc Vũ Minh', '646 NVC, Bình Minh, Vĩnh Long', '0123.23.23.32', '', 'bvtvvuminh@gmail.com', 2),
(6, 'NCC_02', 'Nhà Thuốc BVTV Cao Minh Tuấn', '401, Phan Xích Long, Quận Phú Nhuận, TPHCM', '086.852.8521', '', 'BVTVCaoMinhTuan@gmail.com', 2),
(7, 'NCC_03', 'nhà Phân Phối thuốc BVTV Cửu Long', '12 Sông Đốc , Cà Mau', '0869.555.888', '', 'BVTVCUULONG@gmail.com', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_thua`
--

CREATE TABLE `tbl_thua` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `dien_tich` decimal(10,0) NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_thua`
--

INSERT INTO `tbl_thua` (`id`, `id_user`, `dien_tich`, `ten`) VALUES
(3, 4, '6000', 'Thửa 3 khu tân bình');

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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Vũ Minh Luân', 'vuluan_admin@gmail.com', '0123.546.788', 1),
(2, 'vuluan', '124bd1296bec0d9d93c7b52a71ad8d5b', 'Vũ văn Luân', 'vuluan4545@gmail.com', '0869202851', 2),
(4, 'ND2', '124bd1296bec0d9d93c7b52a71ad8d5b', 'Nông dân 20', 'nd20@gmail.com', '0123652478', 3),
(6, 'Nd3', '124bd1296bec0d9d93c7b52a71ad8d5b', 'Nông Dân Số 03', 'nd3@gmail.com', '0123456789', 3),
(7, 'luan0147', '124bd1296bec0d9d93c7b52a71ad8d5b', 'Luân Vũ', 'vulan@gooasf.com', '012345679', 2),
(8, 'ND09', '124bd1296bec0d9d93c7b52a71ad8d5b', 'Nông Dân Số 09', 'nd09@gmail.com', '011236548', 3),
(10, 'khoidz', '124bd1296bec0d9d93c7b52a71ad8d5b', 'khoi', 'vuluan4545@gmail.com', '0869202851', 2);

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
(6, 5, 7, 'Thuốc trừ cỏ lúa PYANCHOR 3EC 400CC', '', '', 'phun cho lúa ở giai đoạn từ 8 - 20 ngày sau sạ hoặc cấy, với liều lượng 0,8 - 1 lít/ha, cũng có thể phun muộn hơn để diệt cỏ lồng vực đã lớn (cỏ có trên 7 lá) với liều sử dụng 1,2 - 1,4 lít/ha (tức pha 60 – 70 ml/bình 16 lít nước, phun 2 bình cho 1000 m2.', 'images/eICgn2iIydc3Q4NTKuigfR5J9RXrGzlzwThgoehE.jpeg', 2, 1609509566, 99980, 120000),
(7, 5, 6, 'Thuốc trừ sâu sinh học SU 35', 'Methylamine Avermectin 5,5%, phụ gia đặc biệt', 'Hoạt chất Methylamine Avermectin là thuốc tiếp xúc, lưu dẫn cực mạnh được nhiều công ty đăng ký với nhiều tên thương mại khác nhau để trừ: Sâu đục thân, sâu cuốn lá, sâu tơ, sâu đục quả, ròi đục trái, rầy, rệp, bọ trĩ,...', 'Dùng 5g thuốc trừ sâu sinh học SU 35 pha cho 16 - 20 lít nước. Lượng nước phun 400 lit/ ha. Phun thuốc khi sâu tuổi 1 - 2.', 'images/qaANIqf35XAL3o65R8M4g3fonKU4jbHHCanWy7Ws.jpeg', 2, 1609509691, 1970, 9000),
(8, 5, 5, 'Phân bón lá kích thích nảy mầm sinh trưởng Atonik 1.8 SL', '+ Sodium – S – Nitrogualacolate 0.03%\r\n\r\n+ Sodium – O – Nitrophenolate 0.06%\r\n\r\n+ Sodium – P – Nitrophenolate 0.09%', '', 'Pha loãng Atonik vào bình phun với tỷ lệ 10 ml trên 16 lít. Tương ứng 15 ml trên bình 25 lít.', 'images/aiMqC9OetKxk65ntqlMkpwHgB1TT709etryECD1J.jpeg', 2, 1609509951, 4995, 80000),
(9, 5, 6, 'ĐẶC TRỊ BỌ TRĨ - RỆP STUN 20SL', 'Imidacloprid: 200 g/L.', 'Rầy nâu, Bọ trĩ', 'Pha 15ml - 25ml/ bình 25 lít. Phun 400l - 500l/ ha. Phun khi rầy tuổi 1 - 2 hoặc bọ trĩ 10 con/ dảnh.', '', 2, 1609510417, 4000, 19.5);

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
(4, 10, 4, 1000, 1609512456, 2),
(5, 8, 6, 300, 1609512468, 2),
(6, 9, 8, 500, 1609512478, 2);

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
(4, 6, 4, 20, 1609512301, 2),
(5, 8, 6, 5, 1609512323, 2),
(6, 7, 8, 30, 1609512344, 2);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_htx`
--
ALTER TABLE `tbl_htx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_htx_member`
--
ALTER TABLE `tbl_htx_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_loai_vattu`
--
ALTER TABLE `tbl_loai_vattu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_log_giong`
--
ALTER TABLE `tbl_log_giong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `tbl_log_lamdat`
--
ALTER TABLE `tbl_log_lamdat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_log_vattu`
--
ALTER TABLE `tbl_log_vattu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_log_xuat_giong`
--
ALTER TABLE `tbl_log_xuat_giong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_log_xuat_vattu`
--
ALTER TABLE `tbl_log_xuat_vattu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_mua_vu`
--
ALTER TABLE `tbl_mua_vu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_nccvt`
--
ALTER TABLE `tbl_nccvt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_thua`
--
ALTER TABLE `tbl_thua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_vattu`
--
ALTER TABLE `tbl_vattu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `tbl_xuat_giong`
--
ALTER TABLE `tbl_xuat_giong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_xuat_vattu`
--
ALTER TABLE `tbl_xuat_vattu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
