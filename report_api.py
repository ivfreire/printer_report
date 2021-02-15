'''
	Criado por Ícaro Freire em 14/02/2021.
	São Paulo, Brasil.

	API para consumir dados de trabalhos de impressões e cópias em arquivos CSV.
'''

from flask import Flask
import pandas as pd
from json import loads

app = Flask(__name__)

@app.route('/')
def index():
	return 'Printer Report API Utility'

def main():
	try:
		with open('config.json', 'r') as config_file:
			config = loads(config_file.read())
			app.run(port=config['port'], debug=True)
	except Exception as e:
		print(f'Erro ao ler arquivo de configuração: {e}')
		return
	return

if __name__ == '__main__':
	main()