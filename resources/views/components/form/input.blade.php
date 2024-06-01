<div class="mb-2 {{ $col ?? "col-12" }}">
    @if(isset($label) && $label ==='true')
        <label for="{{ $key }}" class="fw-semibold fs-6 mb-2">{{ $labelName }}</label>
    @endif
    <input type="{{$type}}"
           @if(isset($defer)) wire:model.defer="{{ $name }}"
           @elseif(isset($lazy)) wire:model.lazy="{{ $name }}"
           @else wire:model="{{ $name }}" @endif
           @isset($readonly) readonly @endisset
           id="{{ $key }}"
           @if($type=='number')
               min="0"
           @endif
           placeholder="Enter {{ $labelName }}"
           autocomplete="{{ $autocomplete ??'' }}"
           class="form-control form-control-solid mb-3 mb-lg-0 @error($name) is-invalid @enderror"
           @isset($multiple) multiple @endisset
           @isset($value) value="{{ $value }}" @endisset
    >
    @error($name) <span class="text-danger" style="font-weight: bold">{{ $message }}</span> @enderror
</div>
