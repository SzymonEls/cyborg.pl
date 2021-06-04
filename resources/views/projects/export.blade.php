@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Strona startowa') }}</div>

                <div class="card-body">
                    To jest export projektu {{ $project->name }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
