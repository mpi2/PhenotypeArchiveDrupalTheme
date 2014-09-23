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
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
        	
	<?php print render($content); ?>
	
	<div class="clear"></div>
	
	<?php if (user_access('administer nodes') && (in_array($type,array('page','page')) || in_array($type,array('page','news'))) && $view_mode == 'full'): ?>
        <p class="editlink"><a class="btn editlink" href="/node/<?php print $node->nid; ?>/edit" title="Edit">Edit this <?php print $type ?> in Drupal</a></p>
    <?php endif; ?>
    
</div>
