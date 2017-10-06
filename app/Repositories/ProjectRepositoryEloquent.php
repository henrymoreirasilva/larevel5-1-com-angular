<?php

namespace CodeProject\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Entities\Project;
use CodeProject\Presenters\ProjectPresenter;
/**
 * Class ProjectRepositoryEloquent
 * @package namespace CodeProject\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    protected $skipPresenter = false;
    
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }
    
    public function isOwner($projectId, $userId) {
        
        if (count($this->findWhere(['id' => $projectId, 'owner_id' => $userId])) > 0) {
            return true;
        }
        return false;
    }
    
    public function hasMember($projectId, $memberId) {
        $r = FALSE;
        $this->skipPresenter = true;
        $project = $this->find($projectId);
        
        foreach ($project->members as $member) {
            if ($member->id == $memberId) {
                $r = TRUE;
                break;
            }
        }
        $this->skipPresenter = false;
        return $r;
        
    }
    
    public function presenter() {
        return ProjectPresenter::class;
    }

}
