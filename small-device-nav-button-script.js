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