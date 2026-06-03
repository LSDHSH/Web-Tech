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
<x-darkmode />
</html>