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
	});
}