<?php
namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use \CodeProject\Validators\ProjectValidator;

class ProjectService {
    private $projectRepository;
    private $projectValidator;
    
    public function __construct(ProjectRepository $projectRepository, ProjectValidator $projectValidator) {
        $this->projectRepository = $projectRepository;
        $this->projectValidator = $projectValidator;
    }
    
    public function create($data) {
        try {
            $this->projectValidator->with($data)->passesOrFail();
            return $this->projectRepository->create($data);
        } catch(\Prettus\Validator\Exceptions\ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }
    
    public function update($data, $id) {
        try {
            $this->projectValidator->with($data)->passesOrFail();
            return $this->projectRepository->update($data, $id);
        } catch(\Prettus\Validator\Exceptions\ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }
    
    public function createFile(array $data) {
        $project = $this->projectRepository->skipPresenter()->find($data['project_id']);
        $projectFile = $project->files()->create($data);
        
        \Illuminate\Support\Facades\Storage::put($projectFile->id. '.'. $data['extension'], \Illuminate\Support\Facades\File::get($data['file']));
    }
}
