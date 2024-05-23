<?php 

// www.zugzwang.org
// Copyright (c) 2014 Gustaf Mossakowski <gustaf@koenige.org>
// Table script: datasources


$zz['title'] = 'Datasources';
$zz['table'] = '/*_PREFIX_*/datasources';

$zz['fields'][1]['title'] = 'ID';
$zz['fields'][1]['field_name'] = 'datasource_id';
$zz['fields'][1]['type'] = 'id';

$zz['fields'][2]['field_name'] = 'datasource';

$zz['fields'][3]['field_name'] = 'description';
$zz['fields'][3]['type'] = 'memo';
$zz['fields'][3]['rows'] = 3;

$zz['sql'] = 'SELECT /*_PREFIX_*/datasources.* 
	FROM /*_PREFIX_*/datasources
';
$zz['sqlorder'] = ' ORDER BY datasource';
