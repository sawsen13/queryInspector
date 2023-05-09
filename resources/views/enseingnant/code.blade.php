@extends('layouts.MenuEnseignant')
@section('content')


<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('View Code') }}</div>

                    <div class="card-body">
                        <textarea readonly>{{ $content }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
