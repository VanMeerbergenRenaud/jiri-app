<div>
    <table class="first-table">
        <thead>
            <tr class="row-1">
                <th scope="row" colspan="100%">
                    Tableau récapitulatif des passages
                </th>
            </tr>
            <tr class="row-2">
                <th class="category">Étudiants | Jury</th>
                @foreach($evaluators as $evaluator)
                    <th class="jiris" scope="col" wire:key="e{{ $evaluator->id }}">
                        {{ $evaluator->contact->name ?? 'Évaluateur' }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr class="row-3" wire:key="s{{ $student->id }}">
                <th class="students" scope="row">
                    {{ $student->contact->name ?? 'Étudiant' }}
                </th>
                @foreach($evaluators as $evaluator)
                    <td wire:key="e{{ $evaluator->id }}-s{{ $student->id }}">
                        <label>
                            <input class="input" type="checkbox">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="23" viewBox="0 0 19 23">
                                <text data-name="✔️" transform="translate(0 18)" fill="#00ba41" font-size="14" font-family="AppleColorEmoji, Apple Color Emoji">
                                    <tspan x="0" y="0">✔️</tspan>
                                </text>
                            </svg>
                        </label>
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
