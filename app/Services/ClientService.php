<?php
namespace CodeProject\Services;

use \CodeProject\Repositories\ClientRepository;
use \CodeProject\Validators\ClientValidator;

class ClientService {
    private $clientRepository;
    private $clientValidator;
    
    public function __construct(ClientRepository $clientRepository, ClientValidator $clientValidator) {
        $this->clientRepository = $clientRepository;
        $this->clientValidator = $clientValidator;
    }
    
    public function create($data) {
        try {
            $this->clientValidator->with($data)->passesOrFail();
            return $this->clientRepository->create($data);
        } catch(\Prettus\Validator\Exceptions\ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }
    
    public function update($data, $id) {
        try {
            $this->clientValidator->with($data)->passesOrFail();
            return $this->clientRepository->update($data, $id);
        } catch(\Prettus\Validator\Exceptions\ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }
}
