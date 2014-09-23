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
<div id="wrapper">

    <header id="header">        
        <div class="region region-header">            
            <div id="tn"><?php print render($page['usernavi']); ?></div>            
            <div id="logo">
                <a href="/"><img src="/<?php print $directory ?>/img/logo/impc.png" alt="IMPC Logo" /></a>
                <div id="logoslogan">International Mouse Phenotyping Consortium</div>
            </div>            
            <nav id="mn"><?php print render($page['mainnavi']); ?></nav>            
            <div class="clear"></div>        
        </div>        
    </header>

    <div id="main">
        
        <?php if (!$is_front) { print $breadcrumb; } ?>
        
        <?php print $messages; ?>
        
        <?php if ($page['contenttop']): ?>
        <!-- Content Top -->
        <?php print render($page['contenttop']); ?>
        <?php endif; ?>
        
        <?php if ($page['sidebar_first']): ?>
        <!-- Sidebar First -->
        <?php print render($page['sidebar_first']); ?>
        <?php endif; ?>
        
        <!-- Maincontent -->
        <?php print render($tabs); ?>
<?php print render($page['content']); ?>
        
        <?php if ($page['sidebar_second']): ?>
        <!-- Sidebar Second -->
        <aside id="sidebar">
        <?php print render($page['sidebar_second']); ?>
        </aside>
        <?php endif; ?>
                
        <div class="clear"></div>
        
    </div>
    
    <footer id="footer">
        
        <div class="centercontent">
            <?php print render($page['footer']); ?>
        </div>
        
        <div id="footerline">            
            <div class="centercontent">                
                <div id="footersitemap" class="twothird left">
                    <!-- js copy of mainnavi -->
                </div>
                <div class="onethird right">                    
                    <div id="vnavi">                    
                        <ul>
                            <li><a href=/data/release>Release : 1.1</a></li>
<li><a href="ftp://ftp.ebi.ac.uk/pub/databases/impc/">Ftp</a></li>
                            <li><a href="http://raw.github.com/mpi2/PhenotypeArchive/master/LICENSE">License</a></li>
                            <li><a href="https://raw.github.com/mpi2/PhenotypeArchive/master/CHANGES">Changelog</a></li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                    <p class="textright">&copy; <?php print date('Y'); ?> IMPC &middot; International Mouse Phenotyping Consortium</p>
                   <!-- <div id="fn">
                        <ul>
                            <li><a href="/imprint">Legal notices</a></li>
                        </ul>
                    </div>-->
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </footer>
    
    <?php if ($page['pinned']): ?>
        <!-- Pinned to top -->
        <?php print render($page['pinned']); ?>
    <?php endif; ?>
        
</div>
