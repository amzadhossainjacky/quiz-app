<?php

namespace App\Http\Controllers\Admin\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;

class QuestionController extends Controller
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
        $data = DB::table('quizzes')->orderBy('id', 'DESC')->get();
        return view('admin.question.create_question', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quiz_id' => 'required',
            'section_name' => 'required',
            'type' => 'required',
            'question_name' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'answer' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        //section_name acquired section id
        //question name check
        $allReadyInserted = DB::table('questions')->where('s_id','=', $request->section_name)->where('ques_name', '=',$request->question_name)->first();

        if($allReadyInserted){
            $notification=array(
                'message'=>'Question name already inserted',
                    'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }else{
            $data1 = array();
            $data1['ques_name'] = $request->question_name;
            $data1['s_id'] = $request->section_name; 
            $data1['ques_answer'] = $request->answer;
            $data1['ques_type'] = $request->type;
            $ques_id=DB::table('questions')->insertGetId($data1);
            
            $data2 = array();
            $data2['ques_id'] = $ques_id;
            $data2['a'] = $request->option_a;
            $data2['b'] = $request->option_b;
            $data2['c'] = $request->option_c;
            $data2['d'] = $request->option_d;
    
            DB::table('options')->insertGetId($data2);
    
            $notification=array(
                'message'=>'Insert Question successfully',
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

    public function getSection($id){
        $section = DB::table('sections')->where('q_id', $id)->get();
        return json_encode($section);
    }
}
