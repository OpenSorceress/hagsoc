<?php
/*
Template Name: Approve Work
*/
get_header(); ?>

<?php
if ($_GET['id']) {
    $id = $_GET['id'];
    $result = mysql_query("UPDATE `wp_biblio_base` SET  `app` = '0' WHERE `id` = '$id'")  or die(mysql_error());
    echo $id;
}
?>

    <div id="content">
        <div class="row">
            <div class="col-md-9 bordered">

                <?php if( have_posts() ) : ?>
                    <?php while( have_posts() ) : the_post(); ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <?php if (current_user_can( 'create_users' )) { ?>

                                <div class="post-entry">
                                    <h2>Approve submissions to the bibliography</h2>

                                    <?php
                                    $q = mysql_query( "SELECT * FROM `wp_biblio_base` WHERE `app` = '0' ORDER BY `submit_date` LIMIT 20" ) or die(mysql_error());
                                    while ($row = mysql_fetch_array($q)) {
                                            $xarray = [];
                                            $yarray = [];
                                            $zarray = [];
                                            $id = $row['id'];
                                            $userid = $row['userid'];
                                            $text = $row['bibliotext'];
                                            $submitted = $row['submit_date'];

                                            $x = mysql_query( "SELECT * FROM `wp_biblio_meta` WHERE `bid` = '$id' AND `key` = 'subj_area' " ) or die(mysql_error());
                                            while ($row = mysql_fetch_array($x)) {
                                                $xarray[] = $row['value'];
                                            }
                                            $y = mysql_query( "SELECT * FROM `wp_biblio_meta` WHERE `bid` = '$id' AND `key` = 'geo_area' " ) or die(mysql_error());
                                            while ($row = mysql_fetch_array($y)) {
                                                $yarray[] = $row['value'];
                                            }
                                            $z = mysql_query( "SELECT * FROM `wp_biblio_meta` WHERE `bid` = '$id' AND `key` = 'language' " ) or die(mysql_error());
                                            while ($row = mysql_fetch_array($z)) {
                                                $zarray[] = $row['value'];
                                            }
                                            $langs = implode(', ', $zarray);
                                            ?>

                                            <form class="form-horizontal" action="proc2.php" method="post" accept-charset="UTF-8">
                                                <hr class="biblioline">
                                                <p><i>submitted <?php echo $submitted; ?> by <?php echo $userid; ?> </i></p>
                                                <div class="form-group" >
                                                    <label class="col-sm-2 control-label" for="type">Type*:</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" name="type" id="type">
                                                            <option value="1" <?php if ($row['type'] == 1) echo ' selected'; ?>> Book</option>
                                                            <option value="2" <?php if ($row['type'] == 2) echo ' selected'; ?>> Article</option>
                                                            <option value="3" <?php if ($row['type'] == 3) echo ' selected'; ?>> Webpage</option>
                                                            <option value="6" <?php if ($row['type'] == 6) echo ' selected'; ?>> Chapter</option>
                                                            <option value="5" <?php if ($row['type'] == 5) echo ' selected'; ?>> Encyclopedia entry</option>
                                                            <option value="4" <?php if ($row['type'] == 4) echo ' selected'; ?>> Other</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="bibliotext">Bibliography text*:</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control largebox" id="bibliotext" name="bibliotext" required><?php echo $text; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="language_full">Language(s):</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="text" id="language_full" name="language_full" placeholder="separate by commas" value="<?php echo $langs; if (!$langs) echo 'English'; ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="subj_area">Subject area(s)</label>
                                                    <div class="col-sm-10">
                                                        <select name="subj_area[]" id="subj_area" multiple  class="form-control">
                                                            <option value="Church History" <?php if (in_array("Church History", $xarray)) { echo 'selected'; } ?>>Church History</option>
                                                            <option value="Gender" <?php if (in_array("Gender", $xarray)) { echo 'selected'; } ?>>Gender</option>
                                                            <option value="Hist. of Theology" <?php if (in_array("Hist. of Theology", $xarray)) { echo 'selected'; } ?>>Hist. of Theology</option>
                                                            <option value="Legends" <?php if (in_array("Legends", $xarray)) { echo 'selected'; } ?>>Legends</option>
                                                            <option value="Libraries & Catalogs" <?php if (in_array("Libraries & Catalogs", $xarray)) { echo 'selected'; } ?>>Libraries & Catalogs</option>
                                                            <option value="Liturgy" <?php if (in_array("Liturgy", $xarray)) { echo 'selected'; } ?>>Liturgy</option>
                                                            <option value="Miracles" <?php if (in_array("Miracles", $xarray)) { echo 'selected'; } ?>>Miracles</option>
                                                            <option value="Mysticism" <?php if (in_array("Mysticism", $xarray)) { echo 'selected'; } ?>>Mysticism</option>
                                                            <option value="Patron Saints" <?php if (in_array("Patron Saints", $xarray)) { echo 'selected'; } ?>>Patron Saints</option>
                                                            <option value="Political Dimensions" <?php if (in_array("Political Dimensions", $xarray)) { echo 'selected'; } ?>>Political Dimensions</option>
                                                            <option value="Popular Religion" <?php if (in_array("Popular Religion", $xarray)) { echo 'selected'; } ?>>Popular Religion</option>
                                                            <option value="Post-Medieval" <?php if (in_array("Post-Medieval", $xarray)) { echo 'selected'; } ?>>Post-Medieval</option>
                                                            <option value="Preaching" <?php if (in_array("Preaching", $xarray)) { echo 'selected'; } ?>>Preaching</option>
                                                            <option value="Relics & Shrines" <?php if (in_array("Relics & Shrines", $xarray)) { echo 'selected'; } ?>>Relics & Shrines</option>
                                                            <option value="Religious Orders" <?php if (in_array("Religious Orders", $xarray)) { echo 'selected'; } ?>>Religious Orders</option>
                                                            <option value="Saint Cults" <?php if (in_array("Saint Cults", $xarray)) { echo 'selected'; } ?>>Saint Cults</option>
                                                            <option value="Textual Studies" <?php if (in_array("Textual Studies", $xarray)) { echo 'selected'; } ?>>Textual Studies</option>
                                                            <option value="Visual Culture" <?php if (in_array("Visual Culture", $xarray)) { echo 'selected'; } ?>>Visual Culture</option>
                                                            <option value="Other Religious Lit." <?php if (in_array("Other Religious Lit.", $xarray)) { echo 'selected'; } ?>>Other Religious Lit.</option>
                                                            <option value="Other" <?php if (in_array("Other", $xarray)) { echo 'selected'; } ?>>Other</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="geo_area">Geographical area(s)</label>
                                                    <div class="col-sm-10">
                                                        <select id="geo_area" name="geo_area[]" multiple class="form-control">
                                                            <option value="General" <?php if (in_array ("General", $yarray)) { echo 'selected'; } ?>>General</option>
                                                            <option value="Ancient World" <?php if (in_array ("Ancient World", $yarray)) { echo 'selected'; } ?>>Ancient World</option>
                                                            <option value="General Early Church" <?php if (in_array ("General Early Church", $yarray)) { echo 'selected'; } ?>>General Early Church</option>
                                                            <option value="Western Early Church" <?php if (in_array ("Western Early Church", $yarray)) { echo 'selected'; } ?>>Western Early Church</option>
                                                            <option value="British Isles (including Ireland)" <?php if (in_array ("British Isles (including Ireland)", $yarray)) { echo 'selected'; } ?>>British Isles (including Ireland)</option>
                                                            <option value="Byzantine Empire" <?php if (in_array ("Byzantine Empire", $yarray)) { echo 'selected'; } ?>>Byzantine Empire</option>
                                                            <option value="Central Europe" <?php if (in_array ("Central Europe", $yarray)) { echo 'selected'; } ?>>Central Europe</option>
                                                            <option value="East Asia" <?php if (in_array ("East Asia", $yarray)) { echo 'selected'; } ?>>East Asia</option>
                                                            <option value="Eastern Europe" <?php if (in_array ("Eastern Europe", $yarray)) { echo 'selected'; } ?>>Eastern Europe</option>
                                                            <option value="France" <?php if (in_array ("France", $yarray)) { echo 'selected'; } ?>>France</option>
                                                            <option value="Germany" <?php if (in_array ("Germany", $yarray)) { echo 'selected'; } ?>>Germany</option>
                                                            <option value="Iberia" <?php if (in_array ("Iberia", $yarray)) { echo 'selected'; } ?>>Iberia</option>
                                                            <option value="Italy" <?php if (in_array ("Italy", $yarray)) { echo 'selected'; } ?>>Italy</option>
                                                            <option value="Latin America" <?php if (in_array ("Latin America", $yarray)) { echo 'selected'; } ?>>Latin America</option>
                                                            <option value="Low Countries" <?php if (in_array ("Low Countries", $yarray)) { echo 'selected'; } ?>>Low Countries</option>
                                                            <option value="Near East" <?php if (in_array ("Near East", $yarray)) { echo 'selected'; } ?>>Near East</option>
                                                            <option value="North Africa" <?php if (in_array ("North Africa", $yarray)) { echo 'selected'; } ?>>North Africa</option>
                                                            <option value="Russia" <?php if (in_array ("Russia", $yarray)) { echo 'selected'; } ?>>Russia</option>
                                                            <option value="Scandinavia & Iceland" <?php if (in_array ("Scandinavia & Iceland", $yarray)) { echo 'selected'; } ?>>Scandinavia & Iceland</option>
                                                            <option value="Other" <?php if (in_array ("Other", $yarray)) { echo 'selected'; } ?>>Other</option>
                                                        </select>
                                                    </div>
                                                </div>

                                               <input type="hidden" name="bid" id="bid" value="<?php echo $id; ?>" />

                                               <div class="form-inline">
                                                    <button type="submit" value="R" name="submit"  class="btn btn-default">DECLINE</button>
                                                    <button type="submit" value="A" name="submit" class="btn btn-success">APPROVE</button>
                                               </div>
                                            </form>

                                    <?php } ?>

                                </div>

                            <?php } ?>

                        </div>
                        <?php
                    endwhile;
                endif;
                    ?>

            </div>
            <div class="col-md-3">
                <?php get_sidebar(); ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <?php get_footer(); ?>
            </div>
        </div>
    </div>
