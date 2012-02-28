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

  // params - group_url, size, width, height 
  function get_social_id_group( $atts ) {
    $default_styles = array(
      'small'  => array('width' => 350, 'height' => 200),
      'normal' => array('width' => 560, 'height' => 430),
      'large'  => array('width' => 950, 'height' => 600)
    );
    $width  = $atts['width']  ? $atts['width']  : $default_styles[$atts['size']]['width'];
    $height = $atts['height'] ? $atts['height'] : $default_styles[$atts['size']]['height'];
    $size = $atts['size'] ? $atts['size'] : 'small';
    $join = $atts['join_button'] ? $atts['join_button'] : 'yes';

    return !$atts['group_url'] ? "" : "<div class='group-badge' id='group_badge_".$atts['group_url']."_".$size."'style='display: inline-block; margin: 10px'>
                                          <p></p>
                                        </div>
                                        <script>
                                          //<![CDATA[
                                            (function(d){
                                              var i = d.createElement('iframe');
                                              i.scrolling = 'auto';
                                              i.setAttribute('frameBorder', '0');
                                              i.allowTransparency = 'true';
                                              var iframe = d.getElementById('group_badge_".$atts['group_url']."_".$size."').appendChild(i),
                                                  doc = iframe.contentWindow.document;
                                              iframe.style.cssText = 'width: ".$width."px; height: ".$height."px';
                                              doc.open().write('<body onload=document.location=\"http://www.socialidnow.com/groups/".$atts['group_url']."/badges/".$size."?join_button=".$join."\">');
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