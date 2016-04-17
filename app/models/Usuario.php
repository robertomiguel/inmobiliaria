<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

  
  protected $connection  = 'universal';
  protected $table       = 'suscriptor';
	protected $primaryKey  = 'id';
	public    $timestamps  = false;

	protected $hidden = array('usr_nombre', 'usr_recordar_token');

  static public function actualizaFechaIp()
  {
/*
      $nro_persona = Auth::user()->nro_persona;
      //$ip = Request::getClientIp();
      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
          $ip = $_SERVER['HTTP_CLIENT_IP'];
          } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
          } else {
          $ip = $_SERVER['REMOTE_ADDR'];
      }
      log::info("Conexion desde: '$ip'");
      $dt = new DateTime('NOW');
      $fecha = $dt->format('Y-m-d H:i:s');
      $resultado = DB::update("
                 UPDATE hb_usuario
                    SET ultima_ip = '$ip', ultimo_acceso =  convert(datetime ,'$fecha',120)
                  WHERE nro_persona = $nro_persona
                  ");
*/
  }

	public function getAuthIdentifier()
  {
    return $this->getKey();
  }
  
  public function getAuthPassword()
  {
    return $this->usr_nombre;
  } 
  
  public function getRememberToken()
  {
    return $this->usr_recordar_token;
  }
  
  public function setRememberToken($value)
  {
    $this->usr_recordar_token = $value;
  }
  
  public function getRememberTokenName()
  {
    return "usr_recordar_token";
  }
  
  public function getReminderEmail()
  {
    return $this->usr_nombre;
  }
}
