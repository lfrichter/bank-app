<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Bank</title>
	@vite('resources/css/app.css')
</head>
<body>
    @if (Auth::check())
        <script>
            window.Laravel = {!!json_encode([
                'isLoggedin' => true,
                'user' => Auth::user()
            ])!!}
        </script>
    @else
        <script>
            window.Laravel = {!!json_encode([
                'isLoggedin' => false
            ])!!}
        </script>
    @endif
	<div id="app">
        <router-view></router-view>
    </div>
	@vite('resources/ts/app.ts')
</body>
</html>
