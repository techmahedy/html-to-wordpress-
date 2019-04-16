<?php

function launcher_theme_setup(){
   load_theme_textdomain("launcher");
   add_theme_support("post-thumbnails");
   add_theme_support("title-tag");
}
add_action("after_setup_theme","launcher_theme_setup");

function launcher_aasets(){ 
	  
    if(is_page()){ 
        $launcher_template_name = basename(get_page_template()); //For ondemand page js/css load
        if($launcher_template_name == "launcher.php"){
            wp_enqueue_style( "animate-css", get_theme_file_uri( "/assets/css/animate.css" ) );
            wp_enqueue_style( "icomoon-css", get_theme_file_uri( "/assets/css/icomoon.css" ) );
            wp_enqueue_style( "bootstrap-css", get_theme_file_uri( "/assets/css/bootstrap.css" ) );
            wp_enqueue_style( "style-css", get_theme_file_uri( "/assets/css/style.css" ) );
            wp_enqueue_style( "launcher", get_stylesheet_uri(), null, "0.1" );

            wp_enqueue_script( "easing-jquery-js", get_theme_file_uri( "/assets/js/jquery.easing.1.3.js" ), array( "jquery" ), null, true );
            wp_enqueue_script( "bootstrap-jquery-js", get_theme_file_uri( "/assets/js/bootstrap.min.js" ), array( "jquery" ), null, true );
            wp_enqueue_script( "waypoint-jquery-js", get_theme_file_uri( "/assets/js/jquery.waypoints.min.js" ), array( "jquery" ), null, true );
            wp_enqueue_script( "countdown-jquery-js", get_theme_file_uri( "/assets/js/simplyCountdown.js" ), array( "jquery" ), null, true );
            wp_enqueue_script( "main-jquery-js", get_theme_file_uri( "/assets/js/main.js" ), array( "jquery" ), time(), true );

            $launcher_year  = get_post_meta( get_the_ID(), "year", true );
            $launcher_month = get_post_meta( get_the_ID(), "month", true );
            $launcher_day   = get_post_meta( get_the_ID(), "day", true );

            wp_localize_script( "main-jquery-js", "datedata", array(
                "year"  => $launcher_year,
                "month" => $launcher_month,
                "day"   => $launcher_day,
            ) );
        }else {
            wp_enqueue_style( "bootstrap-css", get_theme_file_uri( "/assets/css/bootstrap.css" ) );
            wp_enqueue_style( "launcher", get_stylesheet_uri(), null, "0.1" );

        }
    }

}
add_action("wp_enqueue_scripts","launcher_aasets");

function launcher_widgets_areas(){
	$args = array(
  	'name'          => __( 'Footer Left', 'launcher' ),
  	'id'            => 'footer-left',
  	'description'   => 'Footer Left Sidebar',
  	'class'         => '',
  	'before_widget' => '<li id="%1" class="widget %2">',
  	'after_widget'  => '</li>',
  	'before_title'  => '<h2 class="widgettitle">',
  	'after_title'   => '</h2>',
  );
  
  register_sidebar( $args );
  
  $args2 = array(
  	'name'          => __( 'Footer Right', 'launcher' ),
  	'id'            => 'footer-right',
  	'description'   => 'Footer right Sidebar',
  	'class'         => '',
  	'before_widget' => '<li id="%1" class="text-right widget %2">',
  	'after_widget'  => '</li>',
  	'before_title'  => '<h2 class="widgettitle">',
  	'after_title'   => '</h2>',
  );
  
  register_sidebar( $args2 );
}
add_action("widgets_init","launcher_widgets_areas");


add_action("wp_head",function(){

  if (is_page()) { 
   $thumbnail_url = get_the_post_thumbnail_url(null, "large");

   ?>

    <style>
      .home-side{
        background-image: url(<?php echo $thumbnail_url; ?>);
      }
    </style>

  <?php
  }
});