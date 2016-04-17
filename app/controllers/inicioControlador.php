<?php

class InicioControlador extends BaseController {

	public function index()
	{	

		return View::make('portal.portal');
	}

}
