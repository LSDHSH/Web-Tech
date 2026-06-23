<!DOCTYPE html>
<html lang="en" class="h-full bg-stone-50 text-black">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Guessle</title>
	<link rel="icon" href="/images/Logo.ico" type="image/x-icon">
	<script src="/js/tailwindcss.js"></script>
	
	<script>
		tailwind.config =
		{
			darkMode: 'class',
			theme:
			{
				extend:
				{
					animation:
					{
						fadeIn: 'fadeIn 0.2s ease-out forwards',
					},
					keyframes:
					{
						fadeIn:
						{
							'0%': { opacity: '0', transform: 'translateY(4px)' },
							'100%': { opacity: '1', transform: 'translateY(0)' },
						}
					}
				}
			}
		}
	</script>
</head>

<header>
<div class="fixed top-6 left-6 right-6 flex items-center gap-3 z-50">
		<x-nav.button id="theme-toggle" onclick="toggleDarkMode()" class="mr-auto">
			<span class="dark:hidden">🌙</span>
			<span class="hidden dark:inline">☀️</span>
		</x-nav.button> 
		
		@auth
			<header class="contents">
				@include('partials._header')
			</header>
		@endauth
	</div>
</header>

<body class="relative flex flex-col items-center justify-center min-h-screen p-4 md:p-10 font-mono antialiased bg-stone-50 dark:bg-stone-950 text-black dark:text-white transition-colors duration-200">
	
	
	<main class="flex flex-col items-center justify-center w-full">
		@yield('content')
	</main>
	
	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>