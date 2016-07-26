var isShowed = false;

function release(number)
{
	var constant = ".show";
	var id=constant+number;
	if(!($(id).css('display')=='block'))
	{
		$(id).css("display", "block");
	}
	else
	{
		$(id).css("display", "none");
	}
}
function show()
{
	if(isShowed==false)
	{
		document.getElementById('small-menu').style.display="block";
		isShowed = true;
	}
	else
	{
		document.getElementById('small-menu').style.display="none";
		isShowed = false;
	}
}

$(window).bind('resize', function() 
{
	if($(window).width()>806)
	{
		$('#small-menu').css('display', 'none');
	}
	isShowed = false;
})