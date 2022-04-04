<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot><br /><br />
    <a class="btn btn-warning" href="/user_view">View</a>
    @role('admin')
        Name: {{$users[0]->name}}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$users[0]->id}}">
        Create
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal{{$users[0]->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <form action="/user_create" method="post">
                        @csrf
                        name : <input type="text" name="name" class="form-control">
                        email : <input type="text" name="email" class="form-control">
                        password : <input type="text" name="password" class="form-control">
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>

                </div>
            </div>
        </div>
    @endrole

        @foreach($users as $user)
            Name: {{$user->name}}<br><br>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$user->id}}">
                update
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create Post</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        <div class="modal-body">
                            <form action="/user_update" method="post">
                                @csrf
                                Name : <input type="text" name="name" value='{{$user->name}}' class="form-control">
                                <input type="text" name="user_id" value="{{$user->id}}" class="form-control">
                                Email: <input type="text" name="email" value='{{$user->email}}' class="form-control">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>

                        </div>
                    </div>
                </div><br><br>
        @endforeach

</x-app-layout>


<script>
    $(document).ready(function() {
        toastr.options.timeOut = 1000;
        @if (Session::has('error'))
        toastr.error('{{ Session::get('error') }}');
        @elseif(Session::has('success'))
        toastr.success('{{ Session::get('success') }}');
        @endif
    });
</script>
