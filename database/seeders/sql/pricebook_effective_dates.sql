SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `pricebook_effective_dates` (`id`, `fk_coop`, `date`, `created_at`, `updated_at`) VALUES
(1, NULL, '2023-06-01', NULL, NULL),
(2, NULL, '2023-03-01', NULL, NULL),
(3, 2, '2023-08-15', NULL, NULL),
(4, 2, '2023-01-01', NULL, NULL),
(5, 3, '2023-08-15', NULL, NULL),
(6, 3, '2023-01-01', NULL, NULL),
(7, 1, '2023-08-01', NULL, NULL),
(8, 1, '2023-01-01', NULL, NULL),
(9, 5, '2023-08-01', NULL, NULL),
(10, 5, '2023-01-01', NULL, NULL);

ALTER TABLE `pricebook_effective_dates`
  ADD KEY `pricebook_effective_dates_fk_coop_foreign` (`fk_coop`);


ALTER TABLE `pricebook_effective_dates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;