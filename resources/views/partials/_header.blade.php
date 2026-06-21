@can('admin')
  <x-nav.button href="/admin">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A1.79 1.79 0 1 1 14.75 23.5l-5.83-5.83m0 0a3.99 3.99 0 0 1-1.35-3.05 4 4 0 1 1 5.66 0m-4.31 3.83L3.38 21.05a1.79 1.79 0 1 1-2.54-2.54l4.17-4.17m1.15 1.15L3.5 12.82m12.4-7.92a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" /></svg>
    <span class="hidden sm:inline">Admin</span>
  </x-nav.button>
@endcan

<x-nav.button href="/profile">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
  <span class="hidden sm:inline">Profile</span>
</x-nav.button>
