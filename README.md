# Relatórios de Impressão

<img src="http://portal.if.usp.br/ccifusp/sites/portal.if.usp.br.ccifusp/files/simbolo%20para%20site_1.png" width="150px" align="right">

Ferramenta para gerar relatórios sobre trabalhos de impressão e cópias das impressoras do Instituto de Física da USP.

Esta ferramenta está sendo desenvolvida em PHP (back-end) e HTML5, CSS3 e JavaScript (front-end) e pode ser hosteada em qualquer serviço de webhosting com suporte para PHP.

## Screenshots

Página de login
<img src="https://github.com/ivfreire/printer_report/blob/development/images/login_page.png" width="100%">

## Uso

As configurações e dados da ferramenta estão armazenados em arquivos JSON dentro do diretório `data`.

`printers.json`

Contém informações sobre as impressoras listadas na ferramenta como nome, localização etc.

```json
[
  {
    "name": "Nome amigável para humanos.",
    "local": "Localização física (prédio, andar, departamento etc).",
    "description": "Descrição e notas adicionais.",
    "data": "Localização do arquivo CSV com dados dos trabalhos de impressões."
    "id": "Identificação interna da API."
  }
]
```

## Implementação

- PHP
- HTML5
- CSS3
- JavaScript

## Desenvolvimento

Desenvolvido pela equipe de estagiários do Centro de Computação do Instituto de Física da USP (CCIFUSP) em 2021.
