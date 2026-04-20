@extends('layouts.app')

@section('title', 'Block-suspened-usermsg-Page')

@section('content')


<div class="containter text-center mt-5">
<h1 style="color: red;">YOU WERE BLOCKED OR SUSPENDED</h1>
<h5>It seems like you have done susposus activity. please contact the admin</h5>

<a href="{{route('showLoginForm')}}" style="color: black;" >Click here</a>

</div>
@endsection