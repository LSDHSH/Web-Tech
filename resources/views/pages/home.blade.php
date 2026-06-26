@extends('layouts.app')

@section('content')

<x-title />

@if ($errors->any())
	<div class="mb-4 rounded-lg bg-rose-50 dark:bg-rose-950/30 p-4 text-sm font-medium text-rose-700 dark:text-rose-400 ring-1 ring-rose-600/10 dark:ring-rose-500/20">
		<ul class="list-disc pl-4 space-y-1">
			@foreach ($errors->all() as $error)
				{{ $error }}
			@endforeach
		</ul>
	</div>
@endif

<div class="w-full max-w-xl bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] overflow-hidden text-left flex flex-col">
	<div class="flex flex-col divide-y-4 divide-black dark:divide-white">
		
		<x-menu.category title="Countries">
			<x-menu.link href="/countries/wordle" hoverBg="hover:bg-emerald-400 dark:hover:bg-emerald-500">Wordle</x-menu.link>
		</x-menu.category>
		
		<x-menu.category title="Movies">
			<x-menu.link href="/movies/wordle" hoverBg="hover:bg-emerald-400 dark:hover:bg-emerald-500">Wordle</x-menu.link>
		</x-menu.category>
		
		<x-menu.category title="Series">
			<x-menu.link href="/series/wordle" hoverBg="hover:bg-emerald-400 dark:hover:bg-emerald-500">Wordle</x-menu.link>
		</x-menu.category>
		
		<x-menu.category title="Games">
			<x-menu.link href="/games/wordle" hoverBg="hover:bg-emerald-400 dark:hover:bg-emerald-500">Wordle</x-menu.link>
		</x-menu.category>
		
	</div>
</div>

@endsection