<?php

namespace App\Livewire;

use Livewire\Component;
use Aws\Polly\PollyClient;
use Aws\Credentials\Credentials;
use Illuminate\Support\Facades\Storage;
use Aws\Exception\AwsException;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

// Define la clase Polly que extiende de Component de Livewire
class Polly extends Component
{
    // Propiedades públicas que se pueden usar en la vista
    public $text = '';
    public $voiceId = 'Amy';
    public $engine = 'standard';
    public $languageCode = 'es-ES';
    public $outputFormat = 'mp3';

    // Reglas de validación para las propiedades
    protected $rules = [
        'text' => 'required|string|max:3000',
        'voiceId' => 'required|string',
        'engine' => 'required|string|in:standard,neural',
        'languageCode' => 'required|string',
        'outputFormat' => 'required|string|in:mp3,ogg_vorbis,pcm',
    ];

    // Método para renderizar la vista asociada
    public function render()
    {
        return view('livewire.polly');
    }

    // Método para generar el audio usando AWS Polly
    public function generatePolly()
    {
        // Valida las propiedades según las reglas definidas
        $this->validate();

        // Verifica que el texto esté codificado en UTF-8
        if (!mb_check_encoding($this->text, 'UTF-8')) {
            $this->addError('text', 'El texto debe estar codificado en UTF-8.');
            return;
        }

        // Crea un objeto de credenciales usando las variables de entorno para la clave de acceso y la clave secreta de AWS
        $credentials = new Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY'));

        // Crea un cliente de Polly usando la versión más reciente, la región especificada en las variables de entorno y las credenciales creadas
        $polly = new PollyClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => $credentials
        ]);

        try {
            // Llama al método synthesizeSpeech de Polly para generar el audio
            $result = $polly->synthesizeSpeech([
                'VoiceId' => $this->voiceId,
                'Engine' => $this->engine,
                'LanguageCode' => $this->languageCode,
                'OutputFormat' => $this->outputFormat,
                'Text' => $this->text,
            ]);

            // Verifica si la respuesta contiene el flujo de audio
            if ($result->hasKey('AudioStream')) {
                $audioStream = $result->get('AudioStream')->getContents();
                $filename = 'polly-output-' . time() . '.' . $this->outputFormat;
                // Guarda el audio generado en el almacenamiento público
                Storage::disk('public')->put('audio/' . $filename, $audioStream);
                $filePath = storage_path('app/public/audio/' . $filename);

                // Muestra un mensaje de éxito en la sesión
                session()->flash('success', 'Audio generado y listo para descargar.');

                // Retorna una respuesta de descarga del archivo de audio y lo elimina después de enviarlo
                return Response::download($filePath, $filename)->deleteFileAfterSend(true);
            } else {
                // Registra un error si no se encuentra el flujo de audio en la respuesta
                Log::error('La respuesta de Polly no contiene el flujo de audio.');
                $this->addError('polly', 'Error al generar el audio.');
            }

        } catch (AwsException $e) {
            // Maneja excepciones específicas de AWS Polly
            Log::error('Error de AWS Polly: ' . $e->getMessage());
            $this->addError('polly', 'Ocurrió un error al comunicarse con AWS Polly.');
        } catch (\Exception $e) {
            // Maneja excepciones generales
            Log::error('Error general: ' . $e->getMessage());
            $this->addError('general', 'Ocurrió un error inesperado.');
        }
    }
}