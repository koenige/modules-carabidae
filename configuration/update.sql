/**
 * carabidae module
 * SQL updates
 *
 * Part of »Zugzwang Project«
 * https://www.zugzwang.org/modules/carabidae
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2023 Gustaf Mossakowski
 * @license http://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 */


/* 2023-07-07-1 */	ALTER TABLE `symbols` ADD `species_id` int unsigned NULL AFTER `symbol_id`;
/* 2023-07-07-2 */	ALTER TABLE `symbols` ADD INDEX `species_id` (`species_id`);
/* 2023-07-07-3 */	INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'species', 'species_id', (SELECT DATABASE()), 'symbols', 'symbol_id', 'species_id', 'no-delete');
