@extends('layouts.app')

@section('content')
<div class="w-full max-w-[600px] bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] overflow-hidden text-left flex flex-col p-6 sm:p-10">
    <div class="text-center mb-8">
      <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-stone-100 dark:bg-stone-800 text-3xl border-4 border-black dark:border-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)]">
        🔒
      </div>
      <h2 class="mt-6 text-2xl font-black uppercase tracking-wider text-black dark:text-white">Two-Factor Protection</h2>
      <p class="mt-2 text-sm font-bold uppercase tracking-wide text-stone-500 dark:text-stone-400">We have sent a 6-digit code to your email address.</p>
    </div>
    
    @if (session('status'))
      <div class="mb-4 rounded-lg bg-emerald-50 dark:bg-emerald-950/30 p-4 text-center text-sm font-medium text-emerald-700 dark:text-emerald-400 ring-1 ring-emerald-600/10 dark:ring-emerald-500/20">
        {{ session('status') }}
      </div>
    @endif
    
    @if ($errors->has('code'))
      <div class="mb-4 rounded-lg bg-rose-50 dark:bg-rose-950/30 p-4 text-center text-sm font-medium text-rose-700 dark:text-rose-400 ring-1 ring-rose-600/10 dark:ring-rose-500/20">
        {{ $errors->first('code') }}
      </div>
    @endif
  
  <form action="/2fa" method="POST" class="space-y-6">
    @csrf
    <div>
      <label for="code" class="block text-sm uppercase font-black tracking-wider text-black dark:text-white mb-2">
        Enter Verification Code
      </label>
      <div class="mt-1">
        <input type="text" id="code" name="code" placeholder="123456" required autofocus class="w-full p-3 sm:p-4 bg-white dark:bg-stone-900 border-4 border-black dark:border-white text-black dark:text-white font-mono text-2xl font-black text-center tracking-[0.3em] focus:outline-none focus:bg-white dark:focus:bg-stone-800 placeholder-stone-300 dark:placeholder-stone-600">
      </div>
    </div>
    
    <div>
      <x-form.submit-button type="submit">
        Verify Code →
      </x-form.submit-button>
    </div>
  </form>
  
  <div class="mt-6 text-center">
    <a href="/2fa-resend" class="text-xs uppercase tracking-wider text-stone-400 dark:text-stone-500 hover:text-black dark:hover:text-white hover:underline font-bold transition-colors">
      Resend Code
    </a>
  </div>
</div>
@endsection