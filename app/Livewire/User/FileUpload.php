<?php

namespace App\Livewire\User;

use App\Enum\FileStatusEnum;
use App\Models\File;
use App\MyPackages\Livewire\Components\Traits\CreateHelper;
use App\MyPackages\Livewire\Filters\Pipeline;
use App\Services\FileEncryptionService\FileService;
use App\Services\FileEncryptionService\FileServiceInterface;
use App\Validation\File\StoreValidationRules;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    use CreateHelper,WithFileUploads;
    public string $name='';
    public string $location='';
    public  $file='';
    public FileStatusEnum $status;
    public $options;

    protected string $message = '';
    protected string $view = 'user.file-upload';
    protected FileServiceInterface $fileService;
    private $query;
    public function __construct()
    {
        $this->storeValidation = app(StoreValidationRules::class);
        $this->query = app(Pipeline::class)->setModel(File::class);
        $this->message = 'File has been uploaded successfully';
        $this->options=FileStatusEnum::toArray();
        $this->fileService = app(FileService::class);
    }

    public function create():void
    {
        $validatedData = $this->validate();
        try {
            if (!empty($this->file)) {
                $filename = time() . '_' . $this->file->getClientOriginalName();
                $validatedData['size'] = $this->file->getSize();
                $validatedData['extension'] = explode('.', $filename)[1];
                $validatedData['path'] = $this->file->storeAs($this->location,$filename, 'public');
                $validatedData['user_id'] = auth()->id();
                $this->status==$this->fileService->do_operation($validatedData['status'],$validatedData['path']);
            }
            $this->query->create($validatedData);
            $this->resetInputFields();
            $this->dispatch('creating', $this->message);
        }catch (\Exception $exception){
            $this->dispatch('error', $exception->getMessage());
        }

    }

    protected function resetInputFields(): void
    {
        $this->reset(['name','location','file','status']);
        $this->dispatch('refresh_parent');
    }
}
