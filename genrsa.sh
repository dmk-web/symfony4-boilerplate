#!/usr/bin/env bash
mkdir -p config/jwt
export $(grep -v '^#' ./.env.local | xargs)
openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096 -pass env:JWT_PASSPHRASE
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout -passin env:JWT_PASSPHRASE
chmod 777 ./config/jwt/private.pem
