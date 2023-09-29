SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `coop_effective_dates` (`id`, `fk_coop`, `date`) VALUES
(1, 2, '2023-01-01'),
(2, 2, '2022-03-01'),
(3, 2, '2021-03-01'),
(4, 3, '2023-08-15'),
(5, 3, '2023-01-01'),
(6, 3, '2022-03-01'),
(7, 3, '2021-03-01'),
(8, 1, '2021-03-01'),
(9, 1, '2022-03-01'),
(10, 1, '2023-01-01');

ALTER TABLE `coop_effective_dates`
  ADD KEY `fk_coop` (`fk_coop`);

ALTER TABLE `coop_effective_dates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `coop_effective_dates`
  ADD CONSTRAINT `coop_effective_dates_ibfk_1` FOREIGN KEY (`fk_coop`) REFERENCES `cooperatives` (`id`);
COMMIT;
