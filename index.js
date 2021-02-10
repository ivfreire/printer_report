const express = require('express');

const app = express();

app.get('/', (req, res) => {
	res.send('<h1>CCIFUSP</h1>');
});

app.listen(3000, () => console.log('Servidor rodando em http://localhost:3000'))
