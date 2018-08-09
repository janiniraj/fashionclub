<?php

/*get data from xml*/

$feeds = array();
$data = file_get_contents("http://fashionclub.my/xml/stocks.xml");
$xml = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
//print_r($xml);

foreach ($xml->item as $feed){
$sku_array = (array)$feed->code; //change depending on xml
$stock_array = (array)$feed->quantity; //change depending on xml

$sku = $sku_array[0];
$stock = $stock_array[0];


$feeds[] = array(
	'sku' => $sku,
	'stock' => $stock
);

}

/*connect to db*/

$DB_NAME = 'lkw_fashion_club';
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = 'fashion101';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
}


/*update db*/
for ($i=0; $i<sizeof($feeds); $i++){
	echo "<p><strong>Updating ".$feeds[$i]['sku'].":</strong> ".$feeds[$i]['stock']."</p>";
	
	$sql_up = "UPDATE oc_product SET quantity=".$feeds[$i]['stock']." WHERE sku='".$feeds[$i]['sku']."'";

	if($mysqli->query($sql_up) === TRUE)
			{ 
		   echo "<p>Product ".$feeds[$i]['sku']." updated</p>";
			}
		else
			{
			echo $sql_up.'<br />' . $mysqli->error;
		}
			
	}

/*** close connection ***/
$mysqli->close();

?>