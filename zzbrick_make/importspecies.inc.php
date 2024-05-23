<?php 

function mod_carabidae_make_importspecies() {
	// zur Zeit kein Import.
	exit;

//	$file = 'phylogeography';
	$file = 'phylogeography clatratus';
	$file = 'phylogeography nodulosus';
//	$file = 'phylogeography problematicus';
	
	$page['text'] = '';

	$lines = file_get_contents(wrap_setting('cms_dir').'/docs/lists/'.$file.'.csv');
	$lines = explode("\n", $lines);
	foreach ($lines as $line) {
		if (substr($line, 0, 1) === '#') continue;
		$fields = explode("\t", $line);
		if (count($fields) === 1) continue;
		$values = [];
		$values['action'] = 'insert';
		switch ($file) {
		case 'phylogeography':
			$values['POST']['index_no'] = $fields[0];
			if ($fields[2]) {
				$values['POST']['species_id'] = $fields[2];
			} else {
				$values['POST']['species_id'] = $fields[1];
			}
			$values['POST']['country_id'] = $fields[3].' ';
			$values['POST']['region'] = $fields[4];
			$values['POST']['locality'] = $fields[5];
			$values['POST']['latitude'] = $fields[6];
			$values['POST']['longitude'] = $fields[7];
			break;
		case 'phylogeography clatratus':
			$values['POST']['index_no'] = $fields[0];
			$values['POST']['species_id'] = 'C. clatratus';
			$values['POST']['country_id'] = $fields[1].' ';
			$values['POST']['locality'] = $fields[2];
			$values['POST']['latitude'] = $fields[3];
			$values['POST']['longitude'] = $fields[4];
			$values['POST']['symbol_id'] = $fields[5];
			$values['POST']['sets'] = $fields[6];
			break;
		default:
			if (count($fields) !== 10) {
				echo wrap_print($fields);
				exit;
			}
			$values['POST']['datasource_id'] = $fields[0];
			$values['POST']['index_no'] = $fields[1];
			$values['POST']['species_id'] = $fields[2];
			$values['POST']['country_id'] = $fields[3].' ';
			$values['POST']['region'] = $fields[4];
			$values['POST']['locality'] = $fields[5];
			$values['POST']['latitude'] = $fields[6];
			$values['POST']['longitude'] = $fields[7];
			$values['POST']['symbol_id'] = $fields[8];
			$values['POST']['sets'] = $fields[9];
		}
		$page['text'] .= wrap_print($values);
		$ops = zzform_multi('phylogeography', $values);
		if (!$ops['id']) {
			$page['text'] .= 'Datensatz nicht hinzugefügt. Grund: <br>';
			if ($ops['error']) {
				$page['text'] .= implode(', ', $ops['error']);
			} else {
				$page['text'] .= $ops['output'];
			}
		} else {
			$page['text'] .= 'Datensatz hinzugefügt.<br>';
		}
		
	}
	return $page;
}
