@extends('layouts.konselor')

@section('page-title', 'Edit Lesson')

@section('content')
<x-lesson-builder 
    :action="route('konselor.lessons.update', $lesson)" 
    method="PUT" 
    :is-edit="true" 
    :lesson="$lesson" 
/>
@endsection
