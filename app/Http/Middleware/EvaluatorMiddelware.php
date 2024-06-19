<?php

namespace App\Http\Middleware;


use Closure;
use Exception;

class EvaluatorMiddelware
{
    // Ce middleware permet de vérifier si le contact est un évaluateur
    // Le contact est soit student ou evaluator depuis la table event_contact
    // Si le contact est un évaluateur, il peut accéder à la page
    // Sinon, il est redirigé vers la page 403 : Interdit

    public function handle($request, Closure $next)
    {
        try {
            $event = auth()->user()->events()->find($request->route('event'));
            $contact = auth()->user()->contacts()->find($request->route('contact'));

            $eventContact = auth()->user()->eventContacts()
                ->where('event_id', $event->id)
                ->where('contact_id', $contact->id)
                ->where('token', $request->route('token'))
                ->first();

            if ($eventContact->role !== 'evaluator') {
                throw new Exception('Accès non authorisé');
            }

            return $next($request);

        } catch (Exception $e) {
            abort(403, $e->getMessage());
        }
    }
}
