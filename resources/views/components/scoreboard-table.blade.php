@props(['id', 'active' => false])

<div id="panel-{{ $id }}" class="tab-panel {{ $active ? '' : 'hidden' }} w-full flex flex-col">
    <div class="p-4 sm:p-6 bg-stone-50 dark:bg-stone-800 overflow-x-auto min-h-[350px] scrollbar-thin">
        
        <table class="w-max sm:w-full text-center font-mono text-[11px] sm:text-xs uppercase tracking-wider border-collapse border-2 border-black dark:border-white mx-auto">
            <thead>
                <tr class="bg-stone-200 dark:bg-stone-700 border-b-4 border-black dark:border-white font-black text-black dark:text-white">
                    <th class="p-3 text-center min-w-[60px] border-r-2 border-black dark:border-white">Rang</th>
                    <th class="p-3 text-left min-w-[140px] border-r-2 border-black dark:border-white">Spieler</th>
                    <th class="p-3 text-center min-w-[90px] border-r-2 border-black dark:border-white">Versuche</th>
                    <th class="p-3 text-center min-w-[90px] border-r-2 border-black dark:border-white">Zeit</th>
                    <th class="p-3 text-center min-w-[100px]">Datum</th>
                </tr>
            </thead>
            <tbody class="divide-y-2 divide-black dark:divide-white bg-white dark:bg-stone-900 text-black dark:text-white font-bold">
                {{ $slot }}
            </tbody>
        </table>

    </div>
</div>