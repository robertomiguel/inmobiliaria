<?php
/*
$table->increments('id')->unique();
            $table->integer('marca_id')->unsigned();
            $table->integer('rubro_id')->unsigned();
            $table->string('plan','50');
            $table->text('descripcion');
            $table->bigInteger('click');
            $table->decimal('cuota1',7,2);
            $table->decimal('cuota2',7,2);
            $table->string('foto1');
            $table->string('foto2');
            $table->string('foto3');
            $table->string('foto4');
            $table->enum('mostrar', array('si', 'no'))->default('si');
*/
class Articulo extends Eloquent {

	protected $table = 'articulo';
	protected $primaryKey = 'id';
	public $timestamps = false;

		static public function marca($marca){
			$sql = "SELECT plan, descripcion, cuota1, foto1, foto2, foto3, foto4, marca.nombre as marca, marca.logo as logo
					  FROM articulo
					  JOIN marca ON
					  		(marca.id = articulo.marca_id)
					  JOIN rubro ON
					  		(rubro.id = articulo.rubro_id)
					 WHERE marca_id = $marca
 					 ORDER BY plan";
			$datos = DB::select($sql);
		return $datos;
	}

		static public function rubro($rubro){
			$sql = "SELECT plan, descripcion, cuota1, foto1, foto2, foto3, foto4, marca.nombre as marca, marca.logo as logo
					  FROM articulo
					  JOIN marca ON
					  		(marca.id = articulo.marca_id)
					  JOIN rubro ON
					  		(rubro.id = articulo.rubro_id)
					 WHERE rubro_id = $rubro
 					 ORDER BY plan";
			$datos = DB::select($sql);
		return $datos;
	}

		static public function buscar($buscar){
			$sql = "SELECT plan, cuota1, marca.nombre as marca, marca.logo as logo, rubro.nombre as rubro
					  FROM articulo
					  JOIN marca ON
					  		(marca.id = articulo.marca_id)
					  JOIN rubro ON
					  		(rubro.id = articulo.rubro_id)
					 WHERE plan LIKE '%$buscar%'
 					 ORDER BY plan";
			$datos = DB::select($sql);
		return $datos;
	}

		static public function confoto($marca){
			$sql = "SELECT plan, descripcion, cuota1, foto1, marca.nombre as marca, marca.logo as logo
					  FROM articulo
					  JOIN marca ON
					  		(marca.id = articulo.marca_id)
					  JOIN rubro ON
					  		(rubro.id = articulo.rubro_id)
					 WHERE foto1 <> ''
 					 ORDER BY marca";
			$datos = DB::select($sql);
		return $datos;
	}


}