# Three29 Web Developer Test project

[Assignment](https://bitbucket.org/Three29media/interviewtest)

Solution by Mike Henry
April 29, 2018

- [Run](http://mike-t29.herokuapp.com/)
- [Source](https://github.com/mhenry07/mike-t29-interview)

## Running on local machine (from Zip)

- cd to extracted folder
- `./serve.sh`
  - or `cd web && php -S 127.0.0.1:8000`
- navigate to http://127.0.0.1:8000 in browser
- note: tested with PHP 7.2.4

## Index
- HTML is in web/views/index.php
- backend:
  - main page logic: `T29` (lib/Models/T29.php):
    - random image selection: `T29->getRandomImage()`
    - iteration of numbers: `T29->getNumberString()`
    - converting div toggle states to classes: `T29->mapToggleStatesToClasses()`
  - logic to handle AJAX POST: `HomeController->saveState()` (in lib/Controllers/HomeController.php)
  - logic to save and load div toggle states to and from cookies: `DivStateService` (lib/Models/DivStateService.php)
- frontend:
  - main CSS is in web/assets/style.css
    - CSS dependent on PHP is in web/views/index.php
  - main JavaScript is in web/assets/script.js

## Extras
- backend uses MVC architecture
  - web/index.php handles routing
  - models are in lib/Models
  - view is in web/views
  - controller is in lib/Controllers
- Grunt tasks have been set up to process JavaScript and CSS assets: JavaScript validation, minification, source map generation, and unique naming to prevent caching issues
  - processed assets get placed in web/dist
  - falls back to original asset files if Grunt tasks weren't run or failed

## Misc notes

To run from source:
  - `git clone https://github.com/mhenry07/mike-t29-interview.git && cd mike-t29-interview`
  - `npm install`
  - `composer install` # this should also run grunt
  - `cd web && php -S 127.0.0.1:8000`
  - open http://127.0.0.1:8000 in a browser

Requirements:
- [PHP](http://www.php.net/) (tested on PHP 7.2.4)

Development requirements:
- [Composer](https://getcomposer.org/) (for autoloading)
- [Grunt](https://gruntjs.com/) (optional - for minifying and versioning assets - requires Node.js and NPM)
- [Heroku CLI](https://devcenter.heroku.com/articles/heroku-cli) (optional - for Heroku hosting tasks)

Heroku note:
- In order to run Grunt on Heroku, the Node.js buildpack must be installed in addition to the PHP buildpack:
  - `heroku buildpacks:add --index 1 heroku/nodejs`
- verify that heroku/php is second via `heroku buildpacks`
