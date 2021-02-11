const express	= require('express');
const path		= require('path');
const fs		= require('fs');

fs.readFile(path.join(__dirname, 'config.json'), { encoding: 'UTF-8' }, (err, text) => {
	if (err) {

	} else {
		const config = JSON.parse(text);
		const app = express();
	
		app.use(express.static(path.join(__dirname, 'www')))
	
		app.get('/', (req, res) => {
			res.sendFile(path.join(__dirname, 'www/index.html'));
		});

		app.get('/printers', (req, res) => res.send(config['printers']));
	
		app.listen(config['port'], () => console.log(`Servidor rodando em http://localhost:${config['port']}/`));
	}
});
