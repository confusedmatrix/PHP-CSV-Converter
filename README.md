# PHP CSV Converter

This is a simple application for converting CSVs to PHP arrays or JSON strings for use within your applications.

It is run from the command line and reads CSVs via STDIN. 

To convert a CSV to a PHP array, call:
	
	php convert.php array < file.txt

To convert a CSV to a JSON string, call:

	php convert.php json < file.txt

Obviously replace file.txt with the location of the CSV you wish to convert

This was built as, quite often I've had the need to convert a list of locations to a PHP array or something, so hopefully you'll find it useful too.