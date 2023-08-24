@php

    $id = Auth::user()->id;
    $user = App\Models\User::find($id);

@endphp


<div class="col-md-2"><br>
    <img class="card-img-top" style="border-radius: 50%" src="{{ (!empty(\Illuminate\Support\Facades\Auth::user()->profile_photo_path))? url('storage/'.\Illuminate\Support\Facades\Auth::user()->profile_photo_path):url('upload/no_image.jpg') }}" height="100%" width="100%"><br><br>

    <ul class="list-group list-group-flush">
        <a href="{{ url('/') }}" class="btn btn-primary btn-sm btn-block">Home</a>

        <a href="{{ route('profile.show') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>

        <a href="{{ route('my.orders') }}" class="btn btn-primary btn-sm btn-block">My Orders</a>

        <a href="{{ route('return.order.list') }}" class="btn btn-primary btn-sm btn-block">Return Orders</a>

        <a href="{{ route('cancel.orders') }}" class="btn btn-primary btn-sm btn-block">Cancel Orders</a>

        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>

    </ul>

</div> <!-- // end col md 2 -->
