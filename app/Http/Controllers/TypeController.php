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
        return view('types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
      {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
         ]);

        if($request->status == "on"){
        $postData['status'] = 1;
    }else if($request->status == "off"){
        $postData['status'] = 0;
    }

    
  $request['created_by'] = Auth::user()->id;
        Type::create($request->all());
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
       // $data['type'] = $type;
       //  return view('types.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {   //dd($type);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
        $updateData = $request->all();
        
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
        //
    }
      public function updateStatus(Request $request, type $type)
    {
        $type->status = $request->status;
        return (($type->update())?1:0);
    }
}
