<?php 

// Zugzwang Project
// Copyright (c) 2014-2015, 2018-2019, 2022-2023 Gustaf Mossakowski <gustaf@koenige.org>
// Database form 'phylogeography'


require_once __DIR__.'/../zzbrick_tables/phylogeography.php';

$zz['geo_map_html'] = '<div id="map" class="smallmap" style="height: 580px;"> </div>';

$sql = 'SELECT symbol_id, identifier AS id
	FROM /*_PREFIX_*/symbols';
$symbols = wrap_db_fetch($sql, 'symbol_id');
wrap_setting_add('kml_styles', [
	'id' => 'default',
	'href' => 'https://'.wrap_setting('hostname').'/_layout/zzform/map/blue-dot.png'
]);
foreach ($symbols as $symbol) {
	wrap_setting_add('kml_styles', [
		'id' => $symbol['id'],
		'href' => 'https://'.wrap_setting('hostname').'/_layout/carabidae/symbols/'.$symbol['id'].'.png',
		'pos_x' => 0.5,
		'pos_y' => 0.5
	]);
}

$zz['filter'][1]['title'] = 'Datasource';
$zz['filter'][1]['sql'] = 'SELECT DISTINCT datasource_id, datasource
	FROM /*_PREFIX_*/phylogeography
	LEFT JOIN /*_PREFIX_*/datasources USING (datasource_id)
	ORDER BY datasource';
$zz['filter'][1]['identifier'] = 'datasources';
$zz['filter'][1]['type'] = 'list';
$zz['filter'][1]['field_name'] = 'datasource_id';
$zz['filter'][1]['where'] = 'datasource_id';

$zz['filter'][2]['title'] = 'Sets';
$zz['filter'][2]['sql'] = 'SELECT DISTINCT sets, sets
	FROM /*_PREFIX_*/phylogeography
	ORDER BY sets';
$zz['filter'][2]['identifier'] = 'sets';
$zz['filter'][2]['type'] = 'like';
$zz['filter'][2]['field_name'] = 'sets';
$zz['filter'][2]['where'] = 'sets';
$zz['filter'][2]['selection']['NULL'] = '- none -';

$zz['geo_map_head'] = 'leaflet-head';
$zz['geo_map_html'] = 'zzform-phylo-map';
$zz['geo_map_export'] = 'geojson';

$zz['export'][] = 'GeoJSON';
