<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\User;
use App\Models\Category;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::with('category', 'user')->paginate(8);

        return view('admin.post.post', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
       $category = Category::get();
        return view('admin.post.addpost',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validatedData = $request->validate([

            'category'       => 'required',
            'name'             => 'required|min:10|max:25',
            'content'           => 'required|max:500',
            'image'            => 'required|image',
            'status'            => 'required',
         ]);

           try{ $image    = $request->file('image');
            $fileName = rand(0, 999999999) . '_' . date('Ymdhis') . '_' . rand(99999, 999999999) . '.' . $image->getClientOriginalExtension();
            if ($image->isValid()) {
                if ($image->getMimeType() === "image/png" || $image->getMimeType() === "image/jpeg") {
                     $image->storeAs('post', $fileName);
                } else {
                    $this->errorMessage("Something wrong image!");
                    return redirect()->back();
                }
            }
      $post =  Post::create([
            'user_id' => auth()->user()->id,
            'category_id' =>$request->category,
            'title' => $request->name,
            'content' => $request->content,
            'thumbnail' => $fileName,
            'status' => $request->status,

        ]);

     


            $this->successMessage("post  Data seve success!");
            return redirect()->back();
        } catch (\Exception $e) {
            $this->errorMessage("Something wrong!");
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::get();
        $editData = Post::find($id);
        
        return view('admin.post.edit', compact('editData', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([

            'category_id'       => 'required',
            'name'             => 'required|min:10|max:25',
            'content'           => 'required|max:500',
            'status'            => 'required',
         ]);

      $update = Post::Find($id);

            $image    = $request->file('image');
           if ($image !=null ) {

                $fileName = rand(0, 999999999) . '_' . date('Ymdhis') . '_' . rand(99999, 999999999) . '.' . $image->getClientOriginalExtension();
            if ($image->isValid()) {
                if ($image->getMimeType() === "image/png" || $image->getMimeType() === "image/jpeg") {
                     $image->storeAs('post', $fileName);
                    unlink(public_path('uploads/post/' . $update->thumbnail));

                      $update->update([
                        'thumbnail' => $fileName,
                    ]);
                } else {
                    $this->errorMessage("Something wrong image!");
                    return redirect()->back();
                }
            }
       
      
        $update->update([
        'category_id'    => $request->category_id,
        'title'    => $request->name,
        'content'    => $request->content,
        
        'status'    => $request->status,

        ]);
           }else{
   
        $update->update([
        'category_id'    => $request->category_id,
        'title'    => $request->name,
        'content'    => $request->content,
        
        'status'    => $request->status,

        ]);
           }


         $this->successMessage("Post Update  success!");
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $delete = Post::find($id);

        $delete->delete();
        try{
         $this->successMessage("Post Delete success!");
        return redirect()->back();
       }
       catch(Exception $e){
         $this->errorMessage("Something wrong!");
            return redirect()->back();
       }
    }
}
