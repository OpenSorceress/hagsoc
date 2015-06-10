<?php
/*
Template Name: Add New Work
*/
get_header(); ?>

    <div id="content">
        <div class="row">
                <div class="col-md-9 bordered">
                    <?php if ( current_user_can('edit_posts') ) { ?>
                        <?php if( have_posts() ) : ?>
                            <?php while( have_posts() ) : the_post(); ?>
                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="post-entry">
                                        <?php the_content(); ?>

                                            <form class="form-horizontal" action="proc.php" method="post">
                                                <div class="form-group" >
                                                    <label class="col-sm-2 control-label" for="type">Type*:</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" name="type" id="type">
                                                            <option value="1"> Book</option>
                                                            <option value="2"> Article</option>
                                                            <option value="3"> Webpage</option>
                                                            <option value="6"> Chapter</option>
                                                            <option value="5"> Encyclopedia entry</option>
                                                            <option value="4"> Other</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="bibliotext">Bibliography text*:</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" id="bibliotext" name="bibliotext" required></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="language">Language(s)*:</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" name="language[]" id="language" multiple>
                                                            <option value="English">English</option>
                                                            <option value="French">French</option>
                                                            <option value="Spanish">Spanish</option>
                                                            <option value="German">German</option>
                                                            <option value="Latin">Latin</option>
                                                            <option value="Greek">Greek</option>
                                                            <option value="Hebrew">Hebrew</option>
                                                            <option value="Russian">Russian</option>
                                                            <option value="Swedish">Swedish</option>
                                                            <option value="Danish">Danish</option>
                                                            <option value="Arabic">Arabic</option>
                                                            <option value="Gaelic">Gaelic</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="language_full">other language:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="text" id="language_full" name="language_full" placeholder="separate by commas">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="subj_area">Subject area(s)*</label>
                                                    <div class="col-sm-10">
                                                        <select name="subj_area[]" id="subj_area" multiple  class="form-control">
                                                            <option value="Church History">Church History</option>
                                                            <option value="Gender">Gender</option>
                                                            <option value="Hist. of Theology">Hist. of Theology</option>
                                                            <option value="Legends">Legends</option>
                                                            <option value="Libraries & Catalogs">Libraries & Catalogs</option>
                                                            <option value="Liturgy">Liturgy</option>
                                                            <option value="Manuscript Studies">Manuscript Studies</option>
                                                            <option value="Miracles">Miracles</option>
                                                            <option value="Mysticism">Mysticism</option>
                                                            <option value="Patron Saints">Patron Saints</option>
                                                            <option value="Political Dimensions">Political Dimensions</option>
                                                            <option value="Popular Religion">Popular Religion</option>
                                                            <option value="Post-Medieval">Post-Medieval</option>
                                                            <option value="Preaching">Preaching</option>
                                                            <option value="Relics & Shrines">Relics & Shrines</option>
                                                            <option value="Religious Orders">Religious Orders</option>
                                                            <option value="Saint Cults">Saint Cults</option>
                                                            <option value="Textual Studies">Textual Studies</option>
                                                            <option value="Visual Culture">Visual Culture</option>
                                                            <option value="Other Religious Lit.">Other Religious Lit.</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="geo_area">Geographical area(s)*</label>
                                                    <div class="col-sm-10">
                                                        <select id="geo_area" name="geo_area[]" multiple class="form-control">
                                                            <option value="General">General</option>
                                                            <option value="Ancient World">Ancient World</option>
                                                            <option value="General Early Church">General Early Church</option>
                                                            <option value="Western Early Church">Western Early Church</option>
                                                            <option value="British Isles (including Ireland)">British Isles (including Ireland)</option>
                                                            <option value="Byzantine Empire">Byzantine Empire</option>
                                                            <option value="Central Europe">Central Europe</option>
                                                            <option value="East Asia">East Asia</option>
                                                            <option value="Eastern Europe">Eastern Europe</option>
                                                            <option value="France">France</option>
                                                            <option value="Germany">Germany</option>
                                                            <option value="Iberia">Iberia</option>
                                                            <option value="Italy">Italy</option>
                                                            <option value="Latin America">Latin America</option>
                                                            <option value="Low Countries">Low Countries</option>
                                                            <option value="Near East">Near East</option>
                                                            <option value="North Africa">North Africa</option>
                                                            <option value="Russia">Russia</option>
                                                            <option value="Scandinavia & Iceland">Scandinavia & Iceland</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <?php global $current_user;
                                                      get_currentuserinfo(); ?>
                                                      <input type="hidden" name="userid" id="userid" value="<?php echo $current_user->display_name; ?>">
                                                      <button class="btn btn-primary" type="submit" value="submit" name="submit">SUBMIT ENTRY</button>
                                                    </fieldset>

                                            </form>


                                     </div>
                                </div>

                            <?php
                            endwhile;
                        endif;
                        ?>
                    <?php } else { ?>
                    <div class="post-entry"><br />
                        <p>Sorry, you cannot submit an entry to the bibliography unless you're a member with proper permissions. If you believe this message
                        to be in error, please contact an administrator about your membership access.</p>
                        </div>
                     <?php } ?>
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
