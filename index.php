<?php
require_once "simple_html_dom.php";



$headers = array(
    'Accept:application/json, text/javascript, */*; q=0.01',
    'Accept-Language:en-US,en;q=0.8',
    'Connection:keep-alive',
    'Accept-Encoding:gzip, deflate, br',
);

$url = "https://www.amazon.de/s?k=ae&i=aps&s=price-desc-rank&page=1";
$process = curl_init($url);
curl_setopt($process,CURLOPT_URL,$url);
//curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
//curl_setopt($process, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-type: application/json'));
curl_setopt($process, CURLOPT_HTTPHEADER, array('Contect-Type:application/xml', 'Accept:application/xml'));
curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($process,CURLOPT_RETURNTRANSFER,1);
curl_setopt($process, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
$response = curl_exec($process);
curl_close($process);

$html = new simple_html_dom();
$html->load($response);
foreach ($html->find('img') as $element){
    //echo $element->src . '<br>';
}


$pattern = "/\/(?:dp|(?:gp\/product))\/([^\/|\?]+)(?:\/|\?)?/i";
preg_match_all($pattern, $response, $matches);
print_r($matches);
