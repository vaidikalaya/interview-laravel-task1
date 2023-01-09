@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            {{$data['VehAvailCore']['@attributes']['Status']}}
        </div>
        <div class="card-body">
            {{$data['VehAvailCore']['Vehicle']['@attributes']['Status']}}
        </div>
    </div>
</div>
@endsection