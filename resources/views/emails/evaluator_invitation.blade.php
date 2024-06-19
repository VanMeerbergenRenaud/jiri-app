<!DOCTYPE html>
<html>
    <head>
        <title>Invitation à évaluer un événement</title>
    </head>
    <body>
        <h1>Bonjour,</h1>
        <p>
            Vous avez été invité à évaluer un événement.<br>
            Veuillez cliquer sur le lien ci-dessous pour commencer l'évaluation&nbsp;:</p>
        <a href="{{ url('/events/' . $eventId . $token) }}">Commencer l'évaluation</a>
        <p>Merci,</p>
        <p>Votre équipe</p>
    </body>
</html>
