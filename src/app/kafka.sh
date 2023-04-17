#!/bin/bash
echo 'Installing PHP Kafka extension, this may take a few seconds.'
git clone https://github.com/arnaud-lb/php-rdkafka.git
cd ./php-rdkafka.git && phpize && ./configure && make all -j 5 && make install
echo 'extension=/var/www/app/php-rdkafka/modules/rdkafka.so' > /usr/local/etc/php/php.ini