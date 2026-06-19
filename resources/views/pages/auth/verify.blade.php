@extends('layouts.app')

@section('content')
<div class="min-h-screen w-full flex flex-col items-center justify-center px-4 bg-white dark:bg-stone-950 transition-colors">
    
    <div class="w-full max-w-[600px] bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] overflow-hidden text-center flex flex-col p-6 sm:p-10">
        
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-stone-100 dark:bg-stone-800 text-3xl border-4 border-black dark:border-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)]">
            📬
        </div>

        <h2 class="mt-8 text-2xl font-black uppercase tracking-wider text-black dark:text-white">Fast geschafft!</h2>
        
        <div class="mt-6 space-y-4 text-sm font-bold uppercase tracking-wide text-stone-600 dark:text-stone-300 leading-relaxed">
            <p>Wir haben dir einen Aktivierungslink per E-Mail gesendet.</p>
            <p>Bitte öffne dein Postfach und klicke auf den Link, um deine Registrierung abzuschließen und deinen Account freizuschalten.</p>
        </div>

        <div class="mt-8 border-t-4 border-black dark:border-white pt-6">
            <p class="text-xs font-bold uppercase tracking-wider text-stone-400 dark:text-stone-500">
                Keine Mail erhalten? Überprüfe bitte auch deinen Spam-Ordner oder warte einen kleinen Moment.
            </p>
        </div>
    </div>
</div>
@endsection