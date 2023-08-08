@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Категории</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v2</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-12 mb-3"><a href="{{ route('admin.category.create') }}" type="button"
                                                class="btn btn-block btn-primary btn-lg">Создать категорию</a></div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Название</td>
                                        <td colspan="3">Действия</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <th>{{$category->id}}</th>
                                            <th>{{$category->title}}</th>
                                            <th><a href="{{ route('admin.category.show', $category->id) }}">Открыть</a>
                                            </th>
                                            <th><a href="{{ route('admin.category.edit', $category->id) }}">Редактировать</a>
                                            </th>
                                            <th>
                                                <form action="{{ route('admin.category.delete', $category->id) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="border-0">
                                                        <a role="button">Удалить</a>
                                                    </button>
                                                </form>
                                            </th>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
