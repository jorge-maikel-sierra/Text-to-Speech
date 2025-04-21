# Polly Text-to-Speech - Conversor de texto a voz

## Tabla de contenidos
- [Resumen](#resumen)
  - [El proyecto](#el-proyecto)
  - [Capturas de pantalla](#capturas-de-pantalla)
  - [Enlaces](#enlaces)
- [Mi proceso](#mi-proceso)
  - [Construido con](#construido-con)
  - [Lo que aprendí](#lo-que-aprendí)
  - [Desarrollo continuo](#desarrollo-continuo)
  - [Recursos útiles](#recursos-útiles)
- [Autor](#autor)
- [Agradecimientos](#agradecimientos)

## Resumen

### El proyecto
Los usuarios deberían poder:
- Introducir texto para convertir a voz usando el servicio AWS Polly
- Seleccionar diferentes voces disponibles (Amy, Ricardo, Conchita, Enrique, Lucia)
- Elegir entre variantes del idioma español (España o EE.UU.)
- Ver mensajes de retroalimentación, tanto de éxito como de error
- Disfrutar de una interfaz atractiva e intuitiva con tema oscuro

### Capturas de pantalla
![Vista previa del diseño en escritorio](desktop-preview.png)

### Enlaces
- URL de solución: [URL GITHUB](#)
- URL del sitio en directo: [URL PRODUCCION](#)

## Mi proceso

### Construido con
- Laravel + Livewire
- HTML5 semántico
- CSS avanzado con variables personalizadas
- Flexbox para el diseño de componentes
- AWS Polly para la conversión de texto a voz
- SVG icons para mejorar la experiencia visual
- Diseño adaptable (responsive design)

### Lo que aprendí
Durante este proyecto, profundicé en la integración de servicios AWS con Laravel y mejoré mis habilidades en CSS. Algunos puntos clave incluyen:

- **Integración con AWS Polly**: Aprendí a configurar y consumir el servicio de Amazon para transformar texto en voz natural.

```php
public function generatePolly()
{
    // Validación del texto de entrada
    $this->validate([
        'text' => 'required|min:3|max:1000',
    ]);
    
    // Integración con AWS Polly
    try {
        $result = $this->pollyService->synthesizeSpeech($this->text, $this->voiceId, $this->languageCode);
        // Procesar resultado...
        session()->flash('success', '¡Audio generado correctamente!');
    } catch (\Exception $e) {
        session()->flash('error', 'Error al generar el audio: ' . $e->getMessage());
    }
}
```

- **Diseño de interfaz oscura**: Implementé un tema oscuro elegante y accesible utilizando variables CSS para mantener la consistencia.

```css
:root {
  --bg-dark: #1a202c;
  --bg-darker: #2d3748;
  --text-light: #f7fafc;
  --text-muted: #cbd5e0;
  --accent: #667eea;
  --accent-hover: #764ba2;
  --border-color: #4a5568;
}
```

- **Componentes interactivos**: Diseñé estados hover y focus para mejorar la experiencia del usuario.

```css
.button:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
}

select:focus {
  border-color: var(--accent);
  box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
}
```

### Desarrollo continuo
Quiero seguir mejorando mis habilidades en:
- Optimización de servicios de AWS para reducir latencia
- Implementación de animaciones más sofisticadas en CSS
- Explorar tecnologías de reconocimiento y síntesis de voz más avanzadas

### Recursos útiles
- [Documentación de AWS Polly](https://docs.aws.amazon.com/polly/) - Fundamental para entender cómo integrar el servicio en Laravel.
- [Laravel Livewire](https://laravel-livewire.com/) - Documentación que me ayudó a crear componentes interactivos sin necesidad de escribir JavaScript.
- [CSS Tricks](https://css-tricks.com/) - Un recurso útil para aprender técnicas avanzadas de CSS y diseños responsivos.
- [Mozilla MDN](https://developer.mozilla.org/) - Referencia técnica para HTML, CSS y accesibilidad web.

## Autor
- GitHub - [@jorge-maikel-sierra](https://github.com/jorge-maikel-sierra)
- Frontend Mentor - [@jorge-maikel-sierra](https://www.frontendmentor.io/profile/jorge-maikel-sierra)
- Twitter - [@Jorge_Sierra_1](https://x.com/Jorge_Sierra_1)

## Agradecimientos
Quiero expresar mi más profundo agradecimiento a Nolger Rodriguez por su continuo apoyo y colaboración. Gracias por creer en mí, tanto como desarrollador como persona. Tu confianza y guía han sido fundamentales en mi crecimiento profesional y personal.