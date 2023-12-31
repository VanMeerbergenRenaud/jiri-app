<div wire:ignore>
    <div x-data x-init="() => {

    // Initialise the Choices object
    const choices = new Choices($refs.{{ $tasks }}, {
        allowHTML: false,
        itemSelectText: '',
        removeItems: true,
        removeItemButton: true
    });

    choices.passedElement.element.addEventListener('change', function(e) {
        const selectedValues = getSelectValues($refs.{{ $tasks }});

        // Check if the selected options have changed
        let previousSelectedOptions = [];
        const currentSelectedOptions = selectedValues.slice();
        if (!Array.isArray(previousSelectedOptions)) {
            previousSelectedOptions = currentSelectedOptions;
            @this.set('{{ $attributes['wire:model'] }}', selectedValues);
        }
    });


    items = {!! $attributes['selected'] !!};

    if (Array.isArray(items)) {
      items.forEach(function(select) {
        choices.setChoiceByValue((select).toString());
      });
    } else {
      choices.setChoiceByValue((items).toString());
    }

    function getSelectValues(select) {
      const result = [];
      const options = select && select.options;
      let opt;

      for (let i = 0, iLen = options.length; i < iLen; i++) {
        opt = options[i];
        if (opt.selected) {
          result.push(opt.value || opt.text);
        }
      }

      return result;
    }
  }">
        <label for="selectTask">
            <select id="selectTask"
                    x-ref="{{ $attributes['tasks'] }}"
                    wire-model="{{ $attributes['wire:model'] }}"
                    multiple
            >
                @if(count($attributes['options']) > 0)
                    @foreach($attributes['options'] as $option)
                        <option value="{{  $option }}" >{{  $option }}</option>
                    @endforeach
                @endif
            </select>
        </label>
    </div>
</div>
