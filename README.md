# Symfony4 REST Api boilerplate
Author: **dmk-web**

mkdir -p config/jwt

openssl genrsa -out config/jwt/private.pem -aes256 4096

openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem

 sudo chmod 777 config/jwt/private.pem
