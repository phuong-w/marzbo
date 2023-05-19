<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\PostService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    private $postRepository;
    private $userRepository;

    /**
     * @param PostRepositoryInterface $postRepository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        PostRepositoryInterface $postRepository,
        UserRepositoryInterface $userRepository,
    ) {
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        $stas = $this->postRepository->getStasOfLastTwelveMonths();
        return Inertia::render('Admin/Dashboard',
            [
                'months' => $stas['months'],
                'average_total_view' => $stas['average_total_view'],
                'average_total_comment' => $stas['average_total_comment'],
                'average_total_react' => $stas['average_total_react'],
                'total_post' => $this->postRepository->countTotalPosts(),
                'total_user' => $this->userRepository->countTotalUsers(),
            ]
        );
    }
}
