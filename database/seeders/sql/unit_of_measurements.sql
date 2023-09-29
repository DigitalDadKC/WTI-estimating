SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `unit_of_measurements` (`id`, `UOM`) VALUES
(2, '%'),
(12, '% of O/P'),
(14, '$'),
(11, 'BF'),
(16, 'CFM'),
(5, 'Day'),
(3, 'Each'),
(19, 'Gal'),
(9, 'Hour'),
(4, 'LF'),
(8, 'Mile'),
(18, 'Month'),
(10, 'Multiplier'),
(6, 'Project'),
(13, 'Set'),
(1, 'SF'),
(7, 'Unit'),
(15, 'Watt'),
(17, 'Week');

ALTER TABLE `unit_of_measurements`
  ADD KEY `UOM` (`UOM`) USING BTREE;

ALTER TABLE `unit_of_measurements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;