<?php
namespace CodeProject\Services;

use CodeProject\Repositories\ProjectNoteRepository;
use \CodeProject\Validators\ProjectNoteValidator;

class ProjectNoteService {
    private $projectNoteRepository;
    private $projectNoteValidator;
    
    public function __construct(ProjectNoteRepository $projectNoteRepository, ProjectNoteValidator $projectNoteValidator) {
        $this->projectNoteRepository = $projectNoteRepository;
        $this->projectNoteValidator = $projectNoteValidator;
    }
    
    public function create($data) {
        try {
            $this->projectNoteValidator->with($data)->passesOrFail();
            
            return $this->projectNoteRepository->create($data);
        } catch(\Prettus\Validator\Exceptions\ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }
    
    public function update($data, $id) {
        try {
            $this->projectNoteValidator->with($data)->passesOrFail();
            return $this->projectNoteRepository->update($data, $id);
        } catch(\Prettus\Validator\Exceptions\ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }
}
