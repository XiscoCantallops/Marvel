<?php
function curl_get_contents($url)
{
    $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
   $html = curl_exec($ch);
   $data = curl_exec($ch);
   curl_close($ch);
   return $data;
}

function getURLContent($url){
    $doc = new DOMDocument;
    $doc->preserveWhiteSpace = FALSE;
    @$doc->loadHTMLFile($url);
    //return $doc->saveHTML();
    $main = $doc->getElementById('powerbox');
    return $main;
}

$url1 = "https://marvel.com/universe/3-D_Man_(Chandler)?utm_campaign=apiRef&utm_source=b1c01ec61d10c3b3001cae56b1eb6918"; 
    
$myHtml = getURLContent($url1);    

//$main = $dom->getElementById('powerbox');

$divString = "";
foreach($myHtml->childNodes as $c) {
    $divString .= $c->ownerDocument->saveXML($c);}

echo $divString
//print_r($myHtml);    

    //$el_div = $myHtml->getElementById($el_id);
    //echo $el_div->nodeValue; 
    
    /*$parrafos = array();
    //$domList=$myHtml->getElementsByTagName('b');
    //Loop through each <a> tag in the dom and add it to the link array
    foreach($myHtml->getElementsByTagName('div') as $parrafos) {
        echo 'atributo: ', $parrafos->nodeValue, "<br />";
    }


    for ($i=0; $i<$el_div->length; $i++)
        {echo "The element $i: ".$el_div->item($i)->nodeValue."<br />";
        }*/

//print_r($el_div);
   
?>
