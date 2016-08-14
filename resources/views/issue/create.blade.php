@extends('layouts/default/template')

@section('content')
    <div class="row">
        <form action="{{ route('issue.store') }}" method="post" class="col s12">
            <div class="row">
                <div data-form-element data-form="issue.create"></div>
            </div>
            <div class="row">
                <button class="btn btn-brand waves-attach waves-effect" type="submit">
                    Submit
                </button>
                <button class="btn btn-brand-accent waves-attach waves-effect" type="reset">
                    Reset
                </button>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
@endsection