<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        return view('backend.pages.sub_category.index', compact('categories'));
    }

    public function getData()
    {
        $subCategories = DB::table('sub_categories')
                        ->leftJoin('categories', 'categories.id', 'sub_categories.category_id')
                        ->select('sub_categories.*', 'categories.cat_name')
                        ->get();
        // dd($subCategories);

        return DataTables::of($subCategories)
             ->addIndexColumn()
             ->addColumn('image', function ($subCategory) {
                return '<img src="'. asset($subCategory->image) .'" alt="" style="width: 65px;">';
             })
             ->addColumn('cat_name', function ($subCategory) {
                return '<span class="badge badge-success">'. $subCategory->cat_name .'</span>';
             })
             ->addColumn('subCat_name', function ($subCategory) {
                return '<span class="badge badge-info">'. $subCategory->name .'</span>';
             })
             ->addColumn('status', function ($subCategory) {
                if ($subCategory->status == 1) {
                    return '<span class="badge bg-primary" style="cursor: pointer;" id="status" data-id="'.$subCategory->id.'" data-status=" '.$subCategory->status.' ">Active</span>';
                } else {
                    return '<span class="badge bg-danger" style="cursor: pointer;" id="status" data-id="'.$subCategory->id.'" data-status=" '.$subCategory->status.' ">Deactive</span>';
                }
            })
            ->addColumn('action', function ($subCategory) {
                return '<div class="action_btn">
                   <button type="button" class="btn_primary" id="editButton" data-id="' . $subCategory->id . '" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bx bx-edit-alt"></i></button>

                   <button type="button"  class="btn_danger" id="deleteBtn" data-id="' . $subCategory->id . '"><i class="bx bx-trash"></i></button>
                </div>';
            })
            ->rawColumns(['image', 'cat_name', 'subCat_name', 'status', 'action'])
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
                'category_id' => ['required'],
                'name' => ['required', 'unique:sub_categories', 'max:255'],
                'image' => ['required', 'image'],
                'status' => ['required'],
            ],
            [
                'category_id.required' => 'Please select category name',
                'name.required' => 'Please fill up subCategory name',
                'name.max' => 'Character might be 255 word',
                'name.unique' => 'Character might be unique',
                'image.required' => 'Image is required',
                'status.required' => 'status is required',
            ]
        );

        $subCategory = new SubCategory();

        $subCategory->category_id         = $request->category_id;
        $subCategory->name                = $request->name;
        $subCategory->slug                = Str::slug($request->name);
        $subCategory->status              = $request->status;

        if( $request->file('image') ){
            $images = $request->file('image');

            $imageName            = microtime('.') . '.' . $images->getClientOriginalExtension();
            $imagePath            = 'public/backend/image/subCategory/';
            $images->move($imagePath, $imageName);

            $subCategory->image   = $imagePath . $imageName;
        }

        $subCategory->save();

        return response()->json(['message' => 'Successfully SubCategory Created', 'status' => true], 200);
    }

    /**
     * Display the specified resource.
     */
    public function adminSubCategoryStatus(Request $request)
    {
        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = SubCategory::find($id);
        $page->status = $status;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $status], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subCategory = SubCategory::find($id);
        return response()->json(['success' => $subCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $subCategory  = SubCategory::find($id);

        $request->validate(
            [
                'name' => ['required', 'max:255', 'unique:sub_categories,name,'. $subCategory->id ],
            ],
            [
                'name.required' => 'Please fill up subCategory name',
                'name.max' => 'Character might be 255 word',
                'name.unique' => 'Character might be unique',
            ]
        );


        $subCategory->category_id         = $request->category_id;
        $subCategory->name                = $request->name;
        $subCategory->slug                = Str::slug($request->name);
        $subCategory->status              = $request->status;

        if( $request->file('image') ){
            $images = $request->file('image');

            if( !is_null($subCategory->image) && file_exists($subCategory->image) ){
                unlink($subCategory->image);
            }

            $imageName            = microtime('.') . '.' . $images->getClientOriginalExtension();
            $imagePath            = 'public/backend/image/subCategory/';
            $images->move($imagePath, $imageName);

            $subCategory->image   = $imagePath . $imageName;
        }

        $subCategory->save();

        return response()->json(['message'=> "success"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::find($id);

        if ( !is_null($subCategory->image) ) {
            if (file_exists($subCategory->image)) {
                unlink($subCategory->image);
            }
        }
        $subCategory->delete();

        return response()->json(['message' => 'SubCategory has been deleted.'], 200);
    }
}
