<div class="user-card card w-100">
    <div class="card-header d-flex gap-1 align-items-center">
        @if($user->avatar)
            <div class="user-card-avatar" style="width: 50px; height: 50px; flex-shrink: 0">
                <img src="{{ asset('storage/'.$user->avatar) }}" class="w-100 h-100 object-fit-contain" alt="">
            </div>
        @endif

        <div class="d-flex flex-column gap-1">
            @if($user->name)
                <div class="user-card-name">Имя: {{__($user->name)}}</div>
            @endif

            <div class="user-card-email">Email: {{__($user->email)}}</div>
        </div>
    </div>
    <div class="card-body">

        <div class="d-flex flex-column gap-1">
            Дата регистрации: {{__($user->created_at->format('d.m.Y'))}}
        </div>
    </div>

    <div class="card-footer">
        @if(auth()->id() != $user->id)
            <a href="{{ route('users.delete', $user->id) }}" class="btn btn-outline-primary">Удалить</a>
        @endif
    </div>
</div>
