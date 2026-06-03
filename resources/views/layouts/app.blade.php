<!DOCTYPE html>
<html lang="de" class="h-full bg-stone-50 text-black">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guessle</title>
    
    <link rel="icon" href="/images/Logo.ico" type="image/x-icon">
    
    <script
        src="https://cdn.tailwindcss.com">
        // TODO: Tailwind lokal einbinden, damit es auch ohne Internetverbindung funktioniert
    </script>

    <script>
        // 1. Sofort prüfen und Klasse setzen bevor die Seite gerendert wird
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        // Tailwind Konfiguration
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    animation: {
                        fadeIn: 'fadeIn 0.2s ease-out forwards',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(4px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="flex flex-col items-center justify-center min-h-screen p-4 md:p-10 font-mono antialiased bg-stone-50 dark:bg-stone-950 text-black dark:text-white transition-colors duration-200">
    <button onclick="toggleDarkMode()" id="theme-toggle" class="fixed top-6 right-6 p-3 bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] dark:hover:shadow-[2px_2px_0px_0px_rgba(255,255,255,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none font-black uppercase tracking-wider text-sm transition-all z-50 cursor-pointer">
        <span class="dark:hidden">🌙</span>
        <span class="hidden dark:inline">☀️</span>
    </button>

    <main class="flex flex-col items-center justify-center w-full">
        @yield('content')
    </main>

    <script>
        // Darkmode Toggle
        function toggleDarkMode() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
    </script>
    <script src="/js/app.js"></script>
</body>
</html>