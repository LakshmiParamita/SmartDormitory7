@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
<style>
.features {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 30px;
}

.feature {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    background-color: #fff;
    border-radius: 15px;
    padding: 30px 20px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.feature img {
    max-width: 80px;
    height: 80px;
}

a:link, a:visited {
    text-decoration: none;
    font-family: "Montserrat-SemiBold", Helvetica;
    color: black;
    font-size: 20px;
    margin-top: 15px;
}

a:hover, a:active {
    color: black;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="homescreen">
        <h3>Hai {{ $user->name }}, bagaimana kabarmu hari ini?</h3>
        <div class="features">
            <div class="feature">
                <img class="icon" src="images/lock.png" />
                <a href="{{ route('unlocking_records.index') }}" class="feature-title">Smart Lock</a>
            </div>
            <div class="feature">
                <img class="icon" src="images/error.png" />
                <a href="{{ route('error_reports.show', 'default-building') }}" class="feature-title">Laporkan Error</a>
            </div>
        </div>
    </div>
</div>
@endsection