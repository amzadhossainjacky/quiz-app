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
              <h2> View All Quizzes</h2>
          </div>
          <div class="col-md-10">
            <div class="card mt-4">
                <div class="card-header">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Quiz Name</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->q_name}}</td>
                                    <td>
                                        <a href="{{route('edit.quiz', $row->id)}}" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="{{route('delete.quiz', $row->id)}}" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
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

  <style>
      .w-5{display: none}
    </style>
  
@endsection

