@extends('layouts.app')
@section('title', 'Laravel-MP')

@section('body')

<div id="menu">
  <div id="logo">
  </div>

  <div id="menu-elements">
    <button type="button" id="home" class='menu-button'></button><br>
    <button type="button" id="account" class='menu-button'></button><br>
    <button type="button" id="list" class='menu-button'></button><br>
    <button type="button" id="user-playlist" class='menu-button'></button><br>
  </div>
</div>

<div id="page">
</div>

<div id="player-div">
  @include('player')
</div>

@endsection
