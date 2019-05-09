<?php

$fnUsr = fopen("PARAMETER1.usr","r");
$fnCsv = fopen('/tmp/file.csv', 'w');


while(! feof($fnUsr))  {
    $line = fgets($fnUsr);
    //Only process with line that in format: "1.   	 FDS Ticker Symbol            	DISPLAY   	DISPLAY   	P_SYMBOL"
    if (!preg_match("/^\d+\..+/", $line)){
    	continue;
    }
    	
    //1. Replace 02 tabs by one
    $line = preg_replace("/\t{2}/", "\t", $line);

    //2. read csv text based on tab can 
    $fields = str_getcsv($line, "\t");

    //3. Trimming
    $trimmed_spaces = array_map('trim', $fields);

    //4. Convert back to csv with default delimiter and enclosure.
    fputcsv($fnCsv, $trimmed_spaces,',','"');
    
}

fclose($fnUsr);
fclose($fnCsv);

//Debug:
echo file_get_contents("/tmp/file.csv");
