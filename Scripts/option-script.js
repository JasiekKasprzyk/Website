function returnOption()
{
	if(document.getElementById('category'))
		{
			var selectedOption = document.getElementById('category').value;
			if(selectedOption=='Sprzęt')
				{
					document.getElementById('subcategory').innerHTML = '<option value="Płyta główna">Płyta główna</option><option value="Procesor">Procesor</option><option value="Karta graficzna">Karta graficzna</option><option value="Pamięć masowa">Pamięć masowa</option><option value="Karta dźwiękowa">Karta dźwiękowa</option><option value="Pamięć RAM">Pamięć RAM</option><option value="Napędy optyczne">Napędy optyczne</option><option value="Chłodzenie">Chłodzenie</option><option value="Zasilacz">Zasilacz</option>';
				}
			if(selectedOption=='Oprogramowanie')
			{
				document.getElementById('subcategory').innerHTML = '<option value="Systemy operacyjne">Systemy operacyjne</option><option value="Programowanie">Programowanie</option>';
			}
			if(selectedOption=='O nas')
				{
				document.getElementById('subcategory').innerHTML = '<option value="O nas">O nas</option>';
				}
		}
}

document.getElementById('category').onchange = function(){returnOption();}