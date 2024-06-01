<?php

namespace App\Livewire\User;

use App\Enum\FileStatusEnum;
use App\Models\File;
use App\MyPackages\Livewire\Components\Traits\IndexHelper;
use App\MyPackages\Livewire\Filters\Pipeline;
use App\MyPackages\Livewire\Filters\SearchFilterPipeline;
use App\MyPackages\Livewire\Filters\SortFilterPipeline;
use App\Services\FileEncryptionService\FileService;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination, IndexHelper;

    protected string $view = 'user.home';
    protected array $searchColumns = ['name', 'size', 'extension'];
    protected $listeners = ['refreshComponent' => '$refresh', 'do_operation'];
    protected string $message = '';
    private $query;

    public function __construct()
    {
        $this->query = app(Pipeline::class)->setModel(File::class);
    }

    public function render()
    {
        $data = $this->query->pushPipeline([
            new SearchFilterPipeline($this->searchColumns, $this->search),
            new SortFilterPipeline($this->sortField, $this->sortType)
        ])->paginate($this->paginatePerPage);
        return view(
            view: 'livewire.' . $this->view,
            data: get_defined_vars()
        );
    }

    public function do_operation(array $row): void
    {
        try {
            $status = $row['action'] == 'encrypt' ? FileStatusEnum::ENCRYPT : FileStatusEnum::DECRYPT;
            $this->message='File has been '.$status->value.' successfully';
            app(FileService::class)->do_operation($status, $row['path']);
            $this->query->where('id', $row['id'])->update(['status' => $status]);
            $this->dispatch('success', $this->message);
        } catch (\Exception $exception) {
            $this->dispatch('error', $exception->getMessage());
        }

    }
}
