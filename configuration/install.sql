/**
 * carabidae module
 * SQL for installation
 *
 * Part of »Zugzwang Project«
 * https://www.zugzwang.org/modules/carabidae
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2023 Gustaf Mossakowski
 * @license http://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 */


-- datasources --
CREATE TABLE `datasources` (
  `datasource_id` int unsigned NOT NULL AUTO_INCREMENT,
  `datasource` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`datasource_id`),
  UNIQUE KEY `datasource` (`datasource`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- phylogeography --
CREATE TABLE `phylogeography` (
  `phylogeography_id` int unsigned NOT NULL AUTO_INCREMENT,
  `datasource_id` int unsigned NOT NULL,
  `index_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `species_id` int unsigned NOT NULL,
  `country_id` int unsigned NOT NULL,
  `region` varchar(63) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locality` varchar(63) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL,
  `symbol_id` int unsigned DEFAULT NULL,
  `sets` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`phylogeography_id`),
  KEY `datasource_id` (`datasource_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'datasources', 'datasource_id', (SELECT DATABASE()), 'phylogeography', 'phylogeography_id', 'datasource_id', 'no-delete');
INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'species', 'species_id', (SELECT DATABASE()), 'phylogeography', 'phylogeography_id', 'species_id', 'no-delete');
INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'countries', 'country_id', (SELECT DATABASE()), 'phylogeography', 'phylogeography_id', 'country_id', 'no-delete');
INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'symbols', 'symbol_id', (SELECT DATABASE()), 'phylogeography', 'phylogeography_id', 'symbol_id', 'no-delete');


-- species --
CREATE TABLE `species` (
  `species_id` int unsigned NOT NULL AUTO_INCREMENT,
  `species` varchar(31) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_species_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`species_id`),
  UNIQUE KEY `species` (`species`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- symbols --
CREATE TABLE `symbols` (
  `symbol_id` int unsigned NOT NULL AUTO_INCREMENT,
  `species_id` int unsigned DEFAULT NULL,
  `symbol` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifier` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  PRIMARY KEY (`symbol_id`),
  UNIQUE KEY `symbol` (`symbol`),
  KEY `species_id` (`species_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
