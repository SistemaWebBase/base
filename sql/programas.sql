create table if not exists programas (
	id serial not null,
	nome varchar(20) not null,
	modulo int not null,
	pasta varchar(20) not null,
	agrupamento varchar(20),
	indice int not null default 0,
	nivel int default 0,
	constraint PK_PROGRAMAS primary key (id),
	constraint FK_PROGRAMAS_MODULOS  foreign key (modulo) references modulos (id)
);