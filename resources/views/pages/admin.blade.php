@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center px-4 py-6">
    
    <div class="text-center w-full max-w-2xl mb-6 shrink-0 px-4">
        <x-guessle-title-text1 />
        
        <p class="text-sm font-black uppercase tracking-widest text-stone-500">
            Adminbereich
        </p>
    </div>

    <div class="bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] overflow-hidden text-left flex flex-col">
        
        <div class="p-6 border-b-4 border-black dark:border-white bg-stone-50 dark:bg-stone-800 flex justify-between items-center flex-wrap gap-4">
            <div>
                <h2 class="text-xl font-bold uppercase tracking-wide text-black dark:text-white">Alle registrieten Benutzer</h2>
            </div>
            <button class="py-2 px-4 bg-black dark:bg-white text-white dark:text-black hover:bg-stone-800 dark:hover:bg-stone-200 font-bold uppercase tracking-wider text-sm transition-colors border-2 border-black dark:border-white">
                + Benutzer hinzufügen
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-4 border-black dark:border-white bg-stone-100 dark:bg-stone-800 uppercase text-sm tracking-wider font-black text-black dark:text-white">
                        <th class="p-4 border-r-2 border-black dark:border-white">ID</th>
                        <th class="p-4 border-r-2 border-black dark:border-white">Benutzername</th>
                        <th class="p-4 border-r-2 border-black dark:border-white">Email</th>
                        <th class="p-4 border-r-2 border-black dark:border-white">Rolle</th>
                        <th class="p-4 text-center">Löschen</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-black dark:divide-white text-sm font-medium text-black dark:text-white">
                    
                    <tr class="hover:bg-stone-50 dark:hover:bg-stone-800 transition-colors">
                        <td class="p-4 border-r-2 border-black dark:border-white font-mono">1</td>
                        <td class="p-4 border-r-2 border-black dark:border-white font-bold">Max Mustermann</td>
                        <td class="p-4 border-r-2 border-black dark:border-white text-stone-600 dark:text-stone-400">max@guessle.de</td>
                        <td class="p-4 border-r-2 border-black dark:border-white">
                            <select class="bg-white dark:bg-stone-900 text-black dark:text-white border-2 border-black dark:border-white p-1 font-bold text-xs uppercase tracking-wider focus:outline-none cursor-pointer">
                                <option value="admin" selected>Admin</option>
                                <option value="user">User</option>
                            </select>
                        </td>
                        <td class="p-4 text-center flex justify-center gap-3">
                            <button class="py-1 px-3 bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700 text-black dark:text-white font-black uppercase tracking-wider text-xs border-2 border-black dark:border-white shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] dark:shadow-[2px_2px_0px_0px_rgba(255,255,255,1)] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none transition-all">
                                Delete
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>

    <x-return-home/>

</div>
@endsection