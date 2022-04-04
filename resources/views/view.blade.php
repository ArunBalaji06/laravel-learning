<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot><br /><br />

    @foreach($users as $user)
        <div class="card">
            
            name : {{$user->name}}<br />
                <a href="/user_delete/{{$user->id}}" class="btn btn-warning">Delete</a>
        </div>
    @endforeach


</x-app-layout>