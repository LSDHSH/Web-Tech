@extends('layouts.app')

@section('content')
<x-auth.card active="register">
  <form action="/register" method="POST" class="p-6 sm:p-10 space-y-6 flex-1 flex flex-col justify-between">
    @csrf
    
    {{-- Error Notification --}}
    @if ($errors->any())
      <div class="mb-4 rounded-lg bg-rose-50 dark:bg-rose-950/30 p-4 text-sm font-medium text-rose-700 dark:text-rose-400 ring-1 ring-rose-600/10 dark:ring-rose-500/20">
        <ul class="list-disc pl-4 space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    
    <div class="space-y-5">
      <div>
        <label for="reg-username" class="block text-sm uppercase font-black tracking-wider mb-2 text-black dark:text-white">
          Username
        </label>
        <input type="text" id="reg-username" name="username" required placeholder="Max von Schilksee" class="w-full p-3 sm:p-4 bg-white dark:bg-stone-900 border-4 border-black dark:border-white text-black dark:text-white font-mono text-base focus:outline-none focus:bg-stone-50 dark:focus:bg-stone-800 placeholder-stone-400 dark:placeholder-stone-500 font-bold">
      </div>
      
      <div>
        <label for="reg-email" class="block text-sm uppercase font-black tracking-wider mb-2 text-black dark:text-white">
          Email Address
        </label>
        <input type="email" id="reg-email" name="email" required placeholder="your@mail.com" class="w-full p-3 sm:p-4 bg-white dark:bg-stone-900 border-4 border-black dark:border-white text-black dark:text-white font-mono text-base focus:outline-none focus:bg-stone-50 dark:focus:bg-stone-800 placeholder-stone-400 dark:placeholder-stone-500 font-bold">
      </div>
      
      <div>
        <label for="reg-password" class="block text-sm uppercase font-black tracking-wider mb-2 text-black dark:text-white">
          Password
        </label>
        <input type="password" id="reg-password" name="password" required placeholder="At least 8 characters" class="w-full p-3 sm:p-4 bg-white dark:bg-stone-900 border-4 border-black dark:border-white text-black dark:text-white font-mono text-base focus:outline-none focus:bg-stone-50 dark:focus:bg-stone-800 placeholder-stone-400 dark:placeholder-stone-500 font-bold">
      </div>
    </div>
    
    <x-form.submit-button type="submit">
      Create Account →
    </x-form.submit-button>
  </form>
</x-auth.card>
@endsection