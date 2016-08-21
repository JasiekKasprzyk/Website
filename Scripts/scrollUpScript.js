var isVisible = true;
function changeVisibility()
{
	isVisible = true;
}
jQuery(
function($)
{
	
	$.scrollTo(0);
	$('.scrollup').click(function()
		{
		$('.scrollup').fadeOut();
		isVisible=false;
		$.scrollTo($('body'), 1000);
		setTimeout(changeVisibility,1000)
		});
	
	$(window).scroll(function()
			{
				if($(this).scrollTop()>300 && isVisible==true) $('.scrollup').fadeIn();
				else $('.scrollup').fadeOut();
			}
			
	);
}		
);