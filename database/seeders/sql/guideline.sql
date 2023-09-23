SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `guidelines` (`id`, `guideline`, `user_id`, `created_at`, `updated_at`) VALUES
(62, 'RS MEANS - don\'t use any multipliers (O/P, General Conditions, etc)', 1, '2023-07-07 22:40:16', '2023-07-07 22:40:16'),
(98, 'LIPs cannot be future-dated', 1, '2023-08-13 23:57:08', '2023-08-13 23:57:08'),
(99, 'CS&W products need a quote from supplier and estimators will treat like a subcontractor on the Cost Model', 1, '2023-08-14 19:52:59', '2023-08-14 19:52:59'),
(100, 'PROJECT AWARDS - Anything over $10k and NOT a PO or Contract (i.e. NTP, signed proposal, or email authorization) requires approval from Cindy Vizmeg', 1, '2023-08-17 21:16:08', '2023-08-17 21:16:08'),
(188, 'AEPA - cannot use mob/demob lines from RS Means', 1, '2023-09-17 18:11:45', '2023-09-17 18:11:45'),
(189, 'E&I - Need PUMA Line', 1, '2023-09-17 18:12:06', '2023-09-17 18:12:06'),
(190, 'E&I - Need Rooftec Line', 1, '2023-09-17 18:12:42', '2023-09-17 18:12:42'),
(201, 'Tremcare - When TC is significantly below quote, send back to Donna Napier (TC department) for re-quoting', 1, '2023-09-17 18:21:18', '2023-09-21 20:19:11'),
(421, 'test', 1, '2023-09-21 21:53:46', '2023-09-21 21:53:46');

--
-- AUTO_INCREMENT for table `guidelines`
--
ALTER TABLE `guidelines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=422;
COMMIT;
