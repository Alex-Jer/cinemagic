# :cinema: Cinemagic :cinema:

<p>Este projeto foi desenvolvido no âmbito da disciplina de <b>Aplicações para a Internet</b> de Engenharia Informática no ano letivo 2021/2022.</p>
<b>Colaboradores:</b>

-   Alexandre <sup>[g](https://github.com/Alex-Jer)</sup>
-   Gonçalo <sup>[g](https://github.com/trwygon)</sup>
-   Rafael <sup>[g](https://github.com/Rafael459)</sup>

## :pencil: Introdução

O objetivo deste projeto é implementar uma aplicação Web baseada no servidor, utilizando a
Framework Laravel, para a empresa CineMagic que organiza sessões de cinema nas suas salas e
que irá utilizar a aplicação Web para vender bilhetes e controlar as entradas nas sessões de cinema.

Clique [aqui](materiais/2021-22-EI-AI-enunciado.pdf) para ler o enunciado fornecido.
(Contém informações adicionais sobre o cenário e implementação)

## :computer: Linguagens e Tecnologias Utilizadas

<p><a href="https://laravel.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-plain-wordmark.svg" alt="laravel" title="Laravel" width="40" height="40" /></a><a href="https://www.php.net" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" alt="php" title="PHP" width="40" height="40" /></a><a href="https://www.mysql.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" alt="mysql" title="MySQL" width="40" height="40" /></a><a href="https://windmillui.com/dashboard-html" target="_blank" rel="noreferrer"> <img src="https://windmillui.com/favicon.ico" alt="windmill dashboard ui based on tailwind" title="Windmill UI Dashboard" width="40" height="40" /></a><a href="https://tailwindcss.com" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/tailwindcss/tailwindcss-plain.svg" alt="tailwind" title="Tailwind CSS" width="40" height="40" /></a><img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original-wordmark.svg" alt="html5" title="HTML5" width="40" height="40" /><img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-original-wordmark.svg" alt="css3" title="CSS3" width="40" height="40" /><a href="https://git-scm.com/" target="_blank" rel="noreferrer"> <img src="https://www.vectorlogo.zone/logos/git-scm/git-scm-icon.svg" alt="git" title="Git" width="40" height="40" /></a><a href="https://code.visualstudio.com" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/vscode/vscode-original.svg" alt="vscode" title="Visual Studio Code" width="40" height="40" /></a><a href="https://www.nginx.com" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/nginx/nginx-original.svg" alt="nginx" title="NGINX" width="40" height="40" /></a><a href="https://www.npmjs.com" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/npm/npm-original-wordmark.svg" alt="npm" title="NPM" width="40" height="40" /></a><a href="https://getcomposer.org" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/composer/composer-original.svg" alt="composer" title="Composer" width="40" height="40" /></a><a href="https://heroicons.dev" target="_blank" rel="noreferrer"> <img src="https://heroicons.dev/static/favicon.ico" alt="hero icons" title="Heroicons" width="40" height="40" /></a><a href="https://github.com/devicons/devicon" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/devicon/devicon-original-wordmark.svg" alt="devicon" title="Devicon" width="40" height="40" /></a></p>
<b>Aplicações Laravel:</b>

-   [Dompdf](https://github.com/barryvdh/laravel-dompdf) (1.0.2) - View pdf printer.
-   [Mail CSS Inliner](https://github.com/fedeisas/laravel-mail-css-inliner) (4.0)
-   [Debugbar](https://github.com/barryvdh/laravel-debugbar) (3.6.7)
-   [IDE Helper](https://github.com/barryvdh/laravel-ide-helper) (2.12.3)
-   [Ignition](https://github.com/spatie/laravel-ignition) (1.3.1) - Better error pages.

<p></p>
<b>Outras aplicações:</b>

-   [Simple QrCode](https://github.com/simplesoftwareio/simple-qrcode) (4.2.0)
-   [FakerPHP](https://github.com/fakerphp/faker) (1.19.0) - Generate fake data & seed database.

Todos os _packages_ utilizados estão no [composer.json](composer.json)

## :man_technologist: Configurar o Projeto

Para começar deve renomear o `.env.example` para `.env` e preenchê-lo com as informações corretas para a sua área de trabalho.

Após isso deve correr os seguintes comandos em um terminal na pasta _root_:

```bash
npm install
composer install
composer update
composer dump-autoload
php artisan migrate:fresh
php artisan db:seed
```

## :x: Erros Comuns e Soluções

#### Rota não encontrada

Por vezes após alterar as rotas pode ser necessário atualizar a cache das mesmas, para fazer isso execute o seguinte comando no terminal: `php artisan route:cache`.

#### Problemas com o CSS

O tailwind compila as classes css que estão a ser utilizadas e que serão necessárias. Para compilar o css deve-se executar o comando `npm run dev`, ou alternativamente o comando `npm run watch` para que isto seja realizado automaticamente quando forem verificadas alterações.

O tailwind não detetará as classes que não estiverem em html puro, por exemplo as classes que estiverem a ser inseridas através de Blade e/ou PHP. Para isso existe uma _safelist_ no ficheiro [`tailwind.config.js`](tailwind.config.js) onde se deve inserir essas mesmas classes.

## :mortar_board: Outras Informações

-   Licenciatura em [Engenharia Informática](https://www.ipleiria.pt/curso/licenciatura-em-engenharia-informatica/)

<a href="https://www.ipleiria.pt/estg/"><img src="https://www.ipleiria.pt/normasgraficas/wp-content/uploads/sites/80/2017/09/estg_h-01.jpg" width="300" alt="Escola Superior de Tecnologia e Gestão" title="Escola Superior de Tecnologia e Gestão"></a>
