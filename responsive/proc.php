<?php
    $dbo="dbo330490134";
    $con = mysql_connect("db2450.perfora.net","dbo330490134","hAgs0Cwp");
    if (!$con) 	{die('Could not connect: ' . mysql_error());}
    mysql_select_db("db330490134", $con);



function clean($input) {
  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );
    $input = preg_replace($search, '', $input);
    $input = trim(htmlentities(strip_tags($input,",")));
    $input = mysql_real_escape_string($input);
    return $input;
  }

if ($_POST['submit']) {

    $type = clean($_POST['type']);
    $userid = $_POST['userid'];

    $bibliotext = ($_POST['bibliotext']);
    $bibliotext = str_replace("<b>", "[b]", $bibliotext);
    $bibliotext = str_replace("</b>", "[/b]", $bibliotext);
    $bibliotext = str_replace("<i>", "[i]", $bibliotext);
    $bibliotext = str_replace("</i>", "[/i]", $bibliotext);
    $bibliotext = clean($bibliotext);
    $bibliotext = str_replace("[b]", "<b>", $bibliotext);
    $bibliotext = str_replace("[/b]", "</b>", $bibliotext);
    $bibliotext = str_replace("[i]", "<i>", $bibliotext);
    $bibliotext = str_replace("[/i]", "</i>", $bibliotext);

    $today =  date("Y-m-d");
    $result = mysql_query("INSERT INTO `wp_biblio_base` ( `type`, `bibliotext`, `submit_date`, `userid` )
        VALUES ('$type', '$bibliotext', '$today', '$userid'  )") or die(mysql_error());

    $bid = mysql_insert_id();

    $subj_area = $_POST['subj_area'];
    $geo_area = $_POST['geo_area'];
    $language = $_POST['language'];
    $language_full = clean($_POST['language_full']);

    if ($subj_area) {
        foreach($subj_area as $key => $value) {
            $result = mysql_query("INSERT INTO `wp_biblio_meta` (`bid` , `key` , `value` ) VALUES ($bid, 'subj_area', '$value')") or die(mysql_error());
        }
    }
    if ($geo_area) {
        foreach($geo_area as $key => $value) {
            $result = mysql_query("INSERT INTO `wp_biblio_meta` (`bid` , `key` , `value` ) VALUES ($bid, 'geo_area', '$value')") or die(mysql_error());
        }
    }
    if ($language) {
        foreach($language as $key => $value) {
            $result = mysql_query("INSERT INTO `wp_biblio_meta` (`bid` , `key` , `value` ) VALUES ($bid, 'language', '$value')") or die(mysql_error());
        }
    }
    if ($language_full) {
        foreach($language_full as $key => $value) {
            $result = mysql_query("INSERT INTO `wp_biblio_meta` (`bid` , `key` , `value` ) VALUES ($bid, 'language', '$value')") or die(mysql_error());
        }
    }


header('location:http://www.hagiographysociety.org/?page_id=237');

}
?>
