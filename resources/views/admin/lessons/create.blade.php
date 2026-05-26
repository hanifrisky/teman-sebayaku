@extends('layouts.admin')

@section('page-title', 'Buat Lesson Baru')

@section('content')
<x-lesson-builder 
    :action="route('admin.lessons.store')" 
    method="POST" 
    :is-edit="false" 
/>
@endsection
