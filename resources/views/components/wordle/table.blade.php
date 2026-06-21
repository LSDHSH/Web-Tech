@props(['headers' => []])

<div class="p-4 sm:p-6 bg-stone-50 dark:bg-stone-800 min-h-[250px] flex flex-col gap-y-6">
  <div class="overflow-x-auto scrollbar-thin">
    <table class="w-max sm:w-full text-center font-mono text-[11px] sm:text-xs uppercase tracking-wider border-collapse border-2 border-black dark:border-white mx-auto">
      <thead>
        <tr class="bg-stone-200 dark:bg-stone-700 border-b-4 border-black dark:border-white font-black text-black dark:text-white">
          @foreach($headers as $header)
            <th class="p-3 border-r-2 last:border-r-0 border-black dark:border-white text-center">
              {{ $header }}
            </th>
          @endforeach
        </tr>
      </thead>
      <tbody id="wordle-table-body" class="divide-y-2 divide-black dark:divide-white bg-white dark:bg-stone-900">
        <tr id="table-placeholder" class="text-stone-400 dark:text-stone-500">
          <td colspan="{{ count($headers) }}" class="p-8 text-center font-bold italic lowercase">
            Select an entry above to start the game.
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  
  <div id="wordle-feedback" class="w-full transition-all duration-300 transform translate-y-4 opacity-0 hidden">
  </div>
</div>