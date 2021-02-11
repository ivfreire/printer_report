
const getURLParams =  function(url) {
	obj = {}
	keys = url.replace('?', '').split('&');
	keys.forEach(key => {
		bits = key.split('=');
		obj[bits[0]] = bits[1];
	});
	return obj;
}

window.onload = function() {
	params = getURLParams(window.location.search);

	if ('p' in params) {
		$('div.printers').hide();
	} else
		$.get('/printers', 
			(data, status, xhr) => data.forEach(printer => {
				$('div.printer-list').append(`
					<a href='/?p=${printer['id']}'>
						<div><h1>${printer['title']}</h1></div>
					</a>
				`);
			})
		);
}