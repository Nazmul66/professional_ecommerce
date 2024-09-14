<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view('backend.pages.category.index');
    }

    public function getData()
    {
        $categories = Category::all();
        // dd($testimonials);

        return DataTables::of($categories)
             ->addIndexColumn()
             ->addColumn('cat_image', function ($category) {
                return '<img src="'. asset($category->cat_image) .'" alt="" style="width: 65px;">';
             })
             ->addColumn('status', function ($category) {
                if ($category->status == 1) {
                    return '<span class="badge bg-primary" style="cursor: pointer;" id="status" data-id="'.$category->id.'" data-status=" '.$category->status.' ">Active</span>';
                } else {
                    return '<span class="badge bg-danger" style="cursor: pointer;" id="status" data-id="'.$category->id.'" data-status=" '.$category->status.' ">Deactive</span>';
                }
            })
            ->addColumn('action', function ($category) {
                return '<div class="action_btn">
                   <button type="button" class="btn_primary" id="editButton" data-id="' . $category->id . '" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bx bx-edit-alt"></i></button>

                   <button type="button"  class="btn_danger" id="deleteBtn" data-id="' . $category->id . '"><i class="bx bx-trash"></i></button>
                </div>';
            })
            ->rawColumns(['cat_image', 'status', 'action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate(
            [
                'cat_name' => ['required', 'unique:categories', 'max:255'],
                'cat_image' => ['required', 'image'],
                'status' => ['required'],
            ],
            [
                'cat_name.required' => 'Please fill up category name',
                'cat_name.max' => 'Character might be 255',
                'cat_name.unique' => 'Character might be unique',
                'cat_image.required' => 'cat Image is required',
                'status.required' => 'status is required',
            ]
        );

        $category = new Category();

        $category->cat_name            = $request->cat_name;
        $category->slug                = Str::slug($request->cat_name);
        $category->status              = $request->status;

        if( $request->file('cat_image') ){
            $cat_image = $request->file('cat_image');

            $imageName          = microtime('.') . '.' . $cat_image->getClientOriginalExtension();
            $imagePath          = 'public/backend/image/category/';
            $cat_image->move($imagePath, $imageName);

            $category->cat_image   = $imagePath . $imageName;
        }

        $category->save();

        return response()->json(['message' => 'Successfully Category Created', 'status' => true], 200);
    }

    /**
     * Display the specified resource.
     */
    public function adminCategoryStatus(Request $request)
    {
        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = Category::find($id);
        $page->status = $status;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $status], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return response()->json(['success' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $category  = Category::find($id);

        $request->validate(
            [
                'cat_name' => ['required', 'max:255', 'unique:categories,cat_name,'. $category->id ],
                'status' => ['required'],
            ],
            [
                'cat_name.required' => 'Please fill up category name',
                'cat_name.max' => 'Character might be 255',
                'cat_name.unique' => 'Character might be unique',
                'status.required' => 'status is required',
            ]
        );


        $category->cat_name            = $request->cat_name;
        $category->slug                = Str::slug($request->cat_name);
        $category->status              = $request->status;

        if( $request->file('cat_image') ){
            $cat_image = $request->file('cat_image');

            
            if( !is_null($category->cat_image) && file_exists($category->cat_image) ){
                unlink($category->cat_image);
             }

            $imageName          = microtime('.') . '.' . $cat_image->getClientOriginalExtension();
            $imagePath          = 'public/backend/image/category/';
            $cat_image->move($imagePath, $imageName);

            $category->cat_image   = $imagePath . $imageName;
        }

        $category->save();

        return response()->json(['message'=> "success"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if ( !is_null($category->cat_image) ) {
            if (file_exists($category->cat_image)) {
                unlink($category->cat_image);
            }
        }
        $category->delete();

        return response()->json(['message' => 'Category has been deleted.'], 200);
    }
}
