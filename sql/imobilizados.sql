/* criar tabela de imobilizados */
create table if not exists imobilizados (
	id serial not null,
	placa char(8),
	municipio_placa varchar(50),
	uf_placa char(2),
	descricao varchar(50) not null,
	renavan char(11),
	chassi varchar(30),
	marca varchar(30),
	modelo varchar(30),
	ano_modelo int,
	ano_fabricacao int,
	cor varchar(20),
	combustivel char(1),
	tipo char(1),	
	observacoes text,
	constraint PK_IMOBILIZADOS primary key (id));

/* TRIGGER DA LOG */
create function gravar_log_imobilizados() returns trigger as $gravar_log_imobilizados$
begin
	/* INCLUSAO */
	if (TG_OP = 'INSERT') then
		insert into log.imobilizados select NEW.*, 'I', current_setting('sistemaweb.usuario'),  current_setting('sistemaweb.pagina');
		return NEW; 
	end if;
	/* ALTERACAO */
	if (TG_OP = 'UPDATE') then
		insert into log.imobilizados select OLD.*, 'A', current_setting('sistemaweb.usuario'), current_setting('sistemaweb.pagina');
		insert into log.imobilizados select NEW.*, 'D', current_setting('sistemaweb.usuario'), current_setting('sistemaweb.pagina');
		return NEW;
	end if;
	/* EXCLUSAO */
	if (TG_OP = 'DELETE') then
		insert into log.imobilizados select OLD.*, 'E', current_setting('sistemaweb.usuario'), current_setting('sistemaweb.pagina');
		return OLD;
	end if;
	
	return NULL;
end;

$gravar_log_imobilizados$ language plpgsql;

create trigger gravar_log_imobilizados after insert or update or delete on imobilizados
	for each row execute procedure gravar_log_imobilizados();

