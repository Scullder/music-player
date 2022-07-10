@extends('layouts.app')
@section('title', 'Laravel-MP')

@section('body')
<button type="button" id="home">home</button>
<button type="button" id="playlist">playlist</button>

<div id="page">

</div>

<div id="player-div">
  @include('player', ['songs' => $songs])
</div>

@endsection
