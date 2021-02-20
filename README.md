# Relatórios de Impressão

Ferramenta implementada em Python para gerar relatórios sobre trabalhos de impressão e cópia das impressoras do Instituto de Física da USP.

A API implementada com Flask e Pandas carrega e analisa os dados de impressoras a partir de arquivos .CSV, e disponibiliza esses dados para serem consumidos pelas URIs específicas.

O Front-End acessa os dados das impressoras e os apresenta em uma aplicação Web, consumindo os dados utilizando HTTP requests e utiliza bibliotecas JavaScript para gerar gráficos e interface.

## Métodos HTTP

Assim que a API estiver online e carregada, existem URIs que retornam dados sobre as impressoras cadastradas no sistema.

### Lista de dispositivos

`GET /printers`

Retorna lista de impressoras registradas e dados como nome, local, descrição etc.

```json
[
  {
    "name": "Nome amigável para humanos.",
    "local": "Localização física (prédio, andar, departamento etc).",
    "description": "Descrição e notas adicionais.",
    "status": "Estado atual do dispositivo",
    "id": "Identificação interna da API."
  }
]
```

### Dados de dispositivo

`GET /printer/<id>`

Retorna dados adicionais sobre o dispositivo específicado pela `id`.

```json
{
  "name": "Nome amigável para humanos.",
  "local": "Localização física (prédio, andar, departamento etc).",
  "desc": "Descrição e notas adicionais.",
  "status": "Estado atual do dispositivo",
  "internal_data": "Dados sobre trabalhos de impressão e cópia."
}
```

## Implementação

- Python;
- Flask;
- Pandas;
- JavaScript;
- jQuery.

## Desenvolvimento

Desenvolvido pela equipe de estagiários do Centro de Computação do Instituto de Física da USP (CCIFUSP) em 2021.
