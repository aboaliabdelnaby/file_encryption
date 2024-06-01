<div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-modal" style="float: right;margin-right: 10px">
        {{ $title }}
    </button>

    <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ $title }}</h5>
                    <button type="button" class="close"  wire:click="$dispatch('closing')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ $form }}
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $('#create-moda').modal()
    </script>
@endpush
