create table if not exists usuarios (
	id serial not null,
	login varchar(20) not null,
	senha char(40) not null,
	nome varchar(60) not null,
	modelo int default 0,
	empresa int default 0,
	nivel int not null default 0,
	externo char(1) not null default 'N',
	mobile char(1) not null default 'N',
	telefone varchar(11),
	ramal varchar(3),
	bloqueado char(1) not null default 'N',
	foto bytea,
	observacoes text,
	constraint PK_USUARIOS primary key (id)
);
