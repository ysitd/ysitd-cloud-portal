@extends('layouts/default/template')

@section('content')
<div class="row">
    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
        <section class="content-inner margin-top-no">
            <form action="/user/create" method="post">
                <div class="card">
                    <div class="card-main">
                        <div class="card-inner">
                            <div data-form-element data-form="user.create"></div>
                        </div>
                        <div class="card-action">
                            <div class="card-action-btn pull-left">
                                <button class="btn btn-brand waves-attach waves-effect" type="submit">
                                    Submit
                                </button>
                                <button class="btn btn-brand-accent waves-attach waves-effect" type="reset">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection