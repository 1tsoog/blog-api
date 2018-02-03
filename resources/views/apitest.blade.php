@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">API Test</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                        <a href="{{route('home')}}" class="btn btn-default"><-</a>
                    </div>

                        <form action="{{route('apiTestCreate')}}" method="post" class="form" id="js-test-api-form">
                            <div class="form-group">
                                <label for="token">Token</label>
                                <input type="text" class="form-control" placeholder="Token" id="token" value="{{$apiToken}}" required>
                            </div>


                            <div class="form-group">
                                <label for="categoryTitle">Название категории</label>
                                <input type="text" class="form-control" placeholder="Название категории" value="Категория {{ date('Y-m-d H:i:s')}}" name="categoryTitle" id="categoryTitle" required>
                            </div>

                            <div class="form-group">
                                <label for="categoryDescription">Описание категории</label>
                                <input type="text" class="form-control" placeholder="Описание категории" value="Описание категории" name="categoryDescription" id="categoryDescription" required>
                            </div>

                            <hr class="dl-horizontal">

                            <div class="form-group">
                                <label for="postTitle">Название поста</label>
                                <input type="text" class="form-control" placeholder="Название поста" value="Пост {{ date('Y-m-d H:i:s') }}" name="postTitle" id="postTitle" required>
                            </div>

                            <div class="form-group">
                                <label for="postDescription">Описание поста</label>
                                <input type="text" class="form-control" placeholder="Описание поста" value="Содержимое поста" name="postDescription" id="postDescription" required>
                            </div>

                            <input type="submit" class="btn btn-success" value="СОЗДАТЬ КАТЕГОРИЮ И ПОСТ">


                            <div id="js-api-test-result" style="margin-top: 20px; overflow-wrap: break-word; word-wrap: break-word; background: gainsboro; font-size: 0.9em; padding: 15px 5px;">

                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
