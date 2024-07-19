<!DOCTYPE html>
<html>
    <head>
        <title>Invitation à évaluer un événement</title>
    </head>
    <body>
        <h1>Bonjour,</h1>
        <p>
            Vous avez été invité à évaluer un événement.<br>
            Veuillez cliquer sur le lien ci-dessous pour commencer l'évaluation&nbsp;:
        </p>
        <a href="http://jiri-app.test/events/{{ $event }}/{{ $contact }}/{{ $token }}" title="Vers le tableau de bord de l'évaluation">
            Commencer l'évaluation
        </a>
        <p>
            Votre token d'authentification est&nbsp;: <strong>{{ $token }}</strong>
        </p>
        <p>Merci,</p>
        <p>Votre équipe</p>
    </body>
</html>
