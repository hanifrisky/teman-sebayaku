@extends('layouts.konselor')

@section('page-title', 'Buat Lesson Baru')

@section('content')
<x-lesson-builder 
    :action="route('konselor.lessons.store')" 
    method="POST" 
    :is-edit="false" 
/>
@endsection
