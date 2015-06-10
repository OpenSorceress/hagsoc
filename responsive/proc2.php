<?php
    require 'PHPMailer/PHPMailerAutoload.php';

    $dbo="dbo330490134";
    $con = mysql_connect("db2450.perfora.net","dbo330490134","hAgs0Cwp");
    if (!$con) 	{die('Could not connect: ' . mysql_error());}
    mysql_select_db("db330490134", $con);

if ($_POST['submit']) {
    $action = $_POST['submit'];
    $bid = $_POST['bid'];
    $type = $_POST['type'];
    $bibliotext = addslashes($_POST['bibliotext']);
    $subj_area = $_POST['subj_area'];
    $language_full = $_POST['language_full'];
        $langs = explode(",", $language_full);
    $geo_area = $_POST['geo_area'];

    $bibliotext = str_replace( array("\xe2\x80\x98", "\xe2\x80\x99", "\xe2\x80\x9c", "\xe2\x80\x9d", "\xe2\x80\x93", "\xe2\x80\x94", "\xe2\x80\xa6"), array("'", "'", '"', '"', '-', '--', '...'), $bibliotext);
    $bibliotext = str_replace( array(chr(145), chr(146), chr(147), chr(148), chr(150), chr(151), chr(133)), array("'", "'", '"', '"', '-', '--', '...'), $bibliotext);

   $result = mysql_query("DELETE FROM `wp_biblio_meta` WHERE `bid` = '$bid'")  or die(mysql_error());

   if ($action === 'A') {
        $result = mysql_query("UPDATE `wp_biblio_base` SET `type` = '$type', `bibliotext` = '$bibliotext', `submit_date` = '$today'  WHERE `id` = '$bid'") or die(mysql_error());

        $result = mysql_query("UPDATE `wp_biblio_base` SET  `app` = '1' WHERE `id` = '$bid'")  or die(mysql_error());
        foreach ($subj_area as $key => $value) {
            $result = mysql_query("INSERT INTO `wp_biblio_meta` (`bid`, `key`, `value`) VALUES ('$bid', 'subj_area', '$value')")  or die(mysql_error());
        }
        foreach ($geo_area as $key => $value) {
            $result = mysql_query("INSERT INTO `wp_biblio_meta` (`bid`, `key`, `value`) VALUES ('$bid', 'geo_area', '$value')")  or die(mysql_error());
        }
        foreach ($langs as $key => $value) {
            $result = mysql_query("INSERT INTO `wp_biblio_meta` (`bid`, `key`, `value`) VALUES ('$bid', 'language',  '$value')")  or die(mysql_error());
        }
   } else {
        $result = mysql_query("DELETE FROM `wp_biblio_base` WHERE `id` = '$bid'")  or die(mysql_error());
   }

 header('location:http://www.hagiographysociety.org/?page_id=404');
}
?>
