<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;

use CodeProject\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CodeProject\Http\Requests\ProjectNoteCreateRequest;
use CodeProject\Http\Requests\ProjectNoteUpdateRequest;
use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Validators\ProjectNoteValidator;
use CodeProject\Services\ProjectNoteService;


class ProjectNoteController extends Controller
{

    /**
     * @var ProjectNoteRepository
     */
    protected $repository;

    /**
     * @var ProjectNoteValidator
     */
    protected $validator;
    
    /**
     * @var ProjectNoteService
     */
    protected $service;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator, ProjectNoteService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service  = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projectId)
    {
        
        return $this->repository->findWhere(['project_id' => $projectId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectNoteCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectNoteCreateRequest $request)
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
    public function show($id, $noteId)
    {
        return $this->repository->findWhere(['project_id' => $id, 'id' => $noteId]);
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
     * @param  ProjectNoteUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ProjectNoteUpdateRequest $request, $id, $noteId)
    {


        return $this->service->update($request->all(), $noteId);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $noteId)
    {
        return $this->repository->delete($noteId);
    }
}
