<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Agregar estilos aquí -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css'])
</head>
<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
        </nav> --}}

        <main class="py-4">
            <div class="container">
                <h1>Política de Privacidad</h1>
            
                <p>Fecha de entrada en vigor: 08/01/2025</p>
            
                <p>En Formularios Mor, nos comprometemos a proteger la privacidad de nuestros usuarios. Esta política de privacidad describe cómo recopilamos, utilizamos, compartimos y protegemos su información personal cuando utiliza nuestra aplicación Formularios Mor.</p>
            
                <h2>1. Información que recopilamos</h2>
                <p>Podemos recopilar los siguientes tipos de información:</p>
                <ul>
                    <li><strong>Información personal:</strong> Datos que usted proporciona al registrarse, como nombre, dirección de correo electrónico, número de teléfono u otra información identificativa.</li>
                    <li><strong>Información de uso:</strong> Información sobre cómo utiliza la Aplicación, incluyendo la frecuencia de uso, las páginas visitadas, las características accedidas, el dispositivo que utiliza y su dirección IP.</li>
                    <li><strong>Información de ubicación:</strong> Si usted otorga su consentimiento, podemos recopilar información precisa o aproximada de su ubicación mediante tecnologías GPS, Wi-Fi o datos de red.</li>
                </ul>

                <h2>2. Uso de la información</h2>
                <p>Utilizamos la información que recopilamos para los siguientes propósitos:</p>
                <ul>
                    <li>Proveer y mejorar la funcionalidad de la Aplicación.</li>
                    <li>Gestionar su cuenta y personalizar su experiencia.</li>
                    <li>Enviar notificaciones y comunicaciones importantes, como cambios en las políticas, actualizaciones del servicio, promociones y ofertas.</li>
                    <li>Procesar transacciones y asegurar la protección contra fraudes.</li>
                    <li>Cumplir con las leyes y regulaciones aplicables.</li>
                </ul>

                <h2>3. Compartir información con terceros</h2>
                <p>No vendemos ni alquilamos su información personal a terceros. Sin embargo, podemos compartir su información en los siguientes casos:</p>
                <ul>
                    <li><strong>Proveedores de servicios:</strong> Podemos compartir información con terceros proveedores de servicios que nos ayuden a operar la Aplicación, como procesadores de pagos, servicios de análisis y proveedores de hosting.</li>
                    <li><strong>Cumplimiento legal:</strong> Podemos divulgar su información si es requerido por ley o en respuesta a solicitudes legales, como órdenes judiciales o investigaciones gubernamentales.</li>
                    <li><strong>Transferencias comerciales:</strong> Si vendemos o transferimos parte o la totalidad de nuestro negocio o activos, su información puede ser transferida como parte de dicha transacción.</li>
                </ul>

                <h2>4. Seguridad de la información</h2>
                <p>Nos comprometemos a proteger su información personal mediante medidas de seguridad físicas, electrónicas y administrativas diseñadas para reducir el riesgo de acceso no autorizado, pérdida, alteración o divulgación. Sin embargo, no podemos garantizar la seguridad absoluta de su información debido a la naturaleza de internet.</p>

                <h2>5. Retención de la información</h2>
                <p>Retendremos su información personal solo durante el tiempo que sea necesario para cumplir con los propósitos descritos en esta política, a menos que la ley requiera o permita un período de retención más largo.</p>

                <h2>6. Derechos del usuario</h2>
                <p>Dependiendo de su ubicación, puede tener los siguientes derechos con respecto a su información personal:</p>
                <ul>
                    <li>Acceder a su información personal.</li>
                    <li>Corregir información inexacta o incompleta.</li>
                    <li>Solicitar la eliminación de su información.</li>
                    <li>Restringir u oponerse al procesamiento de su información.</li>
                    <li>Solicitar la portabilidad de su información.</li>
                </ul>
                <p>Para ejercer estos derechos, puede contactarnos en contacto@isdtconsulting.com.</p>

                <h2>7. Cambios en la política de privacidad</h2>
                <p>Nos reservamos el derecho de modificar esta política de privacidad en cualquier momento. Si realizamos cambios materiales, le notificaremos mediante un aviso dentro de la Aplicación o por otros medios, para que pueda revisar los cambios antes de continuar utilizando la Aplicación.</p>

                <h2>8. Contacto</h2>
                <p>Si tiene alguna pregunta o inquietud sobre esta política de privacidad, puede contactarnos en:</p>
                <p>
                    ISDT Consulting<br>
                    contacto@isdtconsulting.com
                </p>

            </div>
        </main>
    </div>

    <!-- Agregar scripts aquí -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
