@extends('personal.layouts.main')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Комментарии</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Комментарии</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <form action="{{ route('personal.comment.update', $comment->id) }}" method="POST" class="col-12">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            <div class="form-group">
                                <textarea class="form-control" name="message" cols="30" rows="10">{{$comment->message}}</textarea>
                                @error('message')
                                <div class="text-danger">Это поле не может быть пустым</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-block btn-success btn-lg">Обновить</button>
                        </div>
                    </form>
                </div>


            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
