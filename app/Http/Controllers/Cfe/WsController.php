<?php

namespace App\Http\Controllers\Cfe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Datos;
use App\Models\FechaAltaSicom;
use App\Models\Carterapa;
use App\Models\Sicom;
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
        //dd(auth()->user());  
        $fechaAlta=FechaAltaSicom::where('rpu',$request->rpu)->first();
        $hoy=date('Y-m-d');
        $antiguedad=$this->DiffYear($hoy,$fechaAlta->fecha_alta);
        $rezago=$this->BuscaRezago($request->rpu);        
        $npr=empty($rezago)?0:$rezago->npr;        
        $rezago_asi=($npr >= 1 )?"SI":"NO";
        
        //$bp=$this->BuenPagador($request->rpu);
        // print_r($bp);
        

        return view('datos.clientes.muestra_cliente',['datos'=>$datos,'antiguedad'=>$antiguedad,'rezago'=>$rezago_asi],compact('fechaAlta'));
    }





    public function ConsultaUsuario($rpu){
       
        $wsdl="http://portal.cfemex.com/webservices/wsFideAsi/ServiciosFideAsi.asmx?wsdl";    
        
        //instanciando un nuevo objeto cliente para consumir el webservice
        $client=new nusoap_client($wsdl,'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $client->decode_utf8 = FALSE;

        //pasando los parámetros a un array
        $param=array('rpu'=>$rpu);

        //llamando al metodo y pasandole el array con los parametros
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
        print_r($cadena);
        die();
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

    return  $cadenaDatos; //json_decode(json_encode($cadenaDatos)); 
    }


    public function DiffYear($fecha1,$fecha2){
        $f1=date_create($fecha1);
        $f2=date_create($fecha2);
        $contador=date_diff($f2,$f1);
        $formato='%y';       
        return $contador->format($formato);
    }

    public function BuscaRezago($rpu){
        $rezago=Carterapa::where('rpu',$rpu)->first();        
        return $rezago;
    }

    public function BuenPagador($rpu){
        $bp=Sicom::where('c4_RPU',$rpu)->orderBy('C4_AA_ADE','desc');
        return $bp;
    }

}
