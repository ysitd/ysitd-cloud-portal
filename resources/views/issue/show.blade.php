@extends('layouts/default/template')

@section('content')
    <div class="row">
        <div class="col s24 m12">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">
                        {{ $issue->title }}
                        <small class="text-gray">
                            {{ $issue->user->display_name }}
                        </small>
                    </div>
                    <div>
                        {{ $issue->detail }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection