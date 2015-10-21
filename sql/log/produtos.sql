/* criar tabela de grupos */
create table if not exists log.grupos (
	/* campos originais da tabela */
	id serial not null,
	nome varchar(40) not null,
	codigo_referencia varchar(20) not null,
	codigo_fabrica varchar(20) not null,
	codigo_serie varchar(20),
	codigo_barras varchar(20),
	linha int not null,
	grupo int not null,
	subgrupo int not null,
	ncm int not null,
	unidade_medida int not null,
	marca int not null,
	situacao char(1),
	qtd_embalagem numeric(14,4),
	preco_custo numeric(14,4),
	preco_venda numeric(14,4),
	observacoes text,
	/* campos da log */
	log_tipo char(1) not null,
	log_usuario text not null,
	log_pagina text,
	log_data timestamp default current_timestamp,
	log_seq serial not null,
   	constraint PK_LOG_GRUPOS primary key (log_seq)
);