<?php
include('../SimplestXML.php');

$sx = new SimplestXML();

/* setup */
$data_b = array("b1" => "vb1", "b2" => "vb2");

$data_c = array();
$data_c[] = array("c-I1" => "vc-I1", "c-I2" => "vc-I2");
$data_c[] = array("c-II" => "vc-II");
$data_c[] = array("c-III" => "vc-III");

$data = array("a" => "va", "b" => $data_b, "c" => $data_c);

echo "\n\n Original Assoziative Array: \n\n";
var_dump($data);

$xml_data = $sx->to_xml('root', $data);

echo "\n\n XML: \n\n";
echo $xml_data;
/* end setup */

$data = $sx->from_xml($xml_data);
echo "\n\n Assoziative Array: \n\n";
var_dump($data);

?>