@extends('errors.layout')

@php
  $error_number = 404;
@endphp

@section('title')
  Page not found.
@endsection

@section('description')
  @php
    // $default_error_message = "Please <a href='javascript:history.back()''>go back</a> or return to <a href='".url('')."'>our homepage</a>.";
    $default_error_message = __('errors/404.default_message', ['href' => route('homepage', app()->getLocale())]);
  @endphp
  {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection