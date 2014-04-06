if (typeof yourvar != 'undefined')
	var show_arrow = false;
//var show_arrow = false;
$x = jQuery.noConflict();
$x(document).ready(function() {
$x(".menu_enhance, .enhance_shortcode_menu_list").each(function() {
	var id = this.id;
	if($x("#"+id).find(".sub-menu"))
	{	
		var smleft, sub_smleft;
		
		if(show_arrow == 'true')
		{
			smleft = '120%';
			sub_smleft = '108%';
		}
		else
		{
			smleft = '100%';
			sub_smleft = '100%';
		}
			
		$x($x("#"+id+" li .sub-menu")).each(function(index,element){
			$x(this).css({"left":smleft, "top":0});
		});
		
		$x($x("#"+id+" li .sub-menu .sub-menu")).each(function(index,element){
			$x(this).css({"left":sub_smleft, "top":0});
		});
	}
});


$x(".enhance_shortcode_menu_inline, .enhance_shortcode_menu_inline_list").each(function() {
	var id = this.id;

	if($x("#"+id).find(".sub-menu"))
	{
		$x(this).css("left",'0');
		
		var smleft, smtop;
		
		if(show_arrow == 'true')
		{
			smleft = '114%';
			smtop = '140%';
		}
		else
		{
			smleft = '100%';
			smtop = '100%';
		}
		
		$x($x("#"+id+" li .sub-menu")).each(function(index,element){
			$x(this).css({"left":0, "top":smtop});
		});
		
		$x($x("#"+id+" li .sub-menu .sub-menu")).each(function(index,element){
			$x(this).css({"left":smleft, "top":0});
		});
	}
});
});


$x(document).ready(function() {
	
	$x(".menu_enhance .sub-menu").each(function(index,element){
		if(show_arrow == 'true')
		{
			$x(this).addClass('wpsm-arrow-enabled');
			$x(this).addClass('wpsm-left-arrow');
		}
	});

});
$x(document).ready(function() {
	$x(".enhance_shortcode_menu_inline .sub-menu").each(function(index,element){
		if(show_arrow == 'true')
		{
			$x(this).addClass('wpsm-arrow-enabled');
			$x(this).addClass('wpsm-up-arrow');
		}
	});
	$x(".enhance_shortcode_menu_inline .sub-menu .sub-menu").each(function(index,element){
		if(show_arrow == 'true')
		{
			$x(this).removeClass('wpsm-up-arrow');
			$x(this).addClass('wpsm-left-arrow');
		}
	});
	
	$x('.wpsm-up-arrow').each(function(index,element){
		var pid = $x(this).parents('.shortcode_menu').attr('id');
		var w = $x(this).prev('a').width();
		$x('head').append('<style>#'+pid+' .wpsm-up-arrow:before { width : '+(w-10)+'px; }</style>');
	});
});
