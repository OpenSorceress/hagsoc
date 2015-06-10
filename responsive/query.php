<?php
    $dbo="dbo330490134";
    $con = mysql_connect("db2450.perfora.net","dbo330490134","hAgs0Cwp");
    if (!$con) 	{die('Could not connect: ' . mysql_error());}
    mysql_select_db("db330490134", $con);

function convert_fancy_quotes ($str) {
$str = str_replace(array(chr(145),chr(146),chr(147),chr(148),chr(151)),array("'","'",'"','"','-'),$str);
$str = str_replace(array('“','”','‘','’'),array("'","'",'"','"'),$str);
 return $str;
}



$str = '[';

$q = mysql_query( "SELECT * FROM `wp_biblio_base` WHERE `app` = 1 ORDER BY `bibliotext` " ) or die(mysql_error());
    while ($row = mysql_fetch_array($q)) {
        $id = $row['id'];
        $str .= '{ "id": '. $row['id'] . ', "type": "' . $row['type'] .'", "bibliotext": "'. $row['bibliotext'] .'", "userid": "'.$row['userid'].'", "submit_date": "'.$row['submit_date'].'", "subj_area": [';

        $x = mysql_query( "SELECT * FROM `wp_biblio_meta` WHERE `bid` = '$id' AND `key` = 'subj_area' " ) or die(mysql_error());
        while ($row = mysql_fetch_array($x)) {
            $str .= '"'.$row['value'].'",';
        }
        $str .= '], "geo_area": [';
        $y = mysql_query( "SELECT * FROM `wp_biblio_meta` WHERE `bid` = '$id' AND `key` = 'geo_area' " ) or die(mysql_error());
        while ($row = mysql_fetch_array($y)) {
            $str .= '"'.$row['value'].'",';
        }
        $str .= '], "language": [';
        $z = mysql_query( "SELECT * FROM `wp_biblio_meta` WHERE `bid` = '$id' AND `key` = 'language' " ) or die(mysql_error());
        while ($row = mysql_fetch_array($z)) {
            $str .= '"'.$row['value'].'",';
        }
        $str .= ']},';

}
$str .= ']';

$str = str_replace(array(",],",",]},"),array("],","]},"),$str);
$str = rtrim($str, '},]');
$str .= ']}]';

echo $str;

