<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // dd($request->wantsJson());
        if ($request->wantsJson()){
            $type = new Type();
            return $type->DataTableLoader($request);
        }
        return view('types.index');    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Type $type) 
      {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
         ]);

        $postData = $request->all();
        $postData['created_by'] = Auth::id();
        Type::create($postData);
}

    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
       return $type;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
     {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $updateData = $request->all();
        $updateData['modified_by'] = Auth::id();
        $type->update($updateData);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
    }
      public function updateStatus(Request $request, type $type)
    {
        if($request->status != NULL){
            $type->status = $request->status;
        }
        return (($type->update()) ? 1 : 0);
    }
}
