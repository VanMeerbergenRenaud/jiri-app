<div>
    <table class="first-table">
        <thead>
        <tr class="row-1">
            <th scope="row" colspan="100%">
                Tableau récapitulatif des passages
            </th>
        </tr>
        <tr class="row-2">
            <th class="category">Étudiants | Évaluateurs</th>
            @foreach($evaluators as $evaluator)
                <th class="jiris" scope="col">
                    {{ $evaluator->contact->name ?? 'Évaluateur' }}
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr class="row-3">
                    <th class="students" scope="row">
                        {{ $student->contact->name ?? 'Étudiant' }}
                    </th>
                    @foreach($evaluators as $evaluator)
                        <td class="selectStatus">
                            @php
                                $statuses = [
                                    'not evaluated' => 'Non évalué',
                                    'pending' => 'En cours',
                                    'evaluated' => 'Évalué',
                                ];
                            @endphp

                            <label for="status-{{ $student->contact->id }}-{{ $evaluator->contact->id }}" class="sr-only">Status de l'évaluation</label>
                            <select id="status-{{ $student->contact->id }}-{{ $evaluator->contact->id }}"
                                    wire:model.defer="status.{{ $student->contact->id }}.{{ $evaluator->contact->id }}"
                                    wire:change="updateStatus('{{ $student->contact->id }}', '{{ $evaluator->contact->id }}')"
                                    wire:key="status-{{ $student->contact->id }}-{{ $evaluator->contact->id }}"
                            >
                                <option value="null" disabled>{{ __('Sélectionner un status') }}</option>
                                @foreach($statuses as $value => $key)
                                    <option value="{{ $value }}">{{ $key }}</option>
                                @endforeach
                            </select>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="first-table--footer">
        <button class="button--blue" type="button">
            Mode plein écran
        </button>
    </div>
</div>
