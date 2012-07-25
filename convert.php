<?php

// valid formats
$formats = array(

	'array',
	'json'

);

// check if a file has been passed via STDIN, read to string $file
if (($file = file_get_contents('php://stdin')) == false) {

	throw new \Exception(
		'No file was passed to the script. 
		Try \'php index.php array < file.txt\''
	);

// check if the format to convert to has been supplied and is valid
} elseif (empty($_SERVER['argv'][1]) || 
		  !in_array(strtolower($_SERVER['argv'][1]), $formats)) {

	throw new \InvalidArgumentException(
		'You must specify a valid output format, eg, array or JSON'
	);

} else {

	// create array from CSV string
	$data = array();
	$lines = str_getcsv($file, "\n");
	foreach ($lines as $line)
		$data[] = str_getcsv($line, ',');

	if (empty($data))
		throw new \Exception(
			'No parsable CSV data was found in the file'
		);

	// select output format
	$output = '';
	switch($_SERVER['argv'][1]) {

		// outputs a PHP array
		case 'array':

			$output .= '$array = array(';
			foreach ($data as $line) {

				$output .= 'array(';
				foreach ($line as $field) {
					$output .= $field.',';
				}
				$output = substr($output, 0, -1);
				$output .= '),';

			}
			$output = substr($output, 0, -1);
			$output .= ');' . "\n";
			break;

		// outputs a JSON encoded string
		case 'json':

			$output = json_encode($data);
			break;

	}

	echo $output;

}