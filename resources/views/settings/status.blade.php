@extends('layouts.extensions.settings')

@section('content.extra')
    <status-form :user="{{ Auth::user() }}"></status-form>
@endsection
