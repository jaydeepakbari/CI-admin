CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `group` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `is_json` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `settings` (`id`, `group`, `key`, `value`, `is_json`) VALUES
(1, 'site', 'title', 'CI Admin', 0),
(2, 'site', 'footer_copyright', 'Copyright@2020', 0),
(3, 'site', 'google_analytics', '', 0),
(5, 'site', 'logo_white', '/logo/logo.png', 0),
(6, 'site', 'logo_black', '/logo/logo-black.png', 0);

ALTER TABLE `settings` ADD PRIMARY KEY (`id`);
ALTER TABLE `settings` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;