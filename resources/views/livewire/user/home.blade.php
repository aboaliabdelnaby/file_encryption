<x-slot name="title">
    Files
</x-slot>
<div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 style="float: left">Files</h2>
                <div style="float:right;">
                    <input type="text"
                           wire:model.live="search"
                           class="form-control form-control-solid w-250px ps-14"
                           placeholder="Search"
                    />
                </div>
                <x-general.create-modal title="Upload File">
                    <x-slot name="form">
                        <livewire:user.file-upload/>
                    </x-slot>
                </x-general.create-modal>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <x-datatable.th sortByColumn="name"
                                            labelName="name"/>
                            <x-datatable.th sortByColumn="size"
                                            labelName="size"/>
                            <x-datatable.th sortByColumn="extension"
                                            labelName="extension"/>
                            <x-datatable.th sortByColumn="status"
                                            labelName="status"/>
                            <th scope="col">show file</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($data as $row)
                            <tr>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->size }}</td>
                                <td>{{ $row->extension }}</td>
                                <td>{{ $row->status }}</td>
                                <td><a target="_blank" href="{{ asset('storage/'.$row->path) }}">{{ $row->name }}</a></td>
                                <td>
                                    <a wire:click="$dispatch('confirm_operation',{ id: {{$row->id}}, action: '{{$row->action()['action'] }}', path: '{{ $row->path }}' })"
                                       class="{{ $row->action()['class'] }} mb-2 text-white">
                                        {{ ucfirst($row->action()['action']) }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <td colspan="100%">
                                <div class="text-center mt-2" style="font-size: 18px;">
                                    No Data Found
                                </div>
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="row float-end">
                    <div class="col">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@script
<script>
    Livewire.on('confirm_operation', (data) => {
        console.log(
            data
        )
        Swal.fire({
            title: 'warning',
            text: 'Are you sure you want to '+data.action+' this File',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: data.action,
            padding: '2em'
        }).then(function (result) {
            if (result.value) {
                Livewire.dispatch('do_operation', {row:data});

            }
        })
    });
</script>
@endscript
