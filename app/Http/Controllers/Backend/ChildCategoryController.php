<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ChildCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $subCategories = SubCategory::where('status', 1)->get();
        return view('backend.pages.child_category.index', compact('categories', 'subCategories'));
    }

    public function getData()
    {
        $childCategories = DB::table('child_categories')
                        ->leftJoin('categories', 'categories.id', 'child_categories.category_id')
                        ->leftJoin('sub_categories', 'sub_categories.id', 'child_categories.subCategory_id')
                        ->select('child_categories.*', 'categories.cat_name', 'sub_categories.name as subCat_name')
                        ->get();
        // dd($subCategories);

        return DataTables::of($childCategories)
             ->addIndexColumn()
             ->addColumn('image', function ($childCategory) {
                return '<img src="'. asset($childCategory->image) .'" alt="" style="width: 65px;">';
             })
             ->addColumn('cat_name', function ($childCategory) {
                return '<span class="badge badge-success">'. $childCategory->cat_name .'</span>';
             })
             ->addColumn('subCat_name', function ($childCategory) {
                return '<span class="badge badge-info">'. $childCategory->subCat_name .'</span>';
             })
             ->addColumn('childCat_name', function ($childCategory) {
                return '<span class="badge badge-dark tag-pills-sm-mb">'. $childCategory->name .'</span>';
             })
             ->addColumn('status', function ($childCategory) {
                if ($childCategory->status == 1) {
                    return '<span class="badge bg-primary" style="cursor: pointer;" id="status" data-id="'.$childCategory->id.'" data-status=" '.$childCategory->status.' ">Active</span>';
                } else {
                    return '<span class="badge bg-danger" style="cursor: pointer;" id="status" data-id="'.$childCategory->id.'" data-status=" '.$childCategory->status.' ">Deactive</span>';
                }
            })
            ->addColumn('action', function ($childCategory) {
                return '<div class="action_btn">
                   <button type="button" class="btn_primary" id="editButton" data-id="' . $childCategory->id . '" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bx bx-edit-alt"></i></button>

                   <button type="button"  class="btn_danger" id="deleteBtn" data-id="' . $childCategory->id . '"><i class="bx bx-trash"></i></button>
                </div>';
            })
            ->rawColumns(['image', 'cat_name', 'subCat_name', 'childCat_name', 'status', 'action'])
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
                'subCategory_id' => ['required'],
                'category_id' => ['required'],
                'name' => ['required', 'unique:child_categories', 'max:255'],
                'image' => ['required', 'image'],
                'status' => ['required'],
            ],
            [
                'category_id.required' => 'Please select category name',
                'subCategory_id.required' => 'Please select subCategory name',
                'name.required' => 'Please fill up childCategory name',
                'name.max' => 'Character might be 255 word',
                'name.unique' => 'Character might be unique',
                'image.required' => 'Image is required',
                'status.required' => 'status is required',
            ]
        );

        $childCategory  =  new ChildCategory();

        $childCategory->category_id            = $request->category_id;
        $childCategory->subCategory_id         = $request->subCategory_id;
        $childCategory->name                   = $request->name;
        $childCategory->slug                   = Str::slug($request->name);
        $childCategory->status                 = $request->status;

        if( $request->file('image') ){
            $images = $request->file('image');

            $imageName            = microtime('.') . '.' . $images->getClientOriginalExtension();
            $imagePath            = 'public/backend/image/childCategory/';
            $images->move($imagePath, $imageName);

            $childCategory->image   = $imagePath . $imageName;
        }

        $childCategory->save();

        return response()->json(['message' => 'Successfully ChildCategory Created', 'status' => true], 200);
    }

    /**
     * Display the specified resource.
     */
    public function adminChildCategoryStatus(Request $request)
    {
        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = ChildCategory::find($id);
        $page->status = $status;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $status], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $childCategory = ChildCategory::find($id);
        return response()->json(['success' => $childCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $childCategory  = ChildCategory::find($id);

        $request->validate(
            [
                'name' => ['required', 'max:255', 'unique:child_categories,name,'. $childCategory->id ],
            ],
            [
                'name.required' => 'Please fill up childCategory name',
                'name.max' => 'Character might be 255 word',
                'name.unique' => 'Character might be unique',
            ]
        );


        $childCategory->category_id            = $request->category_id;
        $childCategory->subCategory_id         = $request->subCategory_id;
        $childCategory->name                   = $request->name;
        $childCategory->slug                   = Str::slug($request->name);
        $childCategory->status                 = $request->status;

        if( $request->file('image') ){
            $images = $request->file('image');

            if( !is_null($childCategory->image) && file_exists($childCategory->image) ){
                unlink($childCategory->image);
            }

            $imageName            = microtime('.') . '.' . $images->getClientOriginalExtension();
            $imagePath            = 'public/backend/image/childCategory/';
            $images->move($imagePath, $imageName);

            $childCategory->image   = $imagePath . $imageName;
        }

        $childCategory->save();

        return response()->json(['message'=> "success"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $childCategory = ChildCategory::find($id);

        if ( !is_null($childCategory->image) ) {
            if (file_exists($childCategory->image)) {
                unlink($childCategory->image);
            }
        }
        $childCategory->delete();

        return response()->json(['message' => 'ChildCategory has been deleted.'], 200);
    }
}
