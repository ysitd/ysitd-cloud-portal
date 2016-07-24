@extends('layouts/default/template')
@section('title', '404 Not Found')
@section('content')
<div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        <section class="content-inner margin-top-no">
            <div class="card">
                <div class="card-main">
                    <div class="card-inner">
                        <p class="text-brand-accent text-strong">
                            You are <strong class="text-upper">korued</strong>!<br>
                            The url or resource you are looking for is not found!<br>
                            Please go back or go to home page to continue.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
