<?php
$canonical = "https://{$subdomain}.votreartisanpro.fr/";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($artisan['nom_commercial']) ?> - <?= $artisan['metier'] ?> à <?= $artisan['commune'] ?></title>
    <meta name="description" content="<?= htmlspecialchars($artisan['metier'] . ' à ' . $artisan['commune']) ?>">
    <link rel="canonical" href="<?= $canonical ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($artisan['nom_commercial']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($artisan['metier'] . ' à ' . $artisan['commune']) ?>">
    <meta property="og:type" content="website">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

<div class="max-w-5xl mx-auto p-6">

    <!-- Header artisan -->
    <header class="text-center mb-8">
        <img src="<?= htmlspecialchars($artisan['image_leader']) ?>" alt="Image leader" class="mx-auto rounded shadow-lg mb-4 max-h-80 object-cover">
        <h1 class="text-3xl font-bold mb-2"><?= htmlspecialchars($artisan['nom_commercial']) ?></h1>
        <p class="text-lg"><?= htmlspecialchars($artisan['metier']) ?> - <?= htmlspecialchars($artisan['commune']) ?></p>
        <p>Email : <a href="mailto:<?= htmlspecialchars($artisan['email']) ?>" class="text-blue-600"><?= htmlspecialchars($artisan['email']) ?></a></p>
        <p>Téléphone : <a href="tel:<?= htmlspecialchars($artisan['telephone']) ?>" class="text-blue-600"><?= htmlspecialchars($artisan['telephone']) ?></a></p>

        <!-- Réseaux sociaux -->
        <div class="mt-4 space-x-4">
            <?php if ($artisan['instagram']): ?>
                <a href="<?= htmlspecialchars($artisan['instagram']) ?>" target="_blank" class="text-pink-500 font-semibold">Instagram</a>
            <?php endif; ?>
            <?php if ($artisan['facebook']): ?>
                <a href="<?= htmlspecialchars($artisan['facebook']) ?>" target="_blank" class="text-blue-600 font-semibold">Facebook</a>
            <?php endif; ?>
            <?php if ($artisan['tiktok']): ?>
                <a href="<?= htmlspecialchars($artisan['tiktok']) ?>" target="_blank" class="text-black font-semibold">TikTok</a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Sections -->
    <?php foreach ($sections as $section): ?>
        <section class="mb-10 bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-4"><?= htmlspecialchars($section['titre']) ?></h2>
            <p class="mb-4"><?= nl2br(htmlspecialchars($section['texte'])) ?></p>

            <?php if (!empty($section['photos'])): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <?php foreach (json_decode($section['photos']) as $photo): ?>
                        <img src="<?= htmlspecialchars($photo) ?>" alt="Photo section" class="rounded shadow object-cover w-full h-48">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    <?php endforeach; ?>

</div>

</body>
</html>