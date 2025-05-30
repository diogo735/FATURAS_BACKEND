<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Backend_Faturas</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" />

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
        }

        img {
            width: 100px;
            margin-bottom: 20px;
        }

        h1 {
            color: #10b981;
            margin-bottom: 10px;
        }

        .status {
            margin-top: 20px;
            text-align: left;
        }

        .status p {
            margin: 5px 0;
        }
    </style>
</head>

<body>

    <div class="card">
        <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Servidor Online">
        <h1>Servidor Online 🚀</h1>

        <div class="status">
            <p><strong>Status da Base de Dados:</strong></p>
            <p><strong>BD:</strong> {{ DB::connection()->getDatabaseName() }}</p>
            <p><strong>Host:</strong> {{ DB::getConfig('host') }}</p>
            <p><strong>Porta:</strong> {{ DB::getConfig('port') }}</p>
            <p><strong>Conexão:</strong>
                <span class="{{ \Illuminate\Support\Str::contains($mensagem, 'Sucesso') ? 'mensagem-sucesso' : 'mensagem-erro' }}">
                    {!! $mensagem !!}
                </span>

            </p>
        </div>
    </div>
</body>

</html>