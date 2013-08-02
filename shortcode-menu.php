<?php
/*
Plugin Name: Shortcode Menu
Plugin URI: http://wordpress.org/plugins/shortcode-menu/
Version: 1.0
Author:Amit Sukapure
Author URI: http://in.linkedin.com/in/amitsukapure/
*/
/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)
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
global $style;
if(!class_exists('menu_shortcode'))
{
	class menu_shortcode
	{
		function __construct()
		{
			require 'help.php';
			add_action('admin_menu',array($this, 'add_shortcode_menu'));
			add_action('wp_enqueue_scripts', array($this, 'menushort_template_stylesheet'));
			add_action('admin_enqueue_scripts', array($this, 'menushort_admin_stylesheet'));
			add_shortcode('shortmenu', array($this,'display_shortcode_menu'));
		}
		
		function run_menu_shortcode_activation()
		{
			wp_enqueue_script( 'jquery-ui-core' );
    		wp_enqueue_script( 'jquery-ui-dialog' );
			wp_enqueue_style( 'jquery-ui-style-plugin', plugins_url( '/css/jquery-ui.css',__FILE__) );
		}
		
		function add_shortcode_menu()
		{
			add_menu_page('Shortcode Menus', 'Shortcode Menus', 'administrator', 'short_menu', 'shortcode_menu_help','',31 );	
		}
		
		function menushort_template_stylesheet()
		{
			wp_enqueue_style( 'menushort-style', plugins_url('shortcode-menu.css', __FILE__) );
		}
		
		function menushort_admin_stylesheet()
		{
			wp_enqueue_style( 'menushort-admin-style', plugins_url('style.css', __FILE__) );
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
			
			if($display == 'inline')
				$menu_class_display = ' inline_menu ';
			else
				$menu_class_display = '';
			if($list == 'ol')
				$menu_class_display .= ' oredered_list ';
			if($enhance == 'true')
			{
				$menu_class .= ' menu_enhance sf-menu sf-vertical ';
				if($list == 'ol')
					$menu_class .= ' enhance_oredered_list ';
				add_action('wp_footer',array($this, 'add_script_footer'));	
			}
			
			$defaults = array(
				'theme_location'  => '',
				'menu'            => $menu,
				'container'       => 'div',
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => 'menu',
				'menu_id'         => '',
				'echo'            => false,
				'fallback_cb'     => 'wp_page_menu',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="'.$menu_id.'" class="%2$s '.$menu_class.' '.$menu_class_display.'">%3$s</ul>',
				'depth'           => 0,
				'walker'          => ''
			);
			return wp_nav_menu( $defaults ).'<div class="clear"></div>';
		}
		function add_script_footer()
		{
			wp_enqueue_style('enhance-style', plugins_url('css/superfish.css', __FILE__));
			wp_enqueue_style('enhance-style-vertical', plugins_url('css/superfish-vertical.css', __FILE__));
			wp_enqueue_script('enhance-script-menu', plugins_url('js/superfish.js', __FILE__));
			wp_enqueue_script('enhance-script-menu-hover', plugins_url('js/hoverIntent.js', __FILE__));
			wp_enqueue_script('enhance-script-enhance-menu', plugins_url('js/enhance.menu.js', __FILE__));
		}
	}
}
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');
if(class_exists('menu_shortcode'))
{
	$menu_shortcode = new menu_shortcode;
	$menu_shortcode->run_menu_shortcode_activation();	
}
?>