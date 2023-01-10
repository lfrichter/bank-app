# Simple Bank System 🏦 bank-app
@(lfrichter's notebook)[laravel, vue, typescript]

[![Composer](https://img.shields.io/badge/Composer-2.2.17-885630.svg?logo=composer&logoColor=white&style=for-the-badge)](https://getcomposer.org/)                                                                                                                                                                                                                                     [![git](https://img.shields.io/badge/Git-2.37.2-F05032.svg?logo=git&style=for-the-badge&logoColor=white)](https://git-scm.com/downloads)                                                                                                                                                                                                                                                                                                                                                                                                                                                                         [![php](https://img.shields.io/badge/php-8.1.9-777BB4.svg?logo=php&logoColor=white&style=for-the-badge)](http://php.net/)                                                                                                                                                                                                                                                                                                                                                                                                                                                                   [ ![Laravel](https://img.shields.io/badge/Laravel-9.19.0-E74430.svg?logo=laravel&logoColor=white&style=for-the-badge)](https://laravel.com/)                                                                                                                                                                                                                                                                                                                                                                                                                                                                          [![mySql](https://img.shields.io/badge/mysql-5.7.26-4479A1.svg?logo=mysql&style=for-the-badge&logoColor=white) ](https://www.mysql.com/)                                                                                                                                                                                                                                     [![nginx](https://img.shields.io/badge/nginx-1.22.6-269539.svg?logo=nginx&logoColor=white&style=for-the-badge)](http://nginx.org/)                                                                                                                                                                                                                                                                                                                                                                                                         [![npm](https://img.shields.io/badge/NPM-9.2.0-CB3837.svg?logo=npm&style=for-the-badge&logoColor=white)](https://www.npmjs.com)                                                                                                                                                                                      [![Node.js](https://img.shields.io/badge/Node-19.3.0-339933.svg?logo=nodedotjs&style=for-the-badge&logoColor=339933)](https://nodejs.org/en/)                                                                                     [![Typescript](https://img.shields.io/badge/Typescript-4.9.4-3178C6.svg?logo=typescript&style=for-the-badge&logoColor=white)](https://www.typescriptlang.org)                                                                          [![Vue.js](https://img.shields.io/badge/Vue-3.2.36-4FC08D.svg?logo=vue.js&style=for-the-badge&logoColor=4FC08D)](https://vuejs.org)                                                                                                                                                              [![Tailwind](https://img.shields.io/badge/Tailwind-3.2.4-06B6D4.svg?logo=tailwindcss&style=for-the-badge&logoColor=06B6D4)](https://vuejs.org)                                                                                          [![Vite](https://img.shields.io/badge/Vite-2.9.11-646CFF.svg?logo=Vite&style=for-the-badge&logoColor=F9DC3E)](https://vitejs.dev/)



---
## Live
- [App ](http://3.83.165.201/)
- [Admin](http://3.83.165.201/admin)

	Credentials
	- E-mail `admin@bnb.com`
	- Password `12345678`

---
## Deploy  🚚

To prepare an evironment local suitable to deployment, check it out these versions required and follow these steps:
1. `composer install`
2. `composer run-script post-root-package-install`
3. `composer run-script post-create-project-cmd`
4. At the file `.env`
	1. Set proper database name in attribute `DB_DATABASE=`
	2. Update `APP_URL=`, `SANCTUM_STATEFUL_DOMAINS=` and `VITE_APP_URL=` with correct URL according your server definition
5. `php artisan migrate && php artisan db:seed`
6. `npm install && npm run dev` or `yarn && yarn dev`

---
## Screenshots  📸

| App       |    . |
| :-------- | --------:|
| <img src="https://i.imgur.com/kogVXvN.png" style="width: 300px;"  title="Register" />  |  <img src="https://i.imgur.com/cLFU2dT.png" style="width: 300px;" title="Login" /> |
| <img src="https://i.imgur.com/zeq9k86.png" style="width: 300px;" title="Initial balance" />  |  <img src="https://i.imgur.com/Z3fHMuK.png" style="width: 300px;" title="Add a Purchase" /> |
| <img src="https://i.imgur.com/qmDH9ju.png" style="width: 300px;" title="Expenses"/>  |  <img src="https://i.imgur.com/7tNNxcG.png" style="width: 300px;" title="Balance with purchase" /> |
| <img src="https://i.imgur.com/aS1tv1i.png" style="width: 300px;" title="Deposit"/>  |  <img src="https://i.imgur.com/4J7y6Tb.png" style="width: 300px;" title="Pending checks" /> |


| Admin     |        . |
| :-------- | --------:|
| <img src="https://i.imgur.com/tjOYhgR.png" style="width: 300px;" title="Admin Login" />  |  <img src="https://i.imgur.com/0TDImxj.png" style="width: 300px;" title="Pending checks from multiples clients" /> |
| <img src="https://i.imgur.com/yUgBsWE.png" style="width: 300px;" title="Admin Check Detail" />  |  <img src="https://i.imgur.com/LEwOuH4.png" style="width: 300px;" title="Pending checks from multiples clients" /> |


| App with check approved |      . |
| :-------- | --------:|
| <img src="https://i.imgur.com/jDN5O7c.png" style="width: 300px;" title="Admin Check Detail" />  |  <img src="https://i.imgur.com/30osLqy.png" style="width: 300px;" title="Pending checks from multiples clients" /> |



