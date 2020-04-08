<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
Use config\Session;
class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = Category::Select('id', 'name','slug', 'status')->paginate(5);
       return view('admin.category.Category', compact('cat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
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

            'name'                  => 'required | max:50',
            'status'                  => 'required',

         ]);
        
       try{

         $data = [
        'name' => $request->name,
        'slug' => $request->name,
        'status' => $request->status,


        ];
        Category::create($data);
         $this->successMessage("Category seve success!");
        return redirect()->back();
    }catch(Exception $e){
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
    public function edit($id, $name, $status)
    {
        
         $data = Category::Select('id', 'name', 'status')->find($id);
           
        
       return view('admin.category.edit', compact('data'));
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
        $category = Category::find($id); 

      
         $category->update([
        'name'    => $request->name,
        'slug'    => $request->name,
        'status'  => $request->status,


        ]);
       
         $this->successMessage("Category seve success!");
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
        
     $category =  Category::find($id);   
     $category->delete();
       try{
         $this->successMessage("Category Delete success!");
        return redirect()->back();
       }
       catch(Exception $e){
         $this->errorMessage("Something wrong!");
            return redirect()->back();
       }
    }
}
