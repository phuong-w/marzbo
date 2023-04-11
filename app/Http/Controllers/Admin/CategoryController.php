<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        // Permissions validations
        $this->middleware('permission:' . Acl::PERMISSION_CATEGORY_LIST)->only(['index', 'show']);
        $this->middleware('permission:' . Acl::PERMISSION_CATEGORY_ADD)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_CATEGORY_EDIT)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_CATEGORY_DELETE)->only('destroy');

        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = $this->categoryRepository->serverPaginationFilteringFor($request->all());

        return Inertia::render('Admin/Category/Index', [
            'categories' => CategoryResource::collection($categories)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Category/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->categoryRepository->create($request->validated());
        session()->flash(NOTIFICATION_SUCCESS, __('success.category.store'));
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function edit(Category $category): Response
    {
        return Inertia::render('Admin/Category/Edit', [
            'category' => new CategoryResource($category)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $this->categoryRepository->update($category, $request->validated());
        session()->flash(NOTIFICATION_SUCCESS, __('success.category.update'));
        return to_route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $this->categoryRepository->destroy($category);
        session()->flash(NOTIFICATION_SUCCESS, __('success.category.delete'));
        return back();
    }

    /**
     * Update the specified resource status in storage.
     *
     * @param Category $category
     * @return Category
     */
    public function toggleStatus(Category $category)
    {
        $this->categoryRepository->toggleStatus($category);
        return $category;
    }
}
