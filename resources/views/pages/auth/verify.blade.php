@extends('layouts.app')

@section('content')
<div class="sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white px-6 py-12 shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl sm:px-12 text-center">
        
        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 text-2xl">
            📬
        </div>

        <h2 class="mt-6 text-2xl font-bold tracking-tight text-gray-900">Fast geschafft!</h2>
        
        <div class="mt-6 space-y-4 text-sm text-gray-600 leading-relaxed">
            <p>Wir haben dir einen Aktivierungslink per E-Mail gesendet.</p>
            <p>Bitte öffne dein Postfach und klicke auf den Link, um deine Registrierung abzuschließen und deinen Account freizuschalten.</p>
        </div>

        <div class="mt-8 border-t border-gray-100 pt-6">
            <p class="text-xs text-gray-400">
                Keine Mail erhalten? Überprüfe bitte auch deinen Spam-Ordner oder warte einen kleinen Moment.
            </p>
        </div>
    </div>
</div>
@endsection