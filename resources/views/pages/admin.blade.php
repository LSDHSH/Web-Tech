@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center px-4 py-6">
  <div class="text-center w-full max-w-4xl mb-6 shrink-0 px-4">
    <x-title />
    <p class="text-sm font-black uppercase tracking-widest text-stone-500">Admin Dashboard</p>
  </div>
  
  <div class="w-full flex justify-center py-2 mb-4">
    <a href="/home" class="inline-flex items-center text-sm uppercase tracking-wider text-stone-500 hover:text-black dark:hover:text-white font-black transition-colors cursor-pointer">
      ← Return back home
    </a>
  </div>
  
  <div class="w-full max-w-4xl bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] overflow-hidden text-left flex flex-col">
    <div class="p-6 border-b-4 border-black dark:border-white bg-stone-50 dark:bg-stone-800 flex justify-center">
      <h2 class="text-xl font-bold uppercase tracking-wide text-black dark:text-white text-center">Registered Users</h2>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="border-b-4 border-black dark:border-white bg-stone-100 dark:bg-stone-800 uppercase text-sm tracking-wider font-black text-black dark:text-white">
            <th class="p-4 border-r-2 border-black dark:border-white">ID</th>
            <th class="p-4 border-r-2 border-black dark:border-white">Username</th>
            <th class="p-4 border-r-2 border-black dark:border-white">Email</th>
            <th class="p-4 border-r-2 border-black dark:border-white">Last Login</th>
            <th class="p-4 border-r-2 border-black dark:border-white">Role</th>
            <th class="p-4 text-center">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y-2 divide-black dark:divide-white">
          @foreach($users as $user)
          <tr class="hover:bg-stone-50 dark:hover:bg-stone-800 transition-colors">
            <td class="p-4 border-r-2 border-black dark:border-white font-mono text-black dark:text-white">{{ $user->id }}</td>
            
            <td class="p-4 border-r-2 border-black dark:border-white">
              <form action="/admin/update/{{ $user->email }}" method="POST" class="flex items-center gap-2">
                @csrf
                <input type="text" name="name" value="{{ $user->name }}"  class="font-bold bg-transparent border-b-2 border-transparent hover:border-black dark:hover:border-white focus:border-black dark:focus:border-white dark:text-white w-full outline-none">
                <button type="submit" class="text-[10px] font-black uppercase bg-black text-white dark:bg-white dark:text-black px-2 py-1">Save</button>
            </td>
            
            <td class="p-4 border-r-2 border-black dark:border-white text-stone-600 dark:text-stone-400 font-mono">{{ $user->email }}</td>
            
            <td class="p-4 border-r-2 border-black dark:border-white text-xs font-mono text-black dark:text-white">
              {{ $user->last_login ? $user->last_login->diffForHumans() : 'Never' }}
            </td>
            
            <td class="p-4 border-r-2 border-black dark:border-white">
              <select name="role" onchange="this.form.submit()" class="bg-transparent font-bold uppercase cursor-pointer dark:text-white">
                <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>User</option>
              </select>
              </form> 
            </td>
            
            <td class="p-4 text-center">
              <form action="/admin/delete/{{ $user->email }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="py-1 px-3 bg-red-500 text-white font-black uppercase text-xs border-2 border-black dark:border-white hover:bg-red-600 transition-all">
                  Delete
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection