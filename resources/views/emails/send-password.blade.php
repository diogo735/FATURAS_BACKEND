<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Novos dados de login</title>
</head>
<body>
    <h2>Olá, {{ $nome }}!</h2>

    <p>Foi gerada uma nova palavra-passe para o teu login na PiggWallet:</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Palavra-Passe:</strong> {{ $password }}</p>

    <p>Por motivos de segurança, recomendamos que alteres a tua palavra-passe após o login.</p>

    <p>Obrigado,<br>Equipa de Suporte</p>
</body>
</html>
