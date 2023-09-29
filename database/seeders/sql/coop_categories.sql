SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `coop_categories` (`id`, `Name`, `AEPA_order`, `EI_order`, `OMNIA_order`, `KINETIC_order`) VALUES
(1, 'Water-Resistant Roofing', 1, NULL, 1, NULL),
(2, 'Insulation', 2, 2, 2, NULL),
(3, 'Roof Tiles and Shingles', 3, 3, 3, NULL),
(4, 'Roofing and Roof Restoration', 4, 4, 4, NULL),
(5, 'Single-ply roofing repairs (CSPE, PVC, and EPDM)', 5, NULL, NULL, NULL),
(6, 'Masonry', 6, 5, 5, NULL),
(7, 'Metal Work', 7, 6, 6, NULL),
(8, 'Woodwork', 8, 7, 7, NULL),
(9, 'Roof Specialties and Accessories', 10, 9, 9, NULL),
(10, 'Roof Services', 11, 10, 10, NULL),
(11, 'Value Add', 12, NULL, 13, NULL),
(12, 'California Legislation Lines', 13, NULL, 12, NULL),
(13, 'Service / Labor', 14, NULL, NULL, NULL),
(14, 'F2 Table', 15, NULL, NULL, NULL),
(15, 'Civil Restoration', NULL, 1, NULL, NULL),
(16, 'Standing Seam Metal Roof System (SSMRS)', 9, 8, 8, NULL),
(17, 'Additional and Occasional Services', NULL, 11, NULL, NULL),
(18, 'Photovoltaic', NULL, 12, NULL, NULL),
(19, 'Green Sustainable Roofing', NULL, 13, NULL, NULL),
(20, 'Drainage Layer', NULL, 14, NULL, NULL),
(21, 'Landscape Plants, Sedums', NULL, 15, NULL, NULL),
(22, 'Professional Service Fees: Green Roof', NULL, 16, NULL, NULL),
(23, 'Green Roofing Maintenance', NULL, 17, NULL, NULL),
(24, 'Vegetated Roof Warranty', NULL, 18, NULL, NULL),
(25, 'Roofing Multipliers', NULL, 19, NULL, NULL),
(26, 'CAN-AM Services', NULL, 20, NULL, NULL),
(27, 'General Cost Factors', NULL, NULL, 11, NULL),
(28, 'Pure Air Services', NULL, 21, NULL, NULL);

ALTER TABLE `coop_categories`
  ADD KEY `Category` (`Name`);

COMMIT;
