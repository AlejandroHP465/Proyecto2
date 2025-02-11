<?php
// rss_europapress.php
// URL del RSS de EuropaPress
$rss_url = "https://www.europapress.es/rss/rss.aspx?ch=00066";

// Cargar XML del RSS
$rss = simplexml_load_file($rss_url);
if ($rss === false) {
    die("Error al cargar el canal RSS.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Noticias EuropaPress</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-center mb-6">Noticias EuropaPress</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-3 px-4 bg-gray-200 border-b">Noticia</th>
                        <th class="py-3 px-4 bg-gray-200 border-b">Descripción</th>
                        <th class="py-3 px-4 bg-gray-200 border-b">Link</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rss->channel->item as $item): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b"><?php echo $item->title; ?></td>
                            <td class="py-3 px-4 border-b"><?php echo $item->description; ?></td>
                            <td class="py-3 px-4 border-b">
                                <a class="text-blue-500 hover:underline" href="<?php echo $item->link; ?>" target="_blank">Ver noticia</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
