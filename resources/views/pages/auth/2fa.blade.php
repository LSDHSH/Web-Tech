@extends('layouts.app')

@section('content')
<div class="sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white px-6 py-12 shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl sm:px-12">
        
        <div class="text-center mb-8">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 text-2xl">
                🔒
            </div>
            <h2 class="mt-4 text-2xl font-bold tracking-tight text-gray-900">Zwei-Faktor-Schutz</h2>
            <p class="mt-2 text-sm text-gray-500">Wir haben einen 6-stelligen Code an deine E-Mail-Adresse gesendet.</p>
        </div>

        @if (session('status'))
            <div class="mb-4 rounded-lg bg-emerald-50 p-4 text-center text-sm font-medium text-emerald-700 ring-1 ring-emerald-600/10">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->has('code'))
            <div class="mb-4 rounded-lg bg-rose-50 p-4 text-center text-sm font-medium text-rose-700 ring-1 ring-rose-600/10">
                {{ $errors->first('code') }}
            </div>
        @endif

        <form action="/2fa" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="code" class="block text-sm font-medium text-gray-700 text-center mb-2">
                    Bestätigungscode eingeben
                </label>
                <div class="mt-1">
                    <input type="text" id="code" name="code" placeholder="123456" required autofocus
                        class="block w-full rounded-lg border-0 py-3 text-center text-2xl font-semibold tracking-[0.5em] text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-2xl">
                </div>
            </div>

            <div>
                <button type="submit" 
                    class="flex w-full justify-center rounded-lg bg-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors duration-150">
                    Code verifizieren
                </button>
            </div>
        </form>

        <div class="mt-6 text-center text-sm">
            <a href="/2fa-resend" class="font-medium text-blue-600 hover:text-blue-500 transition-colors duration-150">
                Code erneut senden
            </a>
        </div>

    </div>
</div>
@endsection