<div>
    <form wire:submit.prevent="create">
        <x-form.input type="text" label="true" key="name" name="name"
                      labelName="name"/>
        <x-form.input type="text" label="true" key="location" name="location"
                      labelName="location"/>
        <x-form.select name="status" label="true" labelName="operation"
                       id="status" :elements="$options"/>
        <x-form.input type="file" label="true" key="file" name="file"
                      labelName="file"/>
        <button class="btn btn-primary">Add</button>

    </form>
</div>
