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
              <h2> Create Quiz</h2>
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

                    <form action="{{route('store.quiz')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="quiz_name">Quiz Name</label>
                            <input type="text" class="form-control" id="name" name="name">
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
@endsection