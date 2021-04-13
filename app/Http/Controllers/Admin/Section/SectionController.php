<?php

namespace App\Http\Controllers\Admin\Section;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = DB::table('quizzes')->orderBy('id', 'DESC')->get();
        return view('admin.section.create_section', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validator = Validator::make($request->all(), [
            'quiz_name' => 'required',
            'section_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $quiz = DB::table('quizzes')->where('q_name','=', $request->quiz_name)->first();
        $allReadyInserted = DB::table('sections')->where('q_id','=', $quiz->id)->where('s_name', '=',$request->section_name)->first();

        if($allReadyInserted){
            $notification=array(
                'message'=>'Data already inserted.',
                    'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }else{

            $data = array();
            $data['s_name'] = $request->section_name;
            $data['q_id'] = $quiz->id;
            $insert = DB::table('sections')->insert($data);
            $notification=array(
                'message'=>'Insert data successfully',
                    'alert-type'=>'info'
            );
            return redirect()->back()->with($notification);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
