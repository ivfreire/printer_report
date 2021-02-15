'''
	Criado por Ícaro Freire em 14/02/2021.
	São Paulo, Brasil.

	API para consumir dados de trabalhos de impressões e cópias em arquivos CSV.
'''

from flask import Flask, render_template
import pandas as pd
from json import loads, dumps

config = {}
app = Flask(__name__)

@app.route('/')
def index():
	return render_template('index.html')


@app.route('/printers')
def printer_list():
	'''
		Retorna JSON string com listagem das impressoras e localizaão dos arquivos.
	'''
	return dumps(config['printers'])

@app.route('/printer/<printer>')
def printer(printer):
	'''
		Retorna dados da impressora requisitada na URL
	'''
	return f'Printer selected: {printer}'

if __name__ == '__main__':
	try:
		with open('config.json', 'r') as config_file:
			config = loads(config_file.read())
			app.run(port=config['port'], debug=True)
	except Exception as e:
		print(f'Erro ao ler arquivo de configuração: {e}')