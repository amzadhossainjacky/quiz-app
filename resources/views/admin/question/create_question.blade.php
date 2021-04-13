@extends('layouts.adminMaster')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br><br><br>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center text-center">
          <div class="col-md-12">
              <h2> Create Question</h2>
          </div>
          <div class="col-md-5">
            <div class="card mt-4">
                <div class="card-header">
                    @if ($errors->any())
                        <ul class="alert alert-danger p-0 m-0">
                            @foreach ($errors->all() as $error)
                                <li style="list-style: none">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form action="{{route('store.question')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="quiz">Quiz Name</label>
                            <select class="form-control" id="" name="quiz_id">
                              <option>Select Quiz</option>
                              @foreach ($data as $row)
                                <option value="{{$row->id}}">{{$row->q_name}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="quiz">Section Name</label>

                            <select class="form-control select2" data-placeholder="Section Name"  name="section_name">

                              {{-- data comes through ajax --}}
                              
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="quiz">Type</label>
                            <select class="form-control" id="" name="type">
                              <option value="single">single</option>
                              <option value="multiple">multiple</option>
                            </select>
                          </div>
                          
                        <div class="form-group">
                          <label for="question_name">Question Name</label>
                          <input type="text" class="form-control" id="" name="question_name">
                        </div>
                        <div class="form-group">
                            <h4>Question Option</h4>
                        </div>
                        <div class="form-group">
                            <label for="option_a">Option A</label>
                            <input type="text" class="form-control" id="" name="option_a">
                        </div>
                        <div class="form-group">
                            <label for="option_b">Option B</label>
                            <input type="text" class="form-control" id="" name="option_b">
                        </div>
                        <div class="form-group">
                            <label for="option_c">Option C</label>
                            <input type="text" class="form-control" id="" name="option_c">
                        </div>
                        <div class="form-group">
                            <label for="option_d">Option D</label>
                            <input type="text" class="form-control" id="" name="option_d">
                        </div>
                        <div class="form-group">
                          <h4>Enter Answer</h4>
                      </div>
                      <div class="form-group">
                          <label for="answer">Answer</label>
                          <input type="text" class="form-control" id="" name="answer">
                      </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
  </script>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

  <script type="text/javascript">
	  $(document).ready(function() {
         $('select[name="quiz_id"]').on('change', function(){
             var quiz_id = $(this).val();
             if(quiz_id) {
                 $.ajax({
                     url: "{{  url('/get/section/') }}/"+quiz_id,
                     type:"GET",
                     dataType:"json",
                     success:function(data) {
                        var d =$('select[name="section_name"]').empty();
                           $.each(data, function(key, value){
                               $('select[name="section_name"]').append('<option value="'+ value.id +'">' + value.s_name + '</option>');
                           });
                     },                  
                 });
             } else {
                 alert('danger');
             }

         });
     });

  </script>

@endsection