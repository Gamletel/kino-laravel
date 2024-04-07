<div class="btn-group">
    <a href="{{route('user.dashboard')}}" class="btn btn-primary
    @if(url()->current() == route('user.dashboard'))active@endif">Данные</a>

    <a href="{{route('user.dashboard.posts')}}" class="btn btn-primary">Посты</a>
</div>
