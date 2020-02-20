@extends('layouts.app')

@section('content')
{{ auth()->user() }}
<App :user="{{ auth()->user() }}"></App>
@endsection
