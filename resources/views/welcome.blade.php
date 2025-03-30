<!DOCTYPE html>
<html>
<head>
    <title>Bem-vindo</title>
    @vite(['resources/css/app.css'])
</head>
<body class="text-center p-8">
    <h1 class="text-2xl mb-6">Meu Sistema</h1>
    <a href="{{ url('/admin/products') }}" 
       class="bg-blue-500 text-white px-6 py-3 rounded-lg inline-block">
       Gerenciar Produtos
    </a>
</body>
</html>