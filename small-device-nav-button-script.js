var isShowed = false;
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
function hide()
{
	var width = window.innerWidth;
	if(width<806)
	{
		document.getElementById('small-menu').style.display="none";
		isShowed = false;
	}
};

$(window).bind('resize', function() {
	document.getElementById('small-menu').style.display="none";
	isShowed = false;
})