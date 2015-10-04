create table if not exists modulos (
	id serial not null,
	nome varchar(20) not null,
	pasta varchar(20) not null,
	indice int not null default 0,
	nivel int default 0,
	constraint PK_MODULOS primary key (id) 
);