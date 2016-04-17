<?php 
class adminControlador extends BaseController {

//--- Prefijos : get , post, any

    public function inicio()
    {
    	return View::make('admin.inicio');
    }

    public function crearlistado()
    {
    	$marcas = Autos::marcas();
    	return View::make('admin.crearlistado')->with('marcas',$marcas);
    }

    public function verlistadoautos()
    {
    	$lista = Input::get('lista');
    	$autos = Autos::listar($lista);
    	return View::make('admin.listaautos')->with('autos',$autos);
    }

    public function imprimirlistado()
    {
    	$lista = Input::get('lista');
    	//$lista = "'WULING', 'VOLVO', 'VOLKSWAGEN', 'TOYOTA'";
    	//$lista = "'TATA'";
    	
    	$autos = Autos::listar($lista);

/*
		$pdf = App::make('dompdf');
		$pdf->loadHTML(View::make('admin.listaautos')->with('autos',$autos))->setWarnings(false)->setPaper('a4');
		
		return $pdf->stream('listado_autos');
*/
		/*
		$html = View::make('admin.pdflistaautos')->with('autos',$autos);
		PDF::SetTitle('Hello World: '. $lista);
		PDF::AddPage();
		//PDF::Write(0, 'Hello World');
		PDF::writeHTML($html, true, false, true, false, '');
		PDF::Output('hello_world.pdf');
		*/
		return View::make('admin.listaautos')->with('autos',$autos);
    }

    public function imprimirlistadovendedor()
    {
        $lista = Input::get('lista');
        $membrete = Input::get('membrete');
        $parm = ParametrosListados::todos();
        $adjudica = $parm[0]->adjudica;
        $gastos_admin = $parm[0]->gastos_admin;
        $autos = Autos::listavendedor($lista);
        return View::make('admin.listaautosvendedor')->with('autos',$autos)
        											 ->with('membrete', $membrete)
        											 ->with('adjudica',$adjudica)
        											 ->with('gastos_admin',$gastos_admin);
    }
}