<?php

/*get data from xml*/
$feeds = array();
$data = file_get_contents("http://fashionclub.my/xml/Fashion%20Club.xml");
$data = "<?xml version=\"1.0\" encoding=\"utf-8\"?><ITEMS>".$data."</ITEMS>";
$xml = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
//print_r($xml);

foreach ($xml->STOCK as $feed){
$code_array = (array)$feed;
$code = $code_array['@attributes']['stonum'];
$desc = $code_array['@attributes']['desc2'];
$price = $code_array['@attributes']['pricel1'];
$sku = $code;
$stock = "";
$length = strlen($code);

//eight digits - no color, no size
if ($length == 8) {
$sku = $code;
$color = "";
$size = "";
}
//five digits - no color, no size
if ($length == 5) {
$sku = $code;
$color = "";
$size = "";
}
if ($length > 8){
//else

//first five digits - article code
$sku = substr($code, 0, 5);
//next three digits - color
$color = substr($code, 5, 3);
switch ($color) {
	case "001": $color = "Black";
				break;
	case "002": $color = "Gold";
				break;
}
//next three digits - size
$size = substr($code, 8, 3);;
switch ($size) {
	case "001": $size = "S";
		break;
	case "002": $size = "M";
		break;
	case "003": $size = "L";
		break;
	case "004": $size = "XL";
		break;
	case "005": $size = "XS";
		break;		
}
//last digit - barcode check digit
}

$feeds[] = array(
	'sku' => $sku,
	'stock' => $stock,
	'desc' => $desc,
	'price' => $price,
	'color' => $color,
	'size' => $size,
	'length' => $length
);

}

echo sizeof($feeds);
for ($i=0; $i<sizeof($feeds); $i++){
echo $feeds[$i]['desc']." ".$feeds[$i]['sku']." ".$feeds[$i]['price']."<br />";
echo "length: ".$feeds[$i]['length']." color: ".$feeds[$i]['color']." size: ".$feeds[$i]['size']."<br />"; 
}




?>

