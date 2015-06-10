<?php
    $mysqli = new mysqli("db2450.perfora.net","dbo330490134","hAgs0Cwp","db330490134");
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }

$darray = '';
$farray = '';

$result1 = $mysqli->query("SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'last_name' ORDER BY `meta_key` DESC, `meta_value`", MYSQLI_STORE_RESULT);
    while ($row1 = $result1->fetch_array(MYSQLI_ASSOC)) {
        $id = $row1['user_id'];
        $farray['id'] = $id;

        $result2 = $mysqli->query("SELECT a.user_id AS id, a.meta_value AS lname, b.meta_value AS fname
            FROM wp_usermeta a
            INNER JOIN wp_usermeta b ON a.user_id = b.user_id
            WHERE a.user_id = '$id' AND a.meta_key = 'last_name' AND b.meta_key = 'first_name'", MYSQLI_STORE_RESULT);
        while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                $farray['lname'] = $row2['lname'];
                $farray['fname'] = $row2['fname'];
        }

        $result12 = $mysqli->query("SELECT `meta_value`  FROM `wp_usermeta` WHERE `user_id` = '$id' AND `meta_key` = 'description'", MYSQLI_STORE_RESULT);
        while ($row12 = $result12->fetch_array(MYSQLI_ASSOC)) {
                $farray['bio'] = $row12['meta_value'];
        }

        $result12 = $mysqli->query("SELECT `meta_value`  FROM `wp_usermeta` WHERE `user_id` = '$id' AND `meta_key` = 'wp_capabilities'", MYSQLI_STORE_RESULT);
        while ($row12 = $result12->fetch_array(MYSQLI_ASSOC)) {
                $farray['level'] = $row12['meta_value'];
        }

        $result3 = $mysqli->query("SELECT `user_email` as email, `user_url` as url, `user_registered` as start FROM `wp_users` WHERE `id` = '$id'", MYSQLI_STORE_RESULT);
        while ($row3 = $result3->fetch_array(MYSQLI_ASSOC)) {
            $farray['email'] = $row3['email'];
            $farray['url'] = $row3['url'];
            $farray['start'] = $row3['start'];
        }

        $result4 = $mysqli->query("SELECT `field_id` as field, `value` as val FROM `wp_cimy_uef_data` WHERE `user_id`= '$id'", MYSQLI_STORE_RESULT);
        while ($row4 = $result4->fetch_array(MYSQLI_ASSOC)) {
            if ($row4['field'] == '2') {$farray['address1'] = $row4['val']; }
            if ($row4['field'] == '3') {$farray['address2'] = $row4['val']; }
            if ($row4['field'] == '4') {$farray['address3'] = $row4['val']; }
            if ($row4['field'] == '5') {$farray['city'] = $row4['val']; }
            if ($row4['field'] == '6') {$farray['st'] = $row4['val']; }
            if ($row4['field'] == '7') {$farray['zip'] = $row4['val']; }
            if ($row4['field'] == '8') {$farray['country'] = $row4['val']; }
            if ($row4['field'] == '9') {$farray['phone'] = $row4['val']; }
            if ($row4['field'] == '10') {$farray['fax'] = $row4['val']; }
            if ($row4['field'] == '11') {$farray['proj'] = $row4['val']; }
            if ($row4['field'] == '13') {$farray['subj'] = $row4['val']; }
            if ($row4['field'] == '14') {$farray['geo'] = $row4['val']; }
            if ($row4['field'] == '15') {$farray['trad'] = $row4['val']; }
            if ($row4['field'] == '16') {$farray['nodisp'] = $row4['val']; }
            if (($row4['field'] == '16') && ($row4['val'] == 'YES')) {
                $nodisp = 1;
            } else {
                $nodisp  = 0;
            }
            $total = count($farray);
        }
        if ($nodisp < 1 ) {
            $darray[] = array_merge($farray);
        }
    $farray = '';
}

$res = json_encode($darray);
echo $res;

?>

