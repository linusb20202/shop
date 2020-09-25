@extends('layouts.dashboard')
@section('content')
<div class="main_dashboard">
    @include('elements.topcategories')
    <div class="st_pages">
        <div class="st_pages_title">{!! $pageInfo->title !!}</div>
        <div class="st_pages_cnt">{!! $pageInfo->description !!}</div>
    </div>
</div>
@endsection