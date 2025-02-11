<?php
// cliente.php
$options = [
    'uri' => 'http://localhost/SOAP/',
    'location' => 'http://localhost/SOAP/1/servicio.php',
    'trace' => 1,
    'exceptions' => true
];

$cliente = new SoapClient(null, $options);

try {
    // Obtener módulo por ID
    $modulo = json_decode($cliente->infoModulo(1), true);

    ob_start();
    ?>
    <div class="mb-6">
        <h2 class="text-2xl font-bold mb-2">Módulo</h2>
        <?php if (json_last_error() !== JSON_ERROR_NONE || !$modulo): ?>
            <p class="text-red-500">No existen datos en el módulo.</p>
        <?php else: ?>
            <pre class="bg-gray-100 p-4 rounded shadow"><?php print_r($modulo); ?></pre>
        <?php endif; ?>
    </div>
    <?php

    // Obtener departamentos
    $departamentos = json_decode($cliente->infoDepartamentos(), true);
    ?>
    <div class="mb-6">
        <h2 class="text-2xl font-bold mb-2">Departamentos</h2>
        <?php if (json_last_error() !== JSON_ERROR_NONE || !$departamentos): ?>
            <p class="text-red-500">No existen datos en los departamentos.</p>
        <?php else: ?>
            <pre class="bg-gray-100 p-4 rounded shadow"><?php print_r($departamentos); ?></pre>
        <?php endif; ?>
    </div>
    <?php

    // Obtener nomenclaturas
    $nomenclaturas = json_decode($cliente->infoNomenclaturas(), true);
    ?>
    <div class="mb-6">
        <h2 class="text-2xl font-bold mb-2">Nomenclaturas</h2>
        <?php if (json_last_error() !== JSON_ERROR_NONE || !$nomenclaturas): ?>
            <p class="text-red-500">No existen datos en las nomenclaturas.</p>
        <?php else: ?>
            <pre class="bg-gray-100 p-4 rounded shadow"><?php print_r($nomenclaturas); ?></pre>
        <?php endif; ?>
    </div>
    <?php

    $output = ob_get_clean();
} catch (SoapFault $e) {
    $output = '<p class="text-red-500 font-bold">Error en el servicio SOAP: ' . $e->getMessage() . '</p>';
} catch (Exception $e) {
    $output = '<p class="text-red-500 font-bold">Error general: ' . $e->getMessage() . '</p>';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cliente SOAP</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-center">Cliente SOAP</h1>
        <?php echo $output; ?>
    </div>
</body>
</html>
