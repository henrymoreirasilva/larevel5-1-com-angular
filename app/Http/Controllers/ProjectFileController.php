<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use \CodeProject\Services\ProjectService;


class ProjectFileController extends Controller
{

    private $projectService;
    
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectNoteCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $data['file'] = $file;
        $data['extension'] = $file->getClientOriginalExtension();
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['project_id'] = $request->project_id;

        return $this->projectService->createFile($data);
    }


}
