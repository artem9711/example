@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактирование постов</h1>
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
                    <form action="{{ route('admin.post.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="col-12">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" value="{{$post->title}}" class="form-control" name="title" placeholder="Название постов">
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <textarea id="summernote" name="content">{{$post->content}}</textarea>
                            @error('content')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="w-50 ml-3 mb-3">
                            <img src="{{asset('storage/' . $post->preview_image)}}" alt="preview_image" class="w-50">
                        </div>
                        <div class="input-group w-50 mb-3 ml-3">

                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="preview_image">
                                <label class="custom-file-label">Выберите превью</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузить</span>
                            </div>
                        </div>
                        @error('preview_image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="w-50 ml-3 mb-3">
                            <img src="{{asset('storage/' . $post->main_image)}}" alt="main_image" class="w-50">
                        </div>
                        <div class="input-group w-50 mb-3 ml-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="main_image">
                                <label class="custom-file-label">Выберите главное изображение</label>
                            </div>

                            <div class="input-group-append">
                                <span class="input-group-text">Загрузить</span>
                            </div>
                        </div>
                        @error('main_image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group ml-3">
                            <label>Select</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category->id}}"
                                        {{ $category->id == $post->category_id ? 'selected': ''}}
                                        >{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group ml-3">
                            <label>Теги</label>
                            <select class="select2" name="tags_ids[]" multiple="multiple" data-placeholder="Выберите тег" style="width: 100%;">

                                @foreach($tags as $tag)
                                    <option
                                        @foreach($post->tags as $postTag)
                                            {{$tag->id === $postTag->id ? 'selected': ''}}
                                        @endforeach
                                        value="{{$tag->id}}">{{$tag->title}}</option>
                                @endforeach
{{--                                @foreach($tags as $tag)--}}
{{--                                    <option--}}
{{--                                        {{ is_array($post->tags->pluck('id')) && in_array($tag->id, $post->tags->pluck('id')) ? 'selected': ''}}--}}
{{--                                        value="{{$tag->id}}">{{$tag->title}}</option>--}}
{{--                                @endforeach--}}
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit"  class="btn btn-block btn-success btn-lg">Обновить</button>
                        </div>
                    </form>
                </div>
                <!-- /.row -->


            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
