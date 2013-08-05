$x = jQuery.noConflict();
$x(".menu_enhance").each(function() {
	var id = this.id;
	menu_superfish(id);
	if($x("#"+id).find(".sub-menu"))
	{
		
		$x($x("#"+id+" li .sub-menu")).each(function(index,element){
			var max = $x(this).parent().children("a").width();
			$x(this).css("left",max+10);
		});
		
		$x($x("#"+id+" li .sub-menu .sub-menu")).each(function(index,element){
			$x(this).css("left","111%");
		});
	}
});

$x(document).ready(function() {
	$x(".menu_enhance .sub-menu li:first-child a").append("<div class='arrow-left'></div>");
	$x(".menu_enhance .sub-menu .sub-menu li a .arrow-left").remove();
});

function menu_superfish(id)
{
	$x('#'+id).superfish({
    	animation: {height:'show'},	// slide-down effect without fade-in
        delay:		 1200			// 1.2 second delay on mouseout
    });
}