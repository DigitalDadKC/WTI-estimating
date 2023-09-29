SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `material_statuses` (`id`, `Status`, `created_at`, `updated_at`) VALUES
(1, 'New', NULL, NULL),
(2, 'Active', NULL, NULL),
(3, 'Removed', NULL, NULL),
(4, 'Obsolete', NULL, NULL);

ALTER TABLE `material_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;