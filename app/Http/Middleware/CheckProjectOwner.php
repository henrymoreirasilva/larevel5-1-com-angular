<?php

namespace CodeProject\Http\Middleware;

use Closure;

class CheckProjectOwner
{
    private $projectRepository;
    
    public function __construct(\CodeProject\Repositories\ProjectRepository $projectRepository) {
        $this->projectRepository = $projectRepository;
    }
        
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = \LucaDegasperi\OAuth2Server\Facades\Authorizer::getResourceOwnerId();
        $projectId = $request->project;

        if ($this->projectRepository->isOwner($projectId, $userId) == false) {
            return ['success' => false];
        }
        return $next($request);
    }
}
