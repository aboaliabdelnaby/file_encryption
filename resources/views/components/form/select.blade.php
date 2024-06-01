<div class="mb-5 {{ $col ?? "col-12" }}">
    <div @if(!isset($withoutIgnore)) wire:ignore @endif>
        @if(isset($label) && $label === 'true')
            <label for="{{ $id }}" class="form-label fs-6 fw-semibold">{{ $labelName }}</label>
        @endif
        <select
            @isset($change) wire:change="{{ $change }}" @endisset
        @if(isset($defer))
            wire:model="{{ $name }}"
            @elseif(isset($lazy))
                wire:model.lazy="{{ $name }}"
            @else
                wire:model.live="{{ $name }}"
            @endif
            @isset($multiple)
                multiple="multiple"
            @endisset
            @if(isset($isDisable) && $isDisable) disabled @endif
            id="{{ $id }}"
            class="form-select form-select-solid @error($name) is-invalid @enderror "
            data-control="select2">
            <option>{{ 'Select '. $labelName }}</option>
            @foreach($elements as $key => $valueName)
                <option value="{{ $key }}">{{ $valueName }}</option>
            @endforeach
        </select>
    </div>
    @error($name) <span class="text-danger" style="font-weight: bold">{{  $message  }}</span> @enderror
</div>
