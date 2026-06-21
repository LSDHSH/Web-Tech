@extends('layouts.app')

@section('content')

<div class="text-center w-full max-w-xl mb-6 shrink-0 px-4">
  <h1 class="text-5xl md:text-7xl font-black tracking-tighter uppercase text-black dark:text-white">
    Profile
  </h1>
</div>

<div class="w-full max-w-xl flex flex-col gap-y-4">
  
  <div class="w-full flex justify-center py-2">
    <a href="/home" class="inline-flex items-center text-sm uppercase tracking-wider text-stone-500 hover:text-black dark:hover:text-white font-black transition-colors cursor-pointer">
      ← Return back home
    </a>
  </div>
  
  @if(session('success'))
    <div class="w-full p-4 bg-green-400 dark:bg-green-600 border-4 border-black dark:border-white text-black dark:text-white font-black uppercase text-sm shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)]">
      {{ session('success') }}
    </div>
  @endif
  
  @if($errors->any())
    <div class="w-full p-4 bg-red-400 dark:bg-red-700 border-4 border-black dark:border-white text-black dark:text-white font-black uppercase text-sm shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)] flex flex-col gap-y-1">
      @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
      @endforeach
    </div>
  @endif
  
  <div class="w-full bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] overflow-hidden">
    
    <div class="p-6 border-b-4 border-black dark:border-white bg-stone-50 dark:bg-stone-800 font-black text-lg uppercase tracking-wider text-black dark:text-white">
      Account-Details
    </div>
    
    <form action="/profile/update" method="POST" class="p-6 md:p-8 flex flex-col gap-y-6">
      @csrf
      @method('PUT')
      
      <div>
        <label class="block text-sm uppercase font-black tracking-wider mb-2 text-black dark:text-white">Username</label>
        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full p-4 bg-stone-100 dark:bg-stone-800 border-4 border-black dark:border-white text-black dark:text-white font-mono text-lg focus:outline-none focus:bg-white dark:focus:bg-stone-900 font-black">
      </div>
      
      <div>
        <label class="block text-sm uppercase font-black tracking-wider mb-2 text-black dark:text-white">E-Mail</label>
        <input type="email" value="{{ auth()->user()->email }}" disabled class="w-full p-4 bg-stone-100 dark:bg-stone-800 border-4 border-black dark:border-white text-stone-500 dark:text-stone-400 font-mono text-lg font-bold cursor-not-allowed opacity-70">
      </div>
      
      <div class="border-t-4 border-black dark:border-white pt-6">
        <label class="block text-sm uppercase font-black tracking-wider mb-2 text-black dark:text-white">New Password?</label>
        <input type="password" name="password" placeholder="••••••••" class="w-full p-4 bg-white dark:bg-stone-900 border-4 border-black dark:border-white text-black dark:text-white font-mono text-lg focus:outline-none placeholder-stone-400 font-bold">
      </div>
      
      <div class="flex flex-col sm:flex-row gap-4 mt-2">
        <button type="submit" class="flex-1 py-4 bg-black dark:bg-white text-white dark:text-black hover:bg-stone-800 dark:hover:bg-stone-200 font-black text-lg tracking-wide uppercase transition-colors cursor-pointer text-center border-4 border-black dark:border-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all">
          Save Changes
        </button>
      </div>
    </form>
    
    <div class="p-6 bg-stone-50 dark:bg-stone-800 border-t-4 border-black dark:border-white flex flex-col sm:flex-row justify-between items-center gap-4">
      <span class="text-xs uppercase font-black tracking-wider text-stone-500 dark:text-stone-400">End session?</span>
      
      <form action="/logout" method="POST" class="w-full sm:w-auto">
        @csrf
        <button type="submit" class="w-full sm:w-auto py-2 px-6 bg-stone-200 dark:bg-stone-700 hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black text-black dark:text-white font-black uppercase tracking-wider text-sm border-4 border-black dark:border-white transition-all cursor-pointer text-center">
          Logout
        </button>
      </form>
    </div>
    
    <div class="p-6 bg-red-100 dark:bg-red-950/30 border-t-4 border-black dark:border-white flex flex-col sm:flex-row justify-between items-center gap-4">
      <div class="flex flex-col">
        <span class="text-xs uppercase font-black tracking-wider text-red-600 dark:text-red-400">Danger Zone</span>
        <span class="text-[10px] uppercase font-bold text-stone-500 dark:text-stone-400">This will delete all your game history forever.</span>
      </div>
      
      <form action="/profile/delete" method="POST" onsubmit="return confirm('Do you really want to irrevocably delete your account? All your game scores will be lost.');" class="w-full sm:w-auto">
        @csrf
        @method('DELETE')
        <button type="submit" class="w-full sm:w-auto py-2 px-6 bg-red-600 hover:bg-red-700 text-white font-black uppercase tracking-wider text-sm border-4 border-black dark:border-white transition-all cursor-pointer text-center shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none">
          Delete Account
        </button>
      </form>
    </div>
  </div>
</div>
@endsection