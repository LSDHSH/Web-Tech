@extends('layouts.app')

@section('content')
<div class="text-center w-[600px] mb-8">
    <a href="/index" class="inline-flex items-center text-sm uppercase tracking-wider text-stone-500 hover:text-black font-bold transition-colors">
        ← Zurück zu Guessle
    </a>
</div>

<div class="w-[600px] min-h-[620px] bg-white border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden text-left flex flex-col">
    
    <div class="flex flex-row select-none shrink-0 text-lg">
        <div class="w-1/2 py-4 text-center font-black uppercase bg-white border-b-4 border-black">
            Login
        </div>
        <a href="/register" class="w-1/2 py-4 text-center font-black uppercase bg-stone-100 text-stone-400 border-b-4 border-l-4 border-black hover:text-black transition-colors">
            Register
        </a>
    </div>

    <form action="/login" method="POST" class="p-10 space-y-6 flex-1 flex flex-col justify-between">
        @csrf
        <div class="space-y-6">
            <div>
                <label for="login-email" class="block text-sm uppercase font-black tracking-wider mb-2">E-Mail Adresse</label>
                <input type="email" id="login-email" name="email" required 
                    class="w-full p-4 bg-white border-4 border-black text-black font-mono text-base focus:outline-none focus:bg-stone-50 placeholder-stone-400 font-bold"
                    placeholder="deine@mail.de">
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <label for="login-password" class="block text-sm uppercase font-black tracking-wider">Passwort</label>
                    <a href="#" class="text-xs uppercase tracking-wider text-stone-400 hover:text-black hover:underline font-bold">Vergessen?</a>
                </div>
                <input type="password" id="login-password" name="password" required 
                    class="w-full p-4 bg-white border-4 border-black text-black font-mono text-base focus:outline-none focus:bg-stone-50 placeholder-stone-400 font-bold"
                    placeholder="••••••••">
            </div>
        </div>

        <button type="submit" class="w-full py-5 bg-black text-white hover:bg-stone-800 font-black text-base tracking-wide uppercase transition-colors text-center cursor-pointer mt-8">
            Anmelden →
        </button>
    </form>
</div>
@endsection