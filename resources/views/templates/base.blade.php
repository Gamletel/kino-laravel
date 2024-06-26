<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>@yield('page.title', config('app.name'))</title>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('8aa5709e25cfe2479769', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('test');
        channel.bind('test-event', function(data) {
            alert(`Ваш комментарий ${data} лайкнули!`);
        });

    </script>

    <script src="{{ asset('js/tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',  // change this value according to your HTML
            // plugins: 'a_tinymce_plugin',
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent'
            // a_plugin_option: true,
            // a_configuration_option: 400
        });
    </script>
</head>
<body>
<div class="d-flex flex-column justify-content-between min-vh-100">
{{--    @include('inc.alert')--}}
    @include('inc.header')

    <div class="container content flex-grow-1 py-3">
        @yield('content')
    </div>

    @include('inc.footer')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{asset('js/main.js')}}"></script>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</body>
</html>
