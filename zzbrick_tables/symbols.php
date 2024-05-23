<?php 

// Zugzwang Project
// Copyright (c) 2013, 2017, 2023 Gustaf Mossakowski <gustaf@koenige.org>
// Database table 'symbols'


$zz['title'] = 'Symbols';
$zz['table'] = '/*_PREFIX_*/symbols';

$zz['fields'][1]['title'] = 'ID';
$zz['fields'][1]['field_name'] = 'symbol_id';
$zz['fields'][1]['type'] = 'id';

$zz['fields'][15]['title'] = 'Bild';
$zz['fields'][15]['field_name'] = 'bild';
$zz['fields'][15]['type'] = 'upload_image';
$zz['fields'][15]['path'] = [
	'root' => __DIR__.'/../layout',
	'webroot' => '/_layout/carabidae',
	'string1' => '/symbols/', 
	'field1' => 'identifier', 
	'string2' => '.png'
];
$zz['fields'][15]['input_filetypes'] = ['jpeg', 'tiff', 'gif', 'png'];

$zz['fields'][15]['image'][0]['title'] = 'klein';
$zz['fields'][15]['image'][0]['field_name'] = 'klein';
$zz['fields'][15]['image'][0]['width'] = 32;
$zz['fields'][15]['image'][0]['height'] = 32;
$zz['fields'][15]['image'][0]['action'] = 'thumbnail';
$zz['fields'][15]['image'][0]['path'] = $zz['fields'][15]['path'];

$zz['fields'][4]['field_name'] = 'species_id';
$zz['fields'][4]['type'] = 'select';
$zz['fields'][4]['sql'] = 'SELECT species_id, species, parent_species_id
	FROM species
	ORDER BY parent_species_id, species';
$zz['fields'][4]['display_field'] = 'species';
$zz['fields'][4]['show_hierarchy'] = 'parent_species_id';

$zz['fields'][2]['field_name'] = 'symbol';
$zz['fields'][2]['null'] = true;

$zz['fields'][3]['field_name'] = 'identifier';
$zz['fields'][3]['type'] = 'identifier';
$zz['fields'][3]['fields'] = ['symbol'];
$zz['fields'][3]['null'] = true;

$zz['sql'] = 'SELECT /*_PREFIX_*/symbols.*
		, species.species
	FROM /*_PREFIX_*/symbols
	LEFT JOIN species USING (species_id)';
$zz['sqlorder'] = ' ORDER BY symbol';
