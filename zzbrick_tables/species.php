<?php 

// Zugzwang Project
// Copyright (c) 2013 Gustaf Mossakowski <gustaf@koenige.org>
// Database table 'species'


$zz['title'] = 'Species';
$zz['table'] = '/*_PREFIX_*/species';

$zz['fields'][1]['title'] = 'ID';
$zz['fields'][1]['field_name'] = 'species_id';
$zz['fields'][1]['type'] = 'id';

$zz['fields'][2]['field_name'] = 'species';

$zz['fields'][3]['field_name'] = 'parent_species_id';
$zz['fields'][3]['type'] = 'select';
$zz['fields'][3]['sql'] = 'SELECT species_id, species, parent_species_id
	FROM /*_PREFIX_*/species
	ORDER BY species';
$zz['fields'][3]['show_hierarchy'] = 'parent_species_id';
$zz['fields'][3]['show_hierarchy_same_table'] = true;
$zz['fields'][3]['hide_in_list'] = true;

$zz['sql'] = 'SELECT /*_PREFIX_*/species.* 
	FROM /*_PREFIX_*/species';
$zz['sqlorder'] = ' ORDER BY species';

$zz['list']['hierarchy']['mother_id_field_name'] = $zz['fields'][3]['field_name'];
$zz['list']['hierarchy']['display_in'] = $zz['fields'][2]['field_name'];

?>