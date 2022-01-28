<?php

namespace App\Http\Controllers\Cfe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  Illuminate\Support\Collection;
use App\Models\Datos;
use nusoap_client;


class WsController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:datos.index')->only(['index']);        
    }

    public function index()
    {
        return view('datos.clientes.busca_cliente');
    }

    public function BuscaCliente(Request $request){

        //$rpu="019860688479";
        $datos=$this->ConsultaUsuario($request->rpu);   
        //print_r($datos);
       // dd($datos);
        return view('datos.clientes.muestra_cliente',['datos'=>$datos]);
    }





    public function ConsultaUsuario($rpu){
       
        $wsdl="http://portal.cfemex.com/webservices/wsFideAsi/ServiciosFideAsi.asmx?wsdl";    
        
        //instanciando un nuevo objeto cliente para consumir el webservice
        $client=new nusoap_client($wsdl,'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $client->decode_utf8 = FALSE;

        //pasando los parámetros a un array
        $param=array('rpu'=>$rpu);

        //llamando al método y pasándole el array con los parámetros
        $resultado = $client->call('ConsultaServicio', $param);
        if ($client->fault){ 
            $error = $client->getError();
            if ($error) { 
                    //echo 'Error:' . $error;
                    //echo 'Error2:' . $error->faultactor;
                    //echo 'Error3:' . $error->faultdetail;faultstring
                    echo 'Error:  ' . $client->faultstring;
                }            
            die();
        }
        $cadena=$resultado['ConsultaServicioResult']; 
        //print_r($cadena);
        $cadenaDatos=array();

    //return $resultado['ConsultaServicioResult']; 
    $cadenaDatos["estatus"]=substr($cadena,0,2);
    $cadenaDatos["rpu"]=substr($cadena,2,12);
    $cadenaDatos["numCta"]=substr($cadena,23,16);
    $cadenaDatos["tipoFac"]=substr($cadena,39,1);
    $cadenaDatos["nombre"]=trim(substr($cadena,40,30));
    $cadenaDatos["direccion"]=trim(substr($cadena,70,30));
    $cadenaDatos["ciudad"]=trim(substr($cadena,100,20));
    $cadenaDatos["estado"]=trim(substr($cadena,120,5));
    $cadenaDatos["tarifa"]=substr($cadena,129,2);
    $cadenaDatos["fechadesde"]=substr($cadena,138,8);
    $cadenaDatos["fechahasta"]=substr($cadena,146,8);
    $cadenaDatos["fechalimite"]=substr($cadena,154,8);
    $cadenaDatos["numMedidor"]=trim(substr($cadena,473,7));
    $cadenaDatos["colonia"]=trim(substr($cadena,1252,30));    
    $cadenaDatos["division"]=substr($cadena,25,2);
    $cadenaDatos["zona"]=substr($cadena,27,2);
    $cadenaDatos["agencia"]=substr($cadena,29,1);
    $cadenaDatos["estatusSRV"]=substr($cadena,20,2);    
    $cadenaDatos["empleado"]=substr($cadena,1880,6);

        /*$obj=new Datos();
        $obj->estatus=substr($cadena,0,2);
        $obj->rpu=substr($cadena,2,12);
        $obj->numCta=substr($cadena,23,16);
        $obj->tipoFac=substr($cadena,39,1);
        $obj->nombre=trim(substr($cadena,40,30));
        $obj->direccion=trim(substr($cadena,70,30));
        $obj->ciudad=trim(substr($cadena,100,20));
        $obj->estado=trim(substr($cadena,120,5));
        $obj->tarifa=substr($cadena,129,2);
        $obj->fechadesde=substr($cadena,138,8);
        $obj->fechahasta=substr($cadena,146,8);
        $obj->fechalimite=substr($cadena,154,8);
        $obj->numMedidor=trim(substr($cadena,473,7));
        $obj->colonia=trim(substr($cadena,1252,30)); 
        $obj->division=substr($cadena,25,2);
        $obj->zona=substr($cadena,27,2);
        $obj->agencia=substr($cadena,29,1);
        $obj->estatusSRV=substr($cadena,20,2);  
        $obj->empleado=substr($cadena,1880,6);*/

    return  $cadenaDatos; //json_decode(json_encode($cadenaDatos));
   
    

    }

}
