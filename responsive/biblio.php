<?php
/*
Template Name: Bibliography
*/

get_header(); ?>

    <div id="content">
        <div class="row">
            <div class="col-md-9 bordered">
                <div id="result"></div>
                <?php if( have_posts() ) : ?>

                    <?php while( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'loop-header' ); ?>

                        <?php responsive_entry_before(); ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <?php responsive_entry_top(); ?>

                            <?php get_template_part( 'post-meta-page' ); ?>
                            <?php get_template_part( 'post-data' ); ?>
                            <div class="post-entry">
                                <?php the_content(); ?>
                                <a name="scroll-top2"></a>
                            <?php if ( current_user_can('edit_posts') ) { ?>
                                <p><a href="../HSbibliography_130821.pdf">Download</a> the 2011 bibliography as a PDF file.
                                <a href="http://www.hagiographysociety.org/?page_id=252">Submit an entry</a> to the bibliography.<br/>
                            <?php } ?>
                            <?php if (current_user_can( 'manage_options' )) { ?>
                                    <br/>
                                    <a href="http://www.hagiographysociety.org/?page_id=404">Approve submissions</a> to the bibliography.<br />
                                    <a href="http://www.hagiographysociety.org/?page_id=80">Submit correction</a> to listing.<br/>
                            <?php } ?>
                            </p>

                            <div  ng-app="app">
                                <div ng-controller="WorkController">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-horizontal">
                                                <div class="form-group">
                                                    <label for="search" class="col-sm-2 control-label">Search:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="text" id="query" data-ng-model="query" >
                                                    </div>
                                                </div>
                                                <div class="form-group" >
                                                    <label for="type" class="col-sm-2 control-label">Type:</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" data-ng-model="search.type">
                                                            <option value=""> All</option>
	                                                    <option value="1"> Book</option>
	                                                    <option value="2"> Article</option>
	                                                    <option value="3"> Webpage</option>
	                                                    <option value="6"> Chapter</option>
	                                                    <option value="5"> Encyclopedia entry</option>
	                                                    <option value="4"> Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group" >
                                                    <label for="language" class="col-sm-2 control-label">Language:</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" data-ng-model="search.language">
                                                            <option value="">All</option>
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
                                                <div class="form-group" >
                                                    <label for="subject" class="col-sm-2 control-label">Subject: </label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" data-ng-model="search.subj_area">
                                                            <option value="">All</option>
                                                            <option value="Church History">Church History</option>
                                                            <option value="Gender">Gender</option>
                                                            <option value="Hist. of Theology">Hist. of Theology</option>
                                                            <option value="Legends">Legends</option>
                                                            <option value="Libraries & Catalogs">Libraries & Catalogs</option>
                                                            <option value="Liturgy">Liturgy</option>
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
                                                <div class="form-group" >
                                                    <label for="geography" class="col-sm-2 control-label">Geography: </label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" data-ng-model="search.geo_area">
                                                            <option value="">All</option>
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
                                            </div>
                                        </div>
                                    </div>
                                    <div ng-repeat="work in works | filter:search | filter:query">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <p ng-bind-html-unsafe="work.bibliotext"></p>
                                                    <ul>
                                                        <span ng-show="work.language"><li><i>Language</i>: <span ng-repeat="lang in work.language"><span ng:hide="$index == 0">,</span> {{lang}}</li></span>
                                                        <span ng-show="work.subj_area"><li><i>Subjects</i>: <span ng-repeat="subj in work.subj_area"><span ng:hide="$index == 0">;</span> {{subj}}</span></li></span>
                                                        <span ng-show="work.geo_area"><li><i>Geography</i>: <span ng-repeat="geo in work.geo_area"><span ng:hide="$index == 0">;</span> {{geo}}</span></li></span>
                                                    <?php if (current_user_can( 'create_users' )) { ?>
                                                        <li><i>submitted {{work.submit_date}} by {{work.userid}}</i></li>
                                                    <?php } ?>
                                                    </ul>
                                            </div>
                                            <div class="col-md-1">
                                                <?php if (current_user_can( 'create_users' )) { ?>
                                                   <a href="http://www.hagiographysociety.org/?page_id=404&id={{work.id}}" class="pull-right btn btn-default btn-xs">X</a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center padbot20">
                                                <div data-ng-show="(($index +1) % 10) ==0">
                                                    <a href="#scroll-top2">&ndash; return to top &ndash;</a><br />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p data-ng-show="(results | filter:search).length==0">There are no results for this search</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        <?php
                    endwhile;
                endif;
                    ?>
            </div>
            </div>
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
