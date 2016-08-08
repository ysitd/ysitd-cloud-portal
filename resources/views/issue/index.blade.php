@extends('layouts/default/template')

@section('content')
    <div class="col-lg-9 col-md-12">
        <section class="content-inner margin-top-no">
            <div class="card">
                <div class="card-main">
                    <div class="card-header">
                        <div class="card-inner">
                            <h3 class="card-heading">Issue</h3>
                        </div>
                    </div>
                    <div class="card-action">
                        <div class="card-action-btn pull-left">
                            <a class="btn btn-flat btn-brand waves-attach" href="{{ route('issue.create') }}">Report New Issue</a>
                        </div>
                    </div>
                    <div class="tile-wrap">
                        @forelse($issues as $issue)
                            <a class="tile waves-attach waves-effect" href="{{ route('issue.show', ['issue' => $issue->id]) }}">
                                <div class="tile-inner">{{ $issue->title }}</div>
                            </a>
                        @empty
                            <div class="card-inner">
                                No issue is open.
                            </div>
                        @endforelse
                    </div>
                    {!! $issues->render() !!}
                </div>
            </div>
        </section>
    </div>
@endsection