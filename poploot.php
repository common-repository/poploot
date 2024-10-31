<?php
/*
Plugin Name: PopLoot
Plugin URI: http://ashkarath.forumauberge.com/?page_id=14
Description: Creates a button (and header code) to include PopLoot items into a page or post.
Version: 1.0
Author: Aldri
Author URL: http://www.forumauberge.com/
*/
/*

PopLoot is a plugin that create a simple button to insert PopLoot items into your wordpress pages or posts. You just have to replace the item ID.
Most of the code has been adapted from the collapsible_element plugin by ..::DeUCeD::..

*/
/*	Copyright 2008 Aldri

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/

### Function: PopLoot
// add the poploot script in the header
function addHeaderPopLoot() {
echo '<!-- call PopLoot Script in HEAD -->'."\n";
echo '<script src=\"http://www.lootup.com/inc/popup.js\" type=\"text/javascript\"></script>'."\n";
echo '<link rel=’stylesheet’ type=’text/css’ href=’http://www.lootup.com/styles/default.css’>'."\n";
echo '<!-- done PopLoot Script in HEAD -->'."\n";
  }
add_action('wp_head', 'addHeaderPopLoot');

// INSERT PopLoot Button

add_filter('admin_footer', 'PopLoot_button');
			function PopLoot_button()
			{
if(strpos($_SERVER['REQUEST_URI'], 'post.php') || strpos($_SERVER['REQUEST_URI'], 'comment.php') || strpos($_SERVER['REQUEST_URI'], 'page.php') || strpos($_SERVER['REQUEST_URI'], 'post-new.php') || strpos($_SERVER['REQUEST_URI'], 'page-new.php') || strpos($_SERVER['REQUEST_URI'], 'bookmarklet.php'))
				{
			?>
			<script language="JavaScript" type="text/javascript"><!--
			var toolbar = document.getElementById("ed_toolbar");
			<?php
					poploot_ins_button("PopLoot", "poploot_element", "PopLoot");
			?>
			function poploot_element()
			{
			var poploot_code="<script type=\"text/javascript\" src=\"http://www.poploot.com/bbloot.php?obj=ITEM_ID\"></script>";
      edInsertContent(document.getElementById('content'), poploot_code);
			}
			//--></script>
			<?php
				}
			}
			if(!function_exists('poploot_ins_button'))
			{
// poploot_ins_button: Inserts a button into the editor
// -------------------------
// poploot_ins_button function code was taken from IIMAGE BROWSER plugin @ 
// http://fredfred.net/skriker/index.php/iimage-browser
// -------------------------
				function poploot_ins_button($caption, $js_onclick, $title = '')
				{
				?>
				if(toolbar)
				{
					var theButton = document.createElement('input');
					theButton.type = 'button';
					theButton.value = '<?php echo $caption; ?>';
					theButton.onclick = <?php echo $js_onclick; ?>;
					theButton.className = 'ed_button';
					theButton.title = "<?php echo $title; ?>";
					theButton.id = "<?php echo "ed_{$caption}"; ?>";
					toolbar.appendChild(theButton);
				}
				<?php
				}
			}
?>