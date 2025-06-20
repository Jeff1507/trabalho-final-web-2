@props(['options', 'name', 'label' => null, 'id' => null, 'valueField' => 'id', 'textField' => 'nome', 'selected' => null])

<select
    name="{{ $name }}"
    id="{{ $id ?? $name }}"
    {{ $attributes->merge(['class' => 'border-zinc-400 bg-transparent text-white focus:border-[#D0BCFF] focus:ring-[#D0BCFF] rounded-sm shadow-sm']) }}
>
    <option value="" class="bg-zinc-900 rounded-none">
        {{ $label ?? 'Selecione uma opção' }}
    </option>
    @foreach ($options as $option)
        <option value="{{ $option->$valueField }}" class="bg-zinc-900" @selected((string) $option->$valueField === (string) $selected)>
            {{ $option->$textField }}
        </option>
    @endforeach
</select>