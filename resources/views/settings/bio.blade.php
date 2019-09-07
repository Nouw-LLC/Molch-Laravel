@extends('layouts.extensions.settings')

@section('content.extra')
    <bio-form :user="{{ Auth::user() }}"></bio-form>
@endsection
