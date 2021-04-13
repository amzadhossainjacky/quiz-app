<?php

namespace App\Http\Controllers\Admin\Quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetch quiz list
        $data = DB::table('quizzes')->orderBy('id', 'DESC')->get();
        return view('admin.quiz.view_all', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //view form for add new quiz
        return view('admin.quiz.create_quiz');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate data for quiz input fields
        $validator = Validator::make($request->all(), [
            'name' => 'required | unique:quizzes,q_name',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $data = array();
        $data['q_name'] = $request->name;
        //stored quiz
        $insert = DB::table('quizzes')->insert($data);
        
        //notification
        if($insert){
            $notification=array(
                'message'=>'Insert data successfully',
                    'alert-type'=>'info'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'message'=>'Data Not Inserted',
                    'alert-type'=>'error'
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
        //view for editing quiz
        $data = DB::table('quizzes')->where('id', $id)->first();
        return view('admin.quiz.edit_quiz', compact('data'));
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
        //validate data
        $validator = Validator::make($request->all(), [
            'name' => "required | unique:quizzes,q_name,$id",
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $data = array();
        $data['q_name'] = $request->name;
        //stored data after updated
        $update = DB::table('quizzes')->where('id', $id)->update($data);

        //notification
        if($update){
            $notification=array(
                'message'=>'Update data successfully',
                    'alert-type'=>'info'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'message'=>'Data not updated',
                    'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete quiz
        DB::table('quizzes')->where('id', $id)->delete();
        //notification
        $notification=array(
            'message'=>'Data deleted',
                'alert-type'=>'error'
        );
        return redirect()->back()->with($notification);
    }
}
