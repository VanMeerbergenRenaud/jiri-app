<?php

namespace App\Http\Middleware;

use Closure;
use Exception;

class EvaluatorMiddelware
{
    // Ce middleware permet de vérifier si le contact est un évaluateur
    // Le contact a un role 'evaluator' depuis la table event_contact
    // Si le contact est un évaluateur, il peut accéder à la page
    // Sinon, il est redirigé vers la page 403 : Interdit

    public function handle($request, Closure $next)
    {
        try {
            $eventId = $request->route('event');
            $contactId = $request->route('contact');

            $eventContact = auth()->user()->eventContacts()
                ->where('event_id', $eventId)
                ->where('contact_id', $contactId)
                ->where('role', 'evaluator')
                ->where('token', $request->route('token'))
                ->first();

            if (! $eventContact) {
                throw new Exception('You are not an evaluator for this event');
            }

            return $next($request);

        } catch (Exception $e) {
            abort(403, $e->getMessage());
        }
    }
}
