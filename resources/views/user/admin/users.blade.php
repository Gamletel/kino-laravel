@extends('user.admin')

@section('admin.content')
    @if(!empty($users))
        <div class="users d-flex flex-column gap-2 w-100">
            @foreach($users as $user)
                <x-user-card :user="$user" />
            @endforeach
        </div>
    @endif
@endsection
