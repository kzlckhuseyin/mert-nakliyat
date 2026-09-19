<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'MertNakliyat' }}</title>

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased text-slate-900">
    <div class="flex min-h-screen">
        <!-- Sol Menü buraya gelecek -->
        <x-sidebar />

        <!-- Sağ Ana İçerik -->
        <main class="flex-1 p-8">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
