@extends('layouts.app')

@section('content')
<x-title />

<div class="w-full max-w-2xl text-center px-4">
  <p class="text-sm mb-5 uppercase tracking-widest text-stone-400 dark:text-stone-500 mt-12 px-6 font-sans font-bold">
    Countries • Movies • Series • Games
  </p>
  
  <div class="bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] overflow-hidden transition-all">
    <div class="p-10 flex flex-col gap-5 bg-white dark:border-white bg-stone-50 dark:bg-stone-800">
      <a href="/register" class="w-full py-4 px-6 bg-white dark:bg-stone-800 hover:bg-stone-100 dark:hover:bg-stone-800 text-black dark:text-white font-black uppercase tracking-wider text-lg border-4 border-black dark:border-white transition-colors text-center">
        Sign up
      </a>
      
      <a href="/login" class="w-full py-3 px-6 bg-transparent hover:underline text-stone-600 dark:text-stone-400 hover:text-black dark:hover:text-white font-black uppercase tracking-wider text-lg transition-all text-center">
        Log in
      </a>
    </div>
  </div>
  
  <div class="w-full mt-8 aspect-video border-4 border-black dark:border-white shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] dark:shadow-[6px_6px_0px_0px_rgba(255,255,255,1)] bg-black">
    <iframe 
      class="w-full h-full" 
      src="https://www.youtube.com/embed/dQw4w9WgXcQ" 
      title="YouTube video player" 
      frameborder="0" 
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
      allowfullscreen>
    </iframe>
  </div>
</div>
@endsection