<!DOCTYPE html>
<html>
<head>
    <title>Invitation à évaluer un événement</title>
    <style>
        /* Styles généraux */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        /* Contenu de l'email */
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: left;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .header h1 {
            margin: 0;
        }

        .content {
            padding-top: 16px;
        }

        .content p {
            margin-bottom: 20px;
        }

        .content button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .token {
            margin-top: 32px;
        }

        .footer {
            text-align: center;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bonjour cher évaluateur,</h1>
        </div>

        <div class="content">
            <p>Vous avez été invité à évaluer une épreuve qui vient de commencer.</p>
            <p>Veuillez cliquer sur le bouton ci-dessous pour vous connecter et commencer l'évaluation&nbsp;:</p>
            <a href="http://jiri-app.test/events/{{ $event }}/{{ $contact }}/{{ $token }}" title="Vers le tableau de bord de l'évaluation">
                <button>Commencer l'évaluation</button>
            </a>
            <p class="token">Votre token d'authentification est&nbsp;: <strong>{{ $token }}</strong></p>
        </div>

        <div class="footer">
            <p>Merci,</p>
            <p>Votre admin préféré !</p>
        </div>
    </div>
</body>
</html>
