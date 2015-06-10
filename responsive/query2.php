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

$darray = '';
$farray = '';
$xarray = '';
$yarray = '';
$zarray = '';
$q = mysql_query( "SELECT * FROM `wp_biblio_base` WHERE `app` = '0' ORDER BY `submit_date`" ) or die(mysql_error());
    while ($row = mysql_fetch_array($q)) {
        $id = $row['id'];
        $farray['id'] = $id;
        if ($row['type']) {$farray['type'] = $row['type']; }
        if ($row['bibliotext']) { $farray['bibliotext'] = convert_fancy_quotes($row['bibliotext']); }
        if ($row['userid']) {$farray['userid'] = $row['userid']; }
        if ($row['submit_date']) {$farray['submit_date'] = $row['submit_date']; }
        if ($row['app']) {$farray['app'] = $row['app']; }

        $x = mysql_query( "SELECT * FROM `wp_biblio_meta` WHERE `bid` = '$id' AND `key` = 'subj_area' " ) or die(mysql_error());
        while ($row = mysql_fetch_array($x)) {
            $xarray[] = $row['value'];
            $result1 = count($xarray);
        }
        $y = mysql_query( "SELECT * FROM `wp_biblio_meta` WHERE `bid` = '$id' AND `key` = 'geo_area' " ) or die(mysql_error());
        while ($row = mysql_fetch_array($y)) {
            $yarray[] = $row['value'];
            $result2 = count($yarray);
        }
        $z = mysql_query( "SELECT * FROM `wp_biblio_meta` WHERE `bid` = '$id' AND `key` = 'language' " ) or die(mysql_error());
        while ($row = mysql_fetch_array($z)) {
            $zarray[] = $row['value'];
            $result3 = count($zarray);
        }

        if ($result1 > 0) { $farray['subj_area'] = $xarray; }
        if ($result2 > 0) { $farray['geo_area'] = $yarray; }
        if ($result3 > 0) { $farray['language'] = $zarray; }
        $darray[] = array_merge($farray);

        $farray = '';
        $xarray = '';
        $yarray = '';
        $zarray = '';
}


$res = json_encode($darray);
echo $res;

?>

