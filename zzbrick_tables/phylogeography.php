<?php 

// Zugzwang Project
// Copyright (c) 2013-2014, 2019, 2023 Gustaf Mossakowski <gustaf@koenige.org>
// Database table 'phylogeography'


$zz['title'] = 'Phylogeography';
$zz['table'] = '/*_PREFIX_*/phylogeography';

$zz['fields'][1]['title'] = 'ID';
$zz['fields'][1]['field_name'] = 'phylogeography_id';
$zz['fields'][1]['type'] = 'id';
$zz['fields'][1]['geojson'] = 'id';

$zz['fields'][11]['field_name'] = 'datasource_id';
$zz['fields'][11]['type'] = 'select';
$zz['fields'][11]['sql'] = 'SELECT datasource_id, datasource
	FROM /*_PREFIX_*/datasources
	ORDER BY datasource';
$zz['fields'][11]['display_field'] = 'datasource';
$zz['fields'][11]['hide_in_list'] = true;
$zz['fields'][11]['add_details'] = 'datasources';
$zz['fields'][11]['geojson'] = 'Datasource';

$zz['fields'][2]['field_name'] = 'index_no';
$zz['fields'][2]['kml_extendeddata'] = true;
$zz['fields'][2]['geojson'] = 'IndexNo';

$zz['fields'][3]['field_name'] = 'species_id';
$zz['fields'][3]['type'] = 'select';
$zz['fields'][3]['sql'] = 'SELECT species_id, species, parent_species_id
	FROM /*_PREFIX_*/species
	ORDER BY species';
$zz['fields'][3]['show_hierarchy'] = 'parent_species_id';
$zz['fields'][3]['display_field'] = 'species';
$zz['fields'][3]['search'] = 'CONCAT(IFNULL(CONCAT(parent_species.species, " "), ""), /*_PREFIX_*/species.species)';
$zz['fields'][3]['add_details'] = 'species';
$zz['fields'][3]['kml'] = 'title';
$zz['fields'][3]['geojson'] = 'title';

$zz['fields'][4]['title_tab'] = 'CC';
$zz['fields'][4]['field_name'] = 'country_id';
$zz['fields'][4]['type'] = 'select';
$zz['fields'][4]['sql'] = 'SELECT country_id, country_code, country
	FROM /*_PREFIX_*/countries
	ORDER BY country_code';
$zz['fields'][4]['display_field'] = 'country_code';
$zz['fields'][4]['kml_extendeddata'] = true;
$zz['fields'][4]['geojson'] = 'Country';

$zz['fields'][5]['field_name'] = 'region';
$zz['fields'][5]['unless']['export_mode']['list_append_next'] = true;
$zz['fields'][5]['unless']['export_mode']['list_suffix'] = '<br>';
$zz['fields'][5]['kml_extendeddata'] = true;
$zz['fields'][5]['geojson'] = 'Region';

$zz['fields'][6]['field_name'] = 'locality';
$zz['fields'][6]['list_append_show_title'] = true;
$zz['fields'][6]['kml_extendeddata'] = true;
$zz['fields'][6]['geojson'] = 'Locality';

$zz['fields'][7]['field_name'] = 'latitude';
$zz['fields'][7]['type'] = 'number';
$zz['fields'][7]['number_type'] = 'latitude';
$zz['fields'][7]['kml'] = 'latitude';
$zz['fields'][7]['geojson'] = 'latitude';
$zz['fields'][7]['unless']['export_mode']['list_append_next'] = true;
$zz['fields'][7]['unless']['export_mode']['list_suffix'] = '<br>';

$zz['fields'][8]['field_name'] = 'longitude';
$zz['fields'][8]['type'] = 'number';
$zz['fields'][8]['number_type'] = 'longitude';
$zz['fields'][8]['kml'] = 'longitude';
$zz['fields'][8]['geojson'] = 'longitude';
$zz['fields'][8]['list_append_show_title'] = true;

$zz['fields'][9]['field_name'] = 'symbol_id';
$zz['fields'][9]['type'] = 'select';
$zz['fields'][9]['sql'] = 'SELECT symbol_id, symbol
	FROM /*_PREFIX_*/symbols
	ORDER BY symbol';
$zz['fields'][9]['display_field'] = 'symbol_identifier';
$zz['fields'][9]['search'] = '/*_PREFIX_*/symbols.identifier';
$zz['fields'][9]['kml'] = 'style';
$zz['fields'][9]['geojson'] = 'style';
$zz['fields'][9]['unless']['export_mode']['list_prefix'] = '<img src="/_layout/carabidae/symbols/';
$zz['fields'][9]['unless']['export_mode']['list_suffix'] = '.png">';
$zz['fields'][9]['add_details'] = 'symbols';
$zz['fields'][9]['dont_mark_search_string'] = true;
$zz['fields'][9]['kml_extendeddata'] = true;

$zz['fields'][10]['field_name'] = 'sets';
$zz['fields'][10]['kml_extendeddata'] = true;
$zz['fields'][10]['geojson'] = 'Sets';

$zz['fields'][20]['field_name'] = 'last_update';
$zz['fields'][20]['type'] = 'timestamp';
$zz['fields'][20]['hide_in_list'] = true;
$zz['fields'][20]['export'] = false;


$zz['sql'] = 'SELECT /*_PREFIX_*/phylogeography.*
		, /*_PREFIX_*/countries.country_code
		, CONCAT(IFNULL(CONCAT(parent_species.species, " "), ""), /*_PREFIX_*/species.species) AS species
		, IFNULL(/*_PREFIX_*/symbols.identifier, "default") AS symbol_identifier
		, /*_PREFIX_*/datasources.datasource
	FROM /*_PREFIX_*/phylogeography
	LEFT JOIN /*_PREFIX_*/countries USING (country_id)
	LEFT JOIN /*_PREFIX_*/species USING (species_id)
	LEFT JOIN /*_PREFIX_*/species parent_species
		ON /*_PREFIX_*/species.parent_species_id = parent_species.species_id
	LEFT JOIN /*_PREFIX_*/symbols USING (symbol_id)
	LEFT JOIN /*_PREFIX_*/datasources USING (datasource_id)
';
$zz['sqlorder'] = ' ORDER BY index_no';

$zz['export'] = ['CSV Excel', 'KML'];
$zz['record']['copy'] = true;
