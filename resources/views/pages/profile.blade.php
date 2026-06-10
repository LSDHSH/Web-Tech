@extends('layouts.app')

@section('content')
<a href="/home" class="fixed top-6 left-6 p-3 bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] dark:hover:shadow-[2px_2px_0px_0px_rgba(255,255,255,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none flex items-center gap-2 font-black uppercase tracking-wider text-sm transition-all z-50 cursor-pointer">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
    </svg>
    <span class="hidden sm:inline">Return</span>
</a>

<div class="text-center w-full max-w-xl mb-8 shrink-0 px-4">
    <h1 class="text-5xl md:text-7xl font-black tracking-tighter uppercase">
        Profile
    </h1>
</div>

<div class="w-full max-w-xl flex flex-col gap-8">
    
    <div class="grid grid-cols-2 gap-4">
        <x-profile-stats value="24" label="Quizes finished" />
        <x-profile-stats value="68%" label="Win-Rate" />
    </div>

    <div class="w-full bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] overflow-hidden">
        
        <div class="p-6 border-b-4 border-black dark:border-white bg-stone-50 dark:bg-stone-800 font-black text-lg uppercase tracking-wider">
            Account-Details
        </div>

        <form action="/profile/update" method="POST" class="p-6 md:p-8 flex flex-col gap-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm uppercase font-black tracking-wider mb-2">Username</label>
                <input type="text" name="name" value="{{ auth()->user()->name ?? 'DemoUser' }}" 
                    class="w-full p-4 bg-stone-100 dark:bg-stone-800 border-4 border-black dark:border-white text-black dark:text-white font-mono text-lg focus:outline-none focus:bg-white dark:focus:bg-stone-900 font-bold">
            </div>

            <div>
                <label class="block text-sm uppercase font-black tracking-wider mb-2">E-Mail</label>
                <input type="email" name="email" value="{{ auth()->user()->email ?? 'user@web-tech.io' }}" disabled
                    class="w-full p-4 bg-stone-100 dark:bg-stone-800 border-4 border-black dark:border-white text-stone-500 dark:text-stone-400 font-mono text-lg font-bold cursor-not-allowed opacity-70">
            </div>

            <hr class="border-2 border-black dark:border-white my-2">

            <div>
                <label class="block text-sm uppercase font-black tracking-wider mb-2">New Password?</label>
                <input type="password" name="password" placeholder="••••••••"
                    class="w-full p-4 bg-white dark:bg-stone-900 border-4 border-black dark:border-white text-black dark:text-white font-mono text-lg focus:outline-none placeholder-stone-400 font-bold">
            </div>

            <div class="flex flex-col sm:flex-row gap-4 mt-4">
                <button type="submit" 
                    class="flex-1 py-4 bg-black dark:bg-white text-white dark:text-black hover:bg-stone-800 dark:hover:bg-stone-200 font-black text-lg tracking-wide uppercase transition-colors cursor-pointer text-center border-4 border-black dark:border-white">
                    Save
                </button>
            </div>
        </form>

        <div class="p-6 bg-stone-50 dark:bg-stone-800 border-t-4 border-black dark:border-white flex flex-col sm:flex-row justify-between items-center gap-4">
            <span class="text-xs uppercase font-black tracking-wider text-stone-500 dark:text-stone-400">End session?</span>
            
            <form action="/logout" method="POST" class="w-full sm:w-auto">
                @csrf
                <button type="submit" 
                    class="w-full sm:w-auto py-2 px-6 bg-red-700 hover:bg-red-800 text-white font-black uppercase tracking-wider text-sm border-4 border-black dark:border-white transition-colors cursor-pointer text-center shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all">
                    Logout
                </button>
            </form>
        </div>

    </div>
</div>
@endsection