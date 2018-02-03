@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(isset($userToken))
                        <div>
                            Ваш токен доступа к API:
                            <div style="overflow-wrap: break-word; word-wrap: break-word; background: gainsboro; font-size: 0.9em; padding: 15px 5px;">
                                {{ $userToken  }}
                            </div>
                            <div><a href="{{route('createToken')}}">СОЗДАТЬ</a> новый.</div>
                        </div>
                    @else
                        Вы не создавали токен доступа к API. <a href="{{route('createToken')}}">СОЗДАТЬ</a>.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
