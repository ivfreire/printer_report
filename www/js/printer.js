// Carrega dados da impressora
const loadPrinterData = function (printer, callback) {
	$.get(`code/read_csv.php?p=${printer}`, (data) => {
		callback(JSON.parse(data));
	});
}

window.onload = function () {
	// Carrega parâmetros definidos na URL
	const params = {};
	const vars = window.location.search.replace('?', '').split('&');
	vars.forEach((param) => {
		const bits = param.split('=');
		params[bits[0]] = bits[1];
	});

	loadPrinterData(params['p'], (data) => {
		console.log(data);

		$('div.info#general-info div.item#total_sheets div.content h2').html(data['totals'][0] + data['totals'][1]);
		$('div.info#general-info div.item#total_prints div.content h2').html(data['totals'][0]);
		$('div.info#general-info div.item#total_copies div.content h2').html(data['totals'][1]);
		$('div.info#general-info div.item#total_scans div.content h2').html(data['totals'][2]);

		$('body').show();
	});
}