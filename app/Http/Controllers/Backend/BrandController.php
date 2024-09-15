<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        return view('backend.pages.brand.index');
    }

    public function getData()
    {
        $brands = Brand::all();
        // dd($testimonials);

        return DataTables::of($brands)
             ->addIndexColumn()
             ->addColumn('logo', function ($brand) {
                return '<img src="'. asset($brand->logo) .'" alt="" style="width: 65px;">';
             })
             ->addColumn('featured', function ($brand) {
                if ($brand->is_featured == 1) {
                    return '<span class="badge badge-success" style="cursor: pointer;">Yes</span>';
                } else {
                    return '<span class="badge badge-Dark" style="cursor: pointer;">NO</span>';
                }
            })
             ->addColumn('status', function ($brand) {
                if ($brand->status == 1) {
                    return '<span class="badge bg-primary" style="cursor: pointer;" id="status" data-id="'.$brand->id.'" data-status=" '.$brand->status.' ">Active</span>';
                } else {
                    return '<span class="badge bg-danger" style="cursor: pointer;" id="status" data-id="'.$brand->id.'" data-status=" '.$brand->status.' ">Deactive</span>';
                }
            })
            ->addColumn('action', function ($brand) {
                return '<div class="action_btn">
                   <button type="button" class="btn_primary" id="editButton" data-id="' . $brand->id . '" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bx bx-edit-alt"></i></button>

                   <button type="button"  class="btn_danger" id="deleteBtn" data-id="' . $brand->id . '"><i class="bx bx-trash"></i></button>
                </div>';
            })
            ->rawColumns(['logo', 'featured', 'status', 'action'])
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
                'logo' => ['required'],
                'name' => ['required', 'unique:brands', 'max:255'],
                'is_featured' => ['required'],
                'status' => ['required'],
            ],
            [
                'logo.required' => 'Brand logo is required',
                'name.required' => 'Please fill up brand name',
                'name.max' => 'Character might be 255',
                'name.unique' => 'Character might be unique',
                'is_featured.required' => 'Is_featured this field',
                'status.required' => 'Status is required',
            ]
        );

        $brand = new Brand();

        $brand->name                = $request->name;
        $brand->slug                = Str::slug($request->name);
        $brand->status              = $request->status;

        if( $request->file('logo') ){
            $logo = $request->file('logo');

            $imageName          = microtime('.') . '.' . $logo->getClientOriginalExtension();
            $imagePath          = 'public/backend/image/brand/';
            $logo->move($imagePath, $imageName);

            $brand->logo     = $imagePath . $imageName;
        }

        $brand->save();

        return response()->json(['message' => 'Successfully Brand Created', 'status' => true], 200);
    }

    /**
     * Display the specified resource.
     */
    public function adminBrandStatus(Request $request)
    {
        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = Brand::find($id);
        $page->status = $status;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $status], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::find($id);
        return response()->json(['success' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $brand  = Brand::find($id);

        $request->validate(
            [
                'name' => ['required', 'unique:brands,name,'. $brand->id , 'max:255'],
                'status' => ['required'],
            ],
            [
                'name.required' => 'Please fill up brand name',
                'name.max' => 'Character might be 255',
                'name.unique' => 'Character might be unique',
                'status.required' => 'Status is required',
            ]
        );

        $brand->name                = $request->name;
        $brand->slug                = Str::slug($request->name);
        $brand->status              = $request->status;

        if( $request->file('logo') ){
            $logo = $request->file('logo');

            if( !is_null($brand->logo) && file_exists($brand->logo) ){
                unlink($brand->logo);
             }

            $imageName          = microtime('.') . '.' . $logo->getClientOriginalExtension();
            $imagePath          = 'public/backend/image/brand/';
            $logo->move($imagePath, $imageName);

            $brand->logo     = $imagePath . $imageName;
        }

        $brand->save();

        return response()->json(['message'=> "success"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);

        if ( !is_null($brand->logo) ) {
            if (file_exists($brand->logo)) {
                unlink($brand->logo);
            }
        }
        $brand->delete();

        return response()->json(['message' => 'Brand has been deleted.'], 200);
    }
}
