@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <router-link to="/newuser">NewUser</router-link>
            <router-link to="/factoryusers/{{ Auth::id() }}" >Users</router-link>
            <router-link to="/archives/{{ Auth::id() }}">Archives</router-link>
            <router-link to="/staffdaywork/{{ Auth::id() }}">Staff</router-link>
            <router-view></router-view>

        </div>
    </div>
    
</div>
@endsection
