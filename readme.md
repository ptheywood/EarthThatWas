# Earth That Was

A simple local dev server project list, looking in a target directory for projects and creating links to them.

Built using [Slim](http://slimframework.com), [Twig](http://twig.sensiolabs.org/), [Bootstrap](http://getbootstrap.com) though it could have been done without.

## Server Requirements
+ `PHP 5.3+`  for Slim
+ `MySQL 5`

## Installation

Clone the repository

        git clone <remote addr> <dir>

Download dependencies via [Composer](http://getcomposer.org) and [Bower](http://bower.io)

        cd <dir>
        composer install
        bower install

Point the apache host to the `/public/` folder containing `index.php` and `.htaccess`


Configure the application by creating `/app/config.ini`, an example can be found at [`/app/config.ini.example`](app/config.ini.example)

