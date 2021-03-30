// Carrega dados da impressora
const loadPrinterData = function (printer, callback) {
	$.get(`code/read_csv.php?p=${printer}`, (data) => {
		callback(JSON.parse(data));
	});
}

const plotHistory = function (data) {
	let labels = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
	let datasets = [{
		label: 'Impressões',
		data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
		backgroundColor: 'rgba(255, 0, 0, 0.4)',
		borderWidth: 1
	},{
		label: 'Cópias',
		data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
		backgroundColor: 'rgba(0, 255, 0, 0.4)',
		borderWidth: 1
	},{
		label: 'Scans',
		data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
		backgroundColor: 'rgba(0, 0, 255, 0.4)',
		borderWidth: 1
	}];

	for (date in data) {
		let bits = date.split('-').map(Number);
		datasets[0].data[bits[1]] += data[date][0];
		datasets[1].data[bits[1]] += data[date][1];
		datasets[2].data[bits[1]] += data[date][2];
	}

	let ctx = document.getElementById('history').children[0].children[0].getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: labels,
			datasets: datasets
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});
}

const plotUsers = function(data) {
	let labels 	= ['', '', '', '', '', ''];
	let pages	= [ 0, 0, 0, 0, 0, 0 ];
	let others	= 0;

	for (user in data) {
		let total = data[user]['totals'][0] + data[user]['totals'][1];
		for (let i = 4; i >= 0; i--) {
			if (total > pages[i]) {
				pages[i + 1] = pages[i];
				pages[i] = total;
				labels[i + 1] = labels[i];
				labels[i] = user;
				if (i == 4) others += pages[5];
			} else {
				if (i == 4) others += total;
				break;
			};
		}
	}

	labels[5] = 'Outros';
	pages[5] = others;

	console.log(labels);

	let ctx = document.getElementById('users').children[0].children[0].getContext('2d');
	let myChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
			labels: labels,
			datasets: [{
				data: pages,
				backgroundColor: [
					'rgba(255, 0, 0, 0.4)',
					'rgba(0, 255, 0, 0.4)',
					'rgba(0, 0, 255, 0.4)',
					'rgba(255, 255, 0, 0.4)',
					'rgba(0, 255, 255, 0.4)',
					'rgba(255, 0, 255, 0.4)'
				]
			}]
		},
		options:{}
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

		plotHistory(data['timeline']);
		plotUsers(data['users']);

		$('body').show();
	});
}