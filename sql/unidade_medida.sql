/* criar tabela unidade_medida */
create table if not exists unidade_medida (
	id serial not null,
	unidade char(2) not null,
	descricao varchar(20) not null,
	constraint PK_UNIDADE_MEDIDA primary key (id) 
);

/* TRIGGER DA LOG */
create function gravar_log_unidade_medida() returns trigger as $gravar_log_unidade_medida$
begin
	/* INCLUSAO */
	if (TG_OP = 'INSERT') then
		insert into log.unidade_medida select NEW.*, 'I', current_setting('sistemaweb.usuario'),  current_setting('sistemaweb.pagina');
		return NEW; 
	end if;
	/* ALTERACAO */
	if (TG_OP = 'UPDATE') then
		insert into log.unidade_medida select OLD.*, 'A', current_setting('sistemaweb.usuario'), current_setting('sistemaweb.pagina');
		insert into log.unidade_medida select NEW.*, 'D', current_setting('sistemaweb.usuario'), current_setting('sistemaweb.pagina');
		return NEW;
	end if;
	/* EXCLUSAO */
	if (TG_OP = 'DELETE') then
		insert into log.unidade_medida select OLD.*, 'E', current_setting('sistemaweb.usuario'), current_setting('sistemaweb.pagina');
		return OLD;
	end if;
	
	return NULL;
end;

$gravar_log_unidade_medida$ language plpgsql;

create trigger gravar_log_unidade_medida after insert or update or delete on unidade_medida
	for each row execute procedure gravar_log_unidade_medida();

