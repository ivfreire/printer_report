
window.onload = () => {
	
	$.get('/printers', (response) => {
		let printers = JSON.parse(response);
		printers.forEach(printer => {
			$('div.printer-list').append(`
				<div class="printer" id="${printer['id']}">
					<h2>${printer['title']}</h1>
				</div>
			`);
		});
	});

}


$('div.printer').on('click', () => {
	alert('adasdad');
})