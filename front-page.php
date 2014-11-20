<?php

/* 
 * Copyright (C) 2014 Rezaur
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

get_header();
?>
 <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Example headline.</h1>
              <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAGZmZgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Another example headline.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAFVVVQAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>One more for good measure.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->
 	<div id="primary" class="content-area col-lg-12">
		<main id="main" class="site-main marketing" role="main">   
          <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
            <div class="img-circle thumb-icon">
            <span class="fa fa-at"></span>
            </div>
          <h2>Heading</h2>
          <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <div class="img-circle thumb-icon">
          <span class="fa fa-bicycle"></span>
            </div>
          <h2>Heading</h2>
          <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <div class="img-circle thumb-icon">
           <span class="fa fa-wifi "></span>
            </div>
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
              <hr class="featurette-divider">     
       
        <?php 
        $args = array(
            'posts_per_page' => '3',
            'post_type' => 'post',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'orderby' => 'rand',
            'meta_key' => '_thumbnail_id',
        );
        $the_query = new WP_Query( $args );
        //query_posts("showposts=2");
        //print_r($the_query);
        if ( $the_query->have_posts() ) {
           $i = 0;
        ?> 
<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

                <div class="row featurette">
       <?php 
            if($i%2 == 0){ ?>
    <div class="col-md-5">
       <?php 
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
	the_post_thumbnail();
} 
?> 
    </div>
     <div class="col-md-7">
    <h2 class="featurette-heading"><?php the_title(); ?><br/>
        <span class="text-muted">by : <?php esc_html( the_author() )?></span>
    </h2>
         <p class="lead"><?php the_excerpt() ?></p>
     </div>
  <?php          }else{ ?>
     <div class="col-md-7">
    <h2 class="featurette-heading"><?php the_title(); ?><br/>
        <span class="text-muted">by : <?php esc_html( the_author() )?></span>
    </h2>
         <p class="lead"><?php the_excerpt() ?></p>
     </div>
    <div class="col-md-5">
        <?php 
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
	the_post_thumbnail();
} 
?>
    </div>
    <?php        }
        ?>
     </div>
<hr class="featurette-divider">
<?php 
        $i++; ///end for loop
endwhile; 
 wp_reset_postdata();
        }else{ ?>
            <p><?php _e( 'Please publish some post with feature image.' ); ?></p>
    <?php    }
?>
          
        </main>
        </div>
<?php
get_footer();