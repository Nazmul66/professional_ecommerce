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


    // public function getData(Request $request)
    // {
    //     $categories = Category::all();
    //     // dd($testimonials);

    //     return DataTables::of($categories)
    //          ->addIndexColumn()
    //          ->addColumn('image', function ($category) {
    //             return '<img src="'. asset($category->image) .'" alt="" style="width: 65px;">';
    //          })
    //          ->addColumn('status', function ($category) {
    //             if ($category->status == 1) {
    //                 return '<span class="badge bg-primary cursor-pointer" id="status" data-id="'.$testimonial->id.'" data-status=" '.$testimonial->status.' ">Active</span>';
    //             } else {
    //                 return '<span class="badge bg-danger cursor-pointer" id="status" data-id="'.$testimonial->id.'" data-status=" '.$testimonial->status.' ">Deactive</span>';
    //             }
    //         })
    //         ->addColumn('action', function ($testimonial) {
    //             return '<div class="">
    //                 <button type="button" class="btn_edit" id="editButton" data-id="' . $testimonial->id . '" data-bs-toggle="modal" data-bs-target="#editModal">
    //                     <i class="bx bx-edit-alt"></i>
    //                 </button>

    //                 <button type="button" id="deleteBtn" data-id="' . $testimonial->id . '" class="btn_delete">
    //                     <i class="bx bx-trash"></i>
    //                 </button>
    //             </div>';
    //         })
    //         ->rawColumns(['image', 'review_ratings', 'status', 'action'])
    //         ->make(true);
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $testimonial = new Testimonial();

    //     $testimonial->name                = $request->name;
    //     $testimonial->position            = $request->position;
    //     $testimonial->review_ratings      = $request->review_ratings;
    //     $testimonial->description         = $request->description;
    //     $testimonial->status              = $request->status;

    //     if( $request->file('image') ){
    //         $image = $request->file('image');

    //         $imageName          = microtime('.') . '.' . $image->getClientOriginalExtension();
    //         $imagePath          = 'public/backend/image/testimonial/';
    //         $image->move($imagePath, $imageName);

    //         $testimonial->image   = $imagePath . $imageName;
    //     }

    //     $testimonial->save();

    //     return response()->json(['message' => 'Successfully Testimonial Created', 'status' => true], 200);
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function adminTestimonialStatus(Request $request)
    // {
    //     $id = $request->id;
    //     $Current_status = $request->status;

    //     if ($Current_status == 1) {
    //         $status = 0;
    //     } else {
    //         $status = 1;
    //     }

    //     $page = Testimonial::find($id);
    //     $page->status = $status;
    //     $page->save();

    //     return response()->json(['message' => 'success', 'status' => $status], 200);
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     $testimonial = Testimonial::find($id);
    //     return response()->json(['success' => $testimonial]);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     // dd($request->all());

    //     $testimonial  = Testimonial::find($id);

    //     $testimonial->name                = $request->name;
    //     $testimonial->position            = $request->position;
    //     $testimonial->review_ratings      = $request->review_ratings;
    //     $testimonial->description         = $request->description;
    //     $testimonial->status              = $request->status;

    //     if( $request->file('image') ){
    //         $image = $request->file('image');

    //         if( !is_null($testimonial->image) && file_exists($testimonial->image) ){
    //             unlink($testimonial->image);
    //          }

    //         $imageName          = microtime('.') . '.' . $image->getClientOriginalExtension();
    //         $imagePath          = 'public/backend/image/testimonial/';
    //         $image->move($imagePath, $imageName);

    //         $testimonial->image   = $imagePath . $imageName;
    //     }

    //     $testimonial->save();

    //     return response()->json(['message'=> "success"], 200);
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     $testimonial = Testimonial::find($id);

    //     if ( !is_null($testimonial->image) ) {
    //         if (file_exists($testimonial->image)) {
    //             unlink($testimonial->image);
    //         }
    //     }
    //     $testimonial->delete();

    //     return response()->json(['message' => 'Testimonial has been deleted.'], 200);
    // }
}
