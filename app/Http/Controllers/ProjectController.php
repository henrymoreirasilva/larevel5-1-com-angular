<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;


class ProjectController extends Controller
{
    
    /**
     * @var ProjectRepository
     */
    protected $repository;

    /**
     * @var ProjectService
     */
    protected $service;

    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service  = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return $this->repository->with(['client', 'owner', 'notes'])->findWhere(['owner_id' => \Authorizer::getResourceOwnerId()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($this->checkProjectPermissions($id)) {
            return $this->repository->find($id);
        } else {
            return ['error' => 'Access forbiden!'];
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ProjectUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if ($this->checkProjectOwner($id)) {
            return $this->service->update($request->all(), $id);
        } else {
            return ['error' => 'Access forbiden!'];
        }
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if ($this->checkProjectOwner($id)) {
            return $this->repository->delete($id);
        } else {
            return ['error' => 'Access forbiden!'];
        }
    }
    
    public function checkProjectOwner($projectId) {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($projectId, $userId);
    }
    
    public function checkProjectMember($projectId) {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($projectId, $userId);
    }
    
    public function checkProjectPermissions($projectId) {
        return $this->checkProjectMember($projectId) or $this->checkProjectOwner($projectId);
    }
}
