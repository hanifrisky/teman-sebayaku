@extends('layouts.admin')

@section('page-title', 'Edit Lesson')

@section('content')
<x-lesson-builder 
    :action="route('admin.lessons.update', $lesson)" 
    method="PUT" 
    :is-edit="true" 
    :lesson="$lesson" 
/>
@endsection
