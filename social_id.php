<?php
/*
Plugin Name: Embed Social-ID NOW&trade;
Plugin URI: http://www.socialidnow.com/wordpress
Description: Embed your Social-ID into your wordpress site using a simple shortcode.
Version: 1.0
Author URI: http://www.socialidnow.com/
*/

class SocialID {

  // params - id, size
  function get_social_id( $atts ) {
    $size = $atts['size'] ? $atts['size'] : 'large';

    return !$atts['id'] ? "" : "<script src='http://www.socialidnow.com/javascripts/badge.js' type='text/javascript'></script>
                                <div class='social-id-badge' id='sid_badge_".$atts['id']."_".$atts['size']."' style='display: inline-block; margin: 10px'>
                                  <p></p>
                                </div>
                                <script>
                                  //<![CDATA[
                                    SocialIDBadge.render('".$atts['id']."', 'sid_badge_".$atts['id']."_".$atts['size']."', '".$atts['size']."');
                                  //]]>
                                </script>";
  }
  function social_id( $atts ) { echo get_social_id( $atts ); }

  // params - group_url, size, header, join_button, join_button_position, pictures, width, height
  function get_social_id_group( $atts ) {
    $default_atts = array('header'               => 'yes',
                          'join_button'          => 'yes',
                          'join_button_position' => 'middle',
                          'pictures'             => 'yes',
                          'size'                 => 'small');
    $default_sizes = array('small'  => array('width' => 350, 'height' => 200),
                           'normal' => array('width' => 580, 'height' => 430),
                           'large'  => array('width' => 950, 'height' => 600));

    foreach ($default_atts as $k => $v)
      if (!$atts[$k]) $atts[$k] = $v;
    if (!$atts['width'])  $atts['width']  = $default_sizes[$atts['size']]['width'];
    if (!$atts['height']) $atts['height'] = $default_sizes[$atts['size']]['height'];

    return !$atts['group_url'] ? "" : "<div class='group-badge' id='group_badge_".$atts['group_url']."_".$atts['size']."'style='display: inline-block; margin: 10px'>
                                          <p></p>
                                        </div>
                                        <script>
                                          //<![CDATA[
                                            (function(d){
                                              var i = d.createElement('iframe');
                                              i.scrolling = 'auto';
                                              i.setAttribute('frameBorder', '0');
                                              i.allowTransparency = 'true';
                                              var iframe = d.getElementById('group_badge_".$atts['group_url']."_".$atts['size']."').appendChild(i),
                                                  doc = iframe.contentWindow.document;
                                              iframe.style.cssText = 'width: ".$atts['width']."px; height: ".$atts['height']."px';
                                              doc.open().write('<body onload=document.location=\"http://www.socialidnow.com/groups/".$atts['group_url']."/badges/".$atts['size']."?join_button=".$atts['join_button']."&join_button_position=".$atts['join_button_position']."&pictures=".$atts['pictures']."&header=".$atts['header']."\">');
                                              doc.close();
                                            })(document);
                                          //]]>
                                        </script>";
  }
  function social_id_group( $atts ) { echo social_id_group( $atts ); }


}

add_shortcode( 'social_id', array('SocialID', 'get_social_id') );
add_shortcode( 'social_id_group', array('SocialID', 'get_social_id_group') );

?>