@extends('layouts.app')
@section('title')Show @endsection
@section('content')
<div class="card">
    <div class="card-header">
        Post info
    </div>
    <div class="card-body">
        <h5 class="card-title">Title: {{$posts->title}}</h5>
        <p class="card-text">Description: {{$posts->description}}</p>
    </div>
</div>
<div class="mt-4">
    <div class="card">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body">
            <h5 class="card-title">Name: {{$posts->user ? $posts->user->name : 'not found'}}</h5>
            <p class="card-text">Email: {{$posts->user ? $posts->user->email : 'not found'}}</p>
            <p class="card-text">Create At: {{$posts->user ? $posts->user->created_at : 'not found'}}</p>
        </div>
    </div>
</div>
@endsection
