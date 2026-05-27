<!DOCTYPE html>
<html lang="de" class="h-full bg-stone-50 text-black">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guessle</title>
    
    <link rel="icon" href="/images/Logo.ico" type="image/x-icon">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Optionale Konfiguration, falls ihr später Custom-Farben oder Darkmode braucht
        tailwind.config = {
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
<body class="flex flex-col items-center justify-center min-h-screen p-6 font-mono antialiased bg-stone-50 selection:bg-black selection:text-white">

    <main class="flex flex-col items-center justify-center w-full">
        @yield('content')
    </main>

    <script src="/js/app.js"></script>
</body>
</html>