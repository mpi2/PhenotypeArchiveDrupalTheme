<?php
/**
 * Copyright © 2011-2014 EMBL - European Bioinformatics Institute
 * 
 * Licensed under the Apache License, Version 2.0 (the "License"); 
 * you may not use this file except in compliance with the License.  
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
?>
<?php


// preprocess_html
function impc_preprocess_html(&$vars) {
    
    // add external stylesheets
    drupal_add_css('//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600', array('type' => 'external','weight' => -2000));
    drupal_add_css('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', array('type' => 'external','weight' => -2000));
    drupal_add_css('//cdnjs.cloudflare.com/ajax/libs/qtip2/2.1.1/jquery.qtip.min.css', array('type' => 'external','weight' => -2000));   
    // add theme css files
    drupal_add_css(drupal_get_path('theme', 'impc') . '/fancybox/jquery.fancybox-1.3.4.css', array('weight' => 50));
    drupal_add_css(drupal_get_path('theme', 'impc') . '/css/default.css', array('weight' => 100));
    drupal_add_css(drupal_get_path('theme', 'impc') . '/css/heatmap.css', array('weight' => 100));
    drupal_add_css(drupal_get_path('theme', 'impc') . '/css/forum.css', array('weight' => 100));
    drupal_add_css(drupal_get_path('theme', 'impc') . '/css/additional.css', array('weight' => 100));
    // add one external css file from the WDM server, just in case Nicolas needs to add some styles
    // this can be removed some day, when the site is live. Just copy the file then to your server
//    drupal_add_css('https://www.ssl-id.de/webdesign-muenchen.de/projekte/impc/css/wdm.css', array('type' => 'external','weight' => 500));
    
    
    // add external js
    drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/qtip2/2.1.1/jquery.qtip.min.js', array('type' => 'external','weight' => 100));
    // add js
    drupal_add_js(drupal_get_path('theme', 'impc') . '/js/head.min.js', array('weight' => 80));
    drupal_add_js(drupal_get_path('theme', 'impc') . '/fancybox/jquery.fancybox-1.3.4.pack.js', array('weight' => 80));
    drupal_add_js(drupal_get_path('theme', 'impc') . '/tablesorter/jquery.tablesorter.min.js', array('weight' => 80));
    drupal_add_js(drupal_get_path('theme', 'impc') . '/js/default.js', array('weight' => 200));
              
}


// preprocess_page
/*
function impc_preprocess_page(&$vars) {
	
}
*/

// clean head
function impc_html_head_alter(&$head_elements) {	
	unset($head_elements['system_meta_generator']);
	unset($head_elements['system_meta_content_type']);
}

// remove unnecessary css files and keep the <head> clean!
function impc_css_alter(&$css) {
		
    $css_to_remove = array(); 
	
	// Core module css
    $css_to_remove[] = 'modules/system/system.base.css'; 
    $css_to_remove[] = 'modules/system/system.menus.css';
	$css_to_remove[] = 'modules/system/system.messages.css'; 
	$css_to_remove[] = 'modules/system/system.theme.css';
	$css_to_remove[] = 'modules/user/user.css';
	$css_to_remove[] = 'modules/node/node.css';
	$css_to_remove[] = 'modules/field/theme/field.css';
    $css_to_remove[] = 'modules/comment/comment.css';
	
	// Views
	$css_to_remove[] = 'sites/all/modules/views/css/views.css';
		
	// Chaos Tools
	$css_to_remove[] = 'sites/all/modules/ctools/css/ctools.css';
    
    // Date API
    $css_to_remove[] = 'sites/all/modules/date/date_api/date.css';
    
    // Login Tobbogan
    $css_to_remove[] = 'sites/all/modules/logintoboggan/logintoboggan.css';
    
    // Mollom
    $css_to_remove[] = 'sites/all/modules/mollom/mollom.css';
	 
    foreach ($css_to_remove as $index => $css_file) { unset($css[$css_file]); }
	
}

// override theme function for files (attachments)
function impc_file_link($variables) {
    $file    = $variables['file'];
    $url     = file_create_url($file->uri);
    $options = array('attributes' => array('type' => $file->filemime . '; length=' . $file->filesize,),);
    if (empty($file->description)) {
         $link_text = $file->filename; 
    } else {
      $link_text = $file->description;
      $options['attributes']['title'] = check_plain($file->filename);
    }
    $options['attributes']['class'] = array('btn');
    return '<div class="attachment-file"> '.l($link_text, $url, $options).'</div>';
}

