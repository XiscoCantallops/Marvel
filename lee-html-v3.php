<?php

$url1 = "https://es.wikipedia.org/wiki/Thor_(c%C3%B3mic)"; 
$el_id = 'infobox';

$dom = new DOMDocument();
$dom->preserveWhiteSpace = FALSE;
@$dom->loadHTMLFile($url1);
$xpath = new DOMXPath($dom);


$tables = $dom->getElementsByTagName('table');
print_r($tabla);

/*** get all rows from the table ***/
    $rows = $tables->item(1)->getElementsByTagName('tr');

    /*** loop over the table rows ***/
    foreach ($rows as $row)
    {
        /*** get each column by tag name ***/
        $header = $row->getElementsByTagName('th');
        $cols = $row->getElementsByTagName('td');
        /*** echo the values ***/
        echo $header->item(0)->nodeValue.':'.$cols->item(0)->nodeValue;
        echo $header->item(1)->nodeValue.':'.$cols->item(1)->nodeValue;
        echo $header->item(2)->nodeValue.':'.$cols->item(2)->nodeValue;
        echo $header->item(3)->nodeValue.':'.$cols->item(3)->nodeValue;
        echo $header->item(4)->nodeValue;
        //echo $cols->item(5)->nodeValue.'<br />';
        //echo $cols->item(6)->nodeValue.'<br />';
        //echo $cols->item(7)->nodeValue.'<br />';
        //echo $cols->item(8)->nodeValue.'<br />';
        //echo $cols->item(9)->nodeValue.'<br />';
        //echo $cols->item(10)->nodeValue.'<br />';
        echo '<br />';
    }
?>

$