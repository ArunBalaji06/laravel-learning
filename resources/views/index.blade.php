<!DOCTYPE html>
<html>
<head>
    <title>Laravel | Component</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <br />
<div class="container row">
    <h3 class="text-center">Laravel component</h3>  
    <div class="col-md-6">
        <form method="post" action="{{ route('component.store')}}">
            @csrf
            Name:
            <x-input name="name" />
            <br/>
            Email:
            <x-input name="email" />
            <br/>
            Password:
            <x-input name="password" />
            <br/>
            <x-button> Submit </x-button>
        </form>
    </div>
  <div class="col-md-1"></div>
  <div class="col-md-4">
      <table class="table table-stripped">
          <thead>
              <th>Name</th>
              <th>Email</th>
          </thead>

          @if(isset($users))
            @foreach($users as $user)
          <tbody>
                <x-cell>{{ $user->name }}</x-cell>
                <x-cell>{{ $user->email }}</x-cell>
        </tbody>

            @endforeach
          @endif
      </table>
  </div>
</div>
  
</body>

</html>