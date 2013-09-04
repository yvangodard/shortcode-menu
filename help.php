<?php
function shortcode_menu_help()
{
?>
	<div id="menu-short-page" class="wrap">
    	<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
        <h2>Menu Shortcode Help</h2>
        <div class="clear"></div>
        
		<?php 
			$items = wp_get_nav_menus(); 
			$count = count($items);if($count==0)
			{
				echo '<div class="error padding">It seems you don\'t have any menu\'s created yet.<br/> Please create your menu <a href="./nav-menus.php">here</a>.</div>';	
			}
		?>
        
        <div class="postbox-container">
            <div class="postbox">
                <h3>Create Your Shortcode</h3>
                <table id="create_table">
                    <tr>
                        <th colspan="2">Create Your Shortcode</th>
                    </tr>
                    <tr>
                        <td>Select Menu</td>
                        <td>
                            <select id="menu_name" onchange="generate_shortcode()">
                                        <option value="Select">-- Select Menu --</option>
                                <?php
                                    foreach($items as $item)
                                    {
                                ?>
                                        <option value="<?php echo $item->name ?>"><?php echo $item->name ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Menu ID (Optional)</td>
                        <td><input type="text" class="full_text" value="" id="shortcode_id" placeholder="Menu ID" onchange="generate_shortcode();" /></td>
                    </tr>
                    
                    <tr>
                        <td>Menu Class (Optional)</td>
                        <td><input type="text" class="full_text" value="" id="shortcode_class" placeholder="Menu Class" onchange="generate_shortcode();"/></td>
                    </tr>
                    
					<tr>
                        <td>List Style (Optional)<div class="example">( Ordered | Unordered )</div></td>
                        <td><input type="checkbox" id="shortcode_list"/> Ordered List Style (Defualt Unordered)</td>
                    </tr>
                    
                    
                    <tr>
                        <td>Display Style (Optional)<div class="example">( block | inline )</div></td>
                        <td><input type="checkbox" id="shortcode_display"/> Display Inline (Defualt Block)</td>
                    </tr>
                    
                    <tr>
                        <td>Enhance (Optional) <div class="example">( true | false )</div></td>
                        <td><input checked="checked" type="checkbox" id="shortcode_enhance"/> Enhance List (Defualt true)</td>
                    </tr>
                    
                    <tr>
                        <td id="shortcode" colspan="2"></td>
                    </tr>
                </table>
            </div><!-- .postbox -->
      	</div><!-- .postbox-container -->
		<div class="postbox-container">
            	<div class="postbox">
                    <h3>Supported Attributes</h3>
                    
                    <table cellspacing="10px">
                        <tr>
                            <td><strong>menu</strong></td> 
                            <td>: Name or Slug of the menu. (required) </td>
                        </tr>
                        <tr>
                            <td><strong>id</strong></td> 
                            <td>: Used to set id to menu. (optional)</td>
                        </tr>
                        <tr>
                            <td><strong>class</strong></td> 
                            <td>: Used to set class to menu (optional)</td>
                        </tr>
                        
                        <tr>
                            <td><strong>list</strong></td> 
                            <td>: To display <em>oredered</em> or <em>unordered list</em> (default : ul)
                            	<span id="list_help" class="help_button" onclick="show_help(this.id)"><img src="<?php echo plugins_url('/images/q-icon.png',__FILE__); ?>"/></span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>display</strong></td> 
                            <td>: To display <em>inline</em> or <em>block</em> (default : block)
                            	<span id="display_help" class="help_button" onclick="show_help(this.id)"><img src="<?php echo plugins_url('/images/q-icon.png',__FILE__); ?>"/></span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>enhance</strong></td> 
                            <td>: To style Sub Menu's
                            	<span id="sub_menu_help" class="help_button" onclick="show_help(this.id)"><img src="<?php echo plugins_url('/images/q-icon.png',__FILE__); ?>"/></span>
                            </td>
                        </tr>
                    </table>
               
           		</div><!-- .postbox -->
        	</div><!-- .postbox-container -->
            
        <div class="postbox-container">
            <div class="postbox">
            	<h3>Donation</h3>
                <div class="field field-last">
                    <form id="paypal_form" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                    	You can donate to this plugin using PayPal. Click to donate.<br/>
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="6KENHJ854VL7J">
                        <input type="image" class="donate" src="<?php echo plugins_url('/images/donate.png',__FILE__); ?>" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
                        <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
                    </form>
              	</div>
          	</div>
     	</div>    
           
        <div class="postbox-container clear">
            <div class="postbox">
                <h3>Shortcodes</h3>
                <div class="field">
                    <h4>Basic : </h4>
                    <input type="text" readonly value="[shortmenu menu='menu name/slug']"/><br/>
                    <div class="example">Example : [shortmenu menu="Main Menu"]</div>
                </div>
                
                <div class="field">
                    <h4>Attributes : </h4>
                    <input type="text" readonly value='[shortmenu menu="menu name/slug" id="id" class="class"]'/><br/>
                    <div class="example">Example : [shortmenu menu="Main Menu" id="myMenu" class="myMenuClass"]</div>
                </div>
                
                <div class="field">
                    <h4>Display (To display menu inline - default:block): </h4>
                    <input type="text" readonly value='[shortmenu menu="menu name/slug" display="inline"]'/>
                </div>
                
                <div class="field">
                    <h4>List Style (To display menu in ordered or unordered style - default:ul): </h4>
                    <input type="text" readonly value='[shortmenu menu="menu name/slug" list="ol"]'/>
                </div>
                
                <div class="field field-last">
                    <h4>Enhance (Default : true):</h4>
                    <input type="text" readonly value='[shortmenu menu="menu name/slug" enhance="false"]'/>
                </div>
           
           	</div><!-- .postbox -->
       </div><!-- .postbox-container -->
     	
        
        
    	
           
    </div><!-- wrap -->
    
  	<!-------------------------------- Modals ------------------------------------>
    
    <div id="display_help_content" class="plugin_text hide">
    	You can display your menu inline. Default is <strong><em>block</em></strong>.<br/>
        For Example : <br/>
        <img src="<?php echo plugins_url('/images/inline.png',__FILE__); ?>"/>
        
    </div>
    
    
	<div id="list_help_content" class="plugin_text hide">
    	To display menu in Ordered or Unordered List.
        By default it is <strong><em>unordered</em></strong>.<br/><br/>
        For Example : <br/></br>
        <div class="alignleft" style="margin-right:2em;">
            <h3 class="mshort-h3">Simple Ordered Menu</h3>
            <img src="<?php echo plugins_url('/images/ol-simple.png',__FILE__); ?>"/>
        </div>
        
        <div class="alignright">
            <h3 class="mshort-h3">Enhance Ordered Menu</h3>
            <img src="<?php echo plugins_url('/images/ol-enhance.png',__FILE__); ?>"/>
        </div>
        <div class="clear"></div>
    </div>
    
    <div id="sub_menu_help_content" class="plugin_text hide">
    	For better and effective styling.
        By default it is <strong><em>true</em></strong>.<br/><br/>
        For Example : <br/></br>
        <div class="alignleft" style="margin-right:2em;">
            <h3 class="mshort-h3">Simple Menu</h3>
            <img src="<?php echo plugins_url('/images/simple.jpg',__FILE__); ?>"/>
        </div>
        
        <div class="alignright">
            <h3 class="mshort-h3">Enhance Menu</h3>
            <img src="<?php echo plugins_url('/images/simple-enhance.png',__FILE__); ?>"/>
        </div>
        <div class="clear"></div>
    </div>
    
    <script type="text/javascript">
    	function generate_shortcode()
		{
			var menu = jQuery('#menu_name option:selected').val();
			
			var shortcode_id = jQuery('#shortcode_id').val();
			var shortcode_class = jQuery('#shortcode_class').val();
						
			var shortcode_start = '[shortmenu';
			var shortcode_end = ']';
			var shortcode_menu = ' menu="'+menu+'" ';
			
			if(shortcode_id != '')
				var shortcode_id = ' id="'+shortcode_id+'" ';
			else
				var shortcode_id = '';
			
			if(shortcode_class != '')
				var shortcode_class = ' class="'+shortcode_class+'" ';
			else
				var shortcode_class = '';
				
			if (jQuery('#shortcode_display').is(':checked')) 
				var shortcode_display = ' display="inline" ';
			else
				var shortcode_display = '';
				
			if (jQuery('#shortcode_list').is(':checked')) 
				var shortcode_list = ' list="ol" ';
			else
				var shortcode_list = '';
			
			if (jQuery('#shortcode_enhance').is(':checked')) 
				var shortcode_enhance = ' enhance="true" ';
			else
				var shortcode_enhance = ' enhance="false" ';
				
			
			if(jQuery('#shortcode_list').is(':checked'))
				var shortcode_list = ' list="ol" ';
			else
				var shortcode_list = '';
			
			var shortcode = shortcode_start+shortcode_menu+shortcode_id+shortcode_class+shortcode_display+shortcode_list+shortcode_enhance+shortcode_end;
			if(menu != 'Select')
			{
				jQuery("#shortcode").fadeOut("fast", function()
				{
				  jQuery('#shortcode').text(shortcode).fadeIn('slow');
				});
			}
			else
			{
				jQuery('#shortcode').fadeOut('slow');
				jQuery('#shortcode').text('');
			}
		}
		
		jQuery('#shortcode_display').click(function() {
			if (jQuery('#shortcode_display').is(':checked'))
			{
				jQuery('#shortcode_enhance').attr('checked',true);
			}
			generate_shortcode();
		});
		
		jQuery('#shortcode_enhance').click(function() {
			generate_shortcode();
		});
		
		jQuery('#shortcode_list').click(function() {
			generate_shortcode();
		});
    </script>
    
    <script type="text/javascript">
    	function show_help(id)
		{
			jQuery("#"+id+"_content").dialog({ 
				modal: true,
				show:'slow',
				title: "Help",
				width: 'auto',
				closeText: '&times;',
			});
		}
    </script>
<?php
}
?>