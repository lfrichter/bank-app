#!/bin/bash
cd /var/www/bank/
#PATH="$HOME/.nvm/versions/node/v12.14.1/bin:$PATH"

echo "Deploying application ..."

# Enter maintenance mode
sudo php artisan down --message 'The app is being (quickly!) updated. Please try again in a minute.'

sudo git fetch
sudo git reset --hard HEAD
sudo git merge '@{u}'
sudo composer install --optimize-autoloader --no-dev --no-interaction --prefer-dist
sudo php artisan migrate --seed --force
# Clear cache
sudo php artisan optimize

echo "" | sudo -S service nginx reload
sudo yarn && yarn build --debug --mode production
sudo service supervisor restart

# Exit maintenance mode
sudo php artisan up
echo "Application deployed!"
