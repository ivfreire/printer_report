// Carrega dados da impressora
const loadPrinterData = function (printer) {
	return printer;
}

window.onload = function () {
	// Carrega parâmetros definidos na URL
	const params = {};
	const vars = window.location.search.replace('?', '').split('&');
	vars.forEach((param) => {
		const bits = param.split('=');
		params[bits[0]] = bits[1];
	});

	const data = loadPrinterData(params['p']);
	console.log(data);
}