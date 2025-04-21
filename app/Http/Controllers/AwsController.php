<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\Credentials\Credentials;

// Define la clase AwsController que extiende de Controller
class AwsController extends Controller
{
    // Método index que se ejecuta cuando se accede a la ruta asociada
    public function index()
    {
        // Crea un objeto de credenciales usando las variables de entorno para la clave de acceso y la clave secreta de AWS
        $credentials = new Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY'));
        
        // Crea un cliente de S3 usando la versión más reciente, la región especificada en las variables de entorno y las credenciales creadas
        $s3 = new S3Client([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => $credentials
        ]);
    }
}
