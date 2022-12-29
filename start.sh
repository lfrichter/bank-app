#!/bin/bash
cd /var/www/bank-app/
#PATH="$HOME/.nvm/versions/node/v12.14.1/bin:$PATH"
yarn build --debug --mode production
