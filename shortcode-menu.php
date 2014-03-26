<?php
/*
Plugin Name: Shortcode Menu
Plugin URI: http://wordpress.org/plugins/shortcode-menu/
Description: To display menu's everywhere like sidebar, header, footer, pages, posts or theme template with effective styling and customization using shortcode.
Version: 1.3
Author:Amit Sukapure
Author URI: http://in.linkedin.com/in/amitsukapure/
*/
/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : amit.sukapure89@gmail.com)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if(!class_exists('menu_shortcode'))
{
	class menu_shortcode
	{
		function __construct()
		{
			require 'help.php';
			add_action('admin_menu',array($this, 'add_shortcode_menu'));
			add_action('wp_enqueue_scripts', array($this, 'menushort_template_scripts_styles'));
			add_action('admin_enqueue_scripts', array($this, 'menushort_admin_scripts_styles'));
			add_shortcode('shortmenu', array($this,'display_shortcode_menu'));
		}
		
		function add_shortcode_menu()
		{
			add_menu_page('Shortcode Menu', 'Shortcode Menu', 'administrator', 'shortcode-menu', 'shortcode_menu_help','',31 );	
		}
		
		function menushort_template_scripts_styles()
		{
			wp_register_script('enhance-script-menu', plugins_url('js/superfish.js', __FILE__));
			wp_register_script('enhance-script-menu-hover', plugins_url('js/hoverIntent.js', __FILE__));
			wp_register_script('enhance-script-enhance-menu', plugins_url('js/enhance.menu.js', __FILE__));
			
			wp_enqueue_script('enhance-script-menu');
			wp_enqueue_script('enhance-script-menu-hover');
			wp_enqueue_script('enhance-script-enhance-menu');
			
			wp_register_style('enhance-style', plugins_url('css/superfish.css', __FILE__));
			wp_register_style('enhance-style-vertical', plugins_url('css/superfish-vertical.css', __FILE__));
			
			wp_enqueue_style('enhance-style');
			wp_enqueue_style('enhance-style-vertical');
			
			wp_register_style('menushort-style', plugins_url('shortcode-menu.css', __FILE__));
			wp_enqueue_style( 'menushort-style' );
		}
		
		function menushort_admin_scripts_styles()
		{
			wp_enqueue_script( 'jquery-ui-core' );
    		wp_enqueue_script( 'jquery-ui-dialog' );
			
			wp_register_style('jquery-ui-style-plugin', plugins_url( '/css/jquery-ui.css',__FILE__));
			wp_enqueue_style( 'jquery-ui-style-plugin' );
			
			wp_register_style('menushort-admin-style', plugins_url('style.css', __FILE__));
			wp_enqueue_style( 'menushort-admin-style' );
		}
		
		function display_shortcode_menu($attr)
		{
			extract( shortcode_atts( array(
				'id' => '',
				'class' => '',
				'menu' => '',
				'list' => 'ul',
				'display' => 'block',
				'enhance' => 'true'
			), $attr ) );
			
			$menu_class = '';
			
			
			if($id == '')
				$menu_id = 'short_menu_'.uniqid();
			else
				$menu_id = $id;
				
			if($class != '')
				$menu_class .= $class;
				
				
			if($enhance == 'true' && $list == 'ul' && $display == 'block')
			{
				$menu_class .= ' sf-menu sf-vertical menu_enhance ';
			}
			elseif($enhance == 'true' && $list == 'ol' && $display == 'block')
			{
				$menu_class .= ' sf-menu sf-vertical enhance_shortcode_menu_list ';
			}
			elseif(($enhance == 'true' && $list == 'ol' && $display == 'inline')
			||($enhance == 'false' && $list == 'ol' && $display == 'inline'))
			{
				$menu_class .= ' sf-menu enhance_shortcode_menu_inline_list ';
			}
			elseif(($enhance == 'true' && $list == 'ul' && $display == 'inline')
			||($enhance == 'false' && $list == 'ul' && $display == 'inline'))
			{
				$menu_class .= ' sf-menu enhance_shortcode_menu_inline ';
			}
			elseif($enhance == 'false' && $list == 'ol' && $display == 'block')
			{
				$menu_class .= ' shortcode_menu_list ';
			}
			else
			{
				$menu_class .= ' ';
			}
			
			$defaults = array(
				'theme_location'  => '',
				'menu'            => $menu,
				'container'       => 'div',
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => 'shortcode_menu',
				'menu_id'         => '',
				'echo'            => false,
				'fallback_cb'     => 'wp_page_menu',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="'.$menu_id.'" class="%2$s '.$menu_class.'">%3$s</ul>',
				'depth'           => 0,
				'walker'          => ''
			);
			return wp_nav_menu( $defaults ).'<div class="clear"></div>';
		}
	}
}
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');
if(class_exists('menu_shortcode'))
{
	$menu_shortcode = new menu_shortcode;
}
?>