<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Post\PostRepositoryInterface;
use App\Services\PostService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    private $postRepository;
    private $postService;

    /**
     * @param PostRepositoryInterface $postRepository
     * @param PostService $postService
     */
    public function __construct(
        PostRepositoryInterface $postRepository,
        PostService $postService,
    ) {
        $this->postRepository = $postRepository;
        $this->postService = $postService;
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
            ]
        );
    }
}
