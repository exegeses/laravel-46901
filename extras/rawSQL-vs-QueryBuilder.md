# ¿Cómo trabajar con base de datos?

> Laravel utiliza PDO   
> Primero tendremos que setear el archivo general de configuración.   

     .env

> Laravel utiliza dos capas de abstracción
> (clases) que nos facilitan el trabajo con SQL y 
> bases de datos      
> Estas dos clases son:

      Raw SQL
      Fluent Query Builder

<img src="imagenes/capas-rSQL%2BfQB.png">


## Raw SQL

	DB::select('SELECT ...');
	DB::insert('INSERT INTO.....');
	DB::update('UPDATE ....');
	DB::delete('DELETE FROM...');

## Fluent Query Builder

	DB::table('nTabla')->get()
	DB::table('nTabla')->select('campo, campo')->get()

	DB::table('nTable')->insert(???)
	DB::table('nTable')->where('condicion')->update(???)
	DB::table('nTable')->where('condicion')->delete()