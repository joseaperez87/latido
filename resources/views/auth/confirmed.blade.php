@extends('auth.authLayout')
@section('title', $message)
@section('custom_script')
    <script>
        var confirm_message = '{{$message}}';
        var confirm_result = '{{$res}}';
    </script>
@endsection
