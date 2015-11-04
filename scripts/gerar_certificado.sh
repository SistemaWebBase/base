#!/bin/bash

export DIR="../arquivos/privado/certificado/sistemaweb"

#Informações do certificado
export CN="SistemaWeb"
export O="Thiago Sistemas Ltda"
export OU="Thiago Sistemas Group Ltda"
export ST="MT"
export C="BR"
export L="Cuiaba"
export SENHA="554860Ti"

# Gerar certificado
keytool -genkeypair \
	-alias SistemaWeb \
	-keysize 2048 \
	-dname "CN=$CN, O=$O, OU=$OU, ST=$ST, C=$C, L=$L" \
	-validity 3650 \
	-keyalg RSA \
	-keypass $SENHA \
	-keystore $DIR/certificado.pfx \
	-storepass $SENHA \
	-storetype PKCS12

# Extrar chave privada
openssl pkcs12 \
	-in $DIR/certificado.pfx \
	-nocerts \
	-out $DIR/chave_privada.key

# Extrar chave publica
openssl pkcs12 \
	-in $DIR/certificado.pfx \
	-clcerts \
	-nokeys \
	-out $DIR/chave_publica.pem

# Retirar protecao de senha
openssl rsa \
	-in $DIR/chave_privada.key \
	-out $DIR/chave_privada.pem
