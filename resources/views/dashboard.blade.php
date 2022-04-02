<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gates and Policies') }}
        </h2>
        @can('isAdmin')
            Role: ADMIN loged in.
        @elsecan('isUser')
            Role: USER logged in.
        @endcan<br />

    </x-slot>

    <div class="py-12 container"><br />
        <h2>Users</h2>
        @foreach($users as $user)
           <div class="card col-md-4 p-4 text-center">
                  Name: {{$user->name}}<br />
                  Email: {{$user->email}}<br />
               <!-- Button trigger modal -->
               <button type="button" style="align-self: center;" class="btn btn-primary col-md-4" data-bs-toggle="modal" data-bs-target="#exampleModal{{$user->id}}">
                   Create Post
               </button>

               <!-- Modal -->
               <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                   <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                               <form action="/create-post" method="post">
                                   @csrf
                                   Name: <br>
                                   <input type="text" name="post" class="form-control">
                                   <input type="hidden" name="user_id" value="{{$user->id}}" class="form-control"><br />

                                   <button type="submit" class="btn btn-warning">Save</button>
                               </form>
                           </div>
                       </div>
                   </div>
               </div>

           </div><br />
        @endforeach
    </div>

    @if(isset($posts))

        <div class="py-12 container"><br />
            <h2>Posts</h2>
            @foreach($posts as $post)
                <div class="card col-md-4 p-4 text-center">
                    Post: {{$post->post}}<br />
                    <!-- Button trigger modal -->
                    <button type="button" style="align-self: center;" class="btn btn-primary col-md-4" data-bs-toggle="modal" data-bs-target="#exampleModal{{$post->id}}">
                        Update Post
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/update-post" method="post">
                                        @csrf
                                        Name: <br>
                                        <input type="text" name="post" class="form-control">
                                        <input type="hidden" name="user_id" value="{{$user->id}}" class="form-control"><br />
                                        <input type="hidden" name="post_id" value="{{$post->id}}" class="form-control"><br />

                                        <button type="submit" class="btn btn-warning">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><br />
            @endforeach
        </div>
    @endif
</x-app-layout>

<script>
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if (Session::has('error'))
        toastr.error('{{ Session::get('error') }}');
        @elseif(Session::has('success'))
        toastr.success('{{ Session::get('success') }}');
        @endif
    });

</script>
