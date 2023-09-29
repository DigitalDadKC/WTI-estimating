SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `guidelines` (`id`, `guideline`, `user_id`, `created_at`, `updated_at`) VALUES
(62, 'RS MEANS - don\'t use any multipliers (O/P, General Conditions, etc)', 1, '2023-07-07 22:40:16', '2023-07-07 22:40:16'),
(98, 'LIPs cannot be future-dated', 1, '2023-08-13 23:57:08', '2023-08-13 23:57:08'),
(99, 'CS&W products need a quote from supplier and estimators will treat like a subcontractor on the Cost Model', 1, '2023-08-14 19:52:59', '2023-08-14 19:52:59'),
(100, 'PROJECT AWARDS - Anything over $10k and NOT a PO or Contract (i.e. NTP, signed proposal, or email authorization) requires approval from Cindy Vizmeg', 1, '2023-08-17 21:16:08', '2023-08-17 21:16:08'),
(101, 'TC - When TC is below quote, send back to Donna Napier (TC department) for re-quoting', 1, '2023-08-31 20:47:12', '2023-08-31 21:09:42'),
(102, 'E&I - Need Rooftec Line', 1, '2023-09-09 19:30:06', '2023-09-09 19:30:06'),
(103, 'E&I - Need PUMA Line', 1, '2023-09-09 19:30:13', '2023-09-09 19:30:13'),
(104, 'AEPA - cannot use mob/demob lines from RS Means', 1, '2023-09-12 23:21:27', '2023-09-12 23:21:27'),
(112, 'TOPS - 2% coop fee', 1, '2023-09-22 03:27:00', '2023-09-22 03:27:00'),
(114, 'MYOLI - Use Inspection line with 4 roofs inspected/day.', 1, '2023-09-22 20:58:46', '2023-09-22 20:58:46');

ALTER TABLE `guidelines`
  ADD KEY `guidelines_user_id_foreign` (`user_id`);

ALTER TABLE `guidelines`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

COMMIT;