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
<!DOCTYPE HTML>
<!--[if lt IE 7 ]> <html lang="<?php print $language->language; ?>" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="<?php print $language->language; ?>" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="<?php print $language->language; ?>" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="<?php print $language->language; ?>" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="<?php print $language->language; ?>" class="no-js"><!--<![endif]-->
<head>

<!-- IMPC -->
<title><?php print $head_title; ?></title>
<meta charset="utf-8" />
<meta name="viewport" content="width=1024" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php print $head; ?>

<!-- css -->
<?php print $styles; ?>

<!-- js -->
<!--[if lt IE 9 ]><script type="text/javascript" src="/<?php print drupal_get_path('theme', 'impc'); ?>/js/selectivizr-min.js"></script><![endif]-->
<?php print $scripts; ?>

</head>

<body id="top" class="<?php print $classes; ?>">	
<?php print $page_top; ?>
<?php print $page; ?>
<?php print $page_bottom; ?>
</body>
</html>