#!/bin/bash
cd /var/www/bank/
#PATH="$HOME/.nvm/versions/node/v12.14.1/bin:$PATH"
git fetch
git reset --hard HEAD
git merge '@{u}'
composer install --optimize-autoloader --no-dev
php artisan migrate --seed
yarn && yarn build --debug --mode production
