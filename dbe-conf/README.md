Project needs zmq lib for websockets to work.
Install this lib before composer.install.

apt-get install libzmq3-dev -y --no-install-recommends
pecl install zmq-beta

To start websocket server run command

php bin/console gos:websocket:server