<?php
/*
Plugin Name: Embed Social-ID NOW&trade;
Plugin URI: http://www.socialidnow.com/wordpress
Description: Embed your Social-ID into your wordpress site using a simple shortcode.
Version: 1.0
Author URI: http://www.socialidnow.com/
*/

class SocialId {

  // params - id, size
  function social_id_badge( $atts ) {
    $size = $atts['size'] ? $atts['size'] : 'large';  

    return !$atts['id'] ? "" : "<script src='http://socialid.local:3000/javascripts/badge.js' type='text/javascript'></script>
                                <div class='social-id-badge' id='sid_badge_".$atts['id']."_".$atts['size']."' style='display: inline-block; margin: 10px'>
                                  <p></p>
                                </div>
                                <script>
                                  //<![CDATA[
                                    SocialIDBadge.render('".$atts['id']."', 'sid_badge_".$atts['id']."_".$atts['size']."', '".$atts['size']."');
                                  //]]>
                                </script>";
  }

  // params - group_url, size, width, height 
  function group_badge( $atts ) {
    $default_styles = array(
      'small'  => array('width' => 350, 'height' => 200),
      'normal' => array('width' => 560, 'height' => 430),
      'large'  => array('width' => 950, 'height' => 600)
    );
    $width  = $atts['width']  ? $atts['width']  : $default_styles[$atts['size']]['width'];
    $height = $atts['height'] ? $atts['height'] : $default_styles[$atts['size']]['height'];
    $size = $atts['size'] ? $atts['size'] : 'small';  

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
                                              doc.open().write('<body onload=document.location=\"http://socialid.local:3000/groups/".$atts['group_url']."/badges/".$size."\">');
                                              doc.close();
                                            })(document);
                                          //]]>
                                        </script>";
  }

}

add_shortcode( 'social_id_badge', array('SocialId', 'social_id_badge') );
add_shortcode( 'group_badge', array('SocialId', 'group_badge') );

?>