<!DOCTYPE html>
<html>
<head>
    @filamentStyles
    @vite(['resources/css/app.css'])
</head>
<body>
    {{ $slot }}
    @filamentScripts
</body>
</html>