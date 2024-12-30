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
        <h3>Staff Dashboard</h3>
        <div class="features">
            <div class="feature">
                <img class="icon" src="images/lock.png" />
                <a href="{{ route('building-lock.index') }}" class="feature-title">Smart Lock</a>
            </div>
            <div class="feature">
                <img class="icon" src="images/lighting.png" />
                <a href="{{ route('gedungs.index') }}" class="feature-title">Smart Lighting</a>
            </div>
            <div class="feature">
                <img class="icon" src="images/cctv.png" />
                <a href="{{ route('buildings.index') }}" class="feature-title">CCTV</a>
            </div>
            <div class="feature">
                <img class="icon" src="images/air.png" />
                <a href="{{ route('water.index') }}" class="feature-title">Monitoring Air</a>
            </div>
            <div class="feature">
                <img class="icon" src="images/gedung.png" />
                <a href="{{ route('asets.index') }}" class="feature-title">Aset Gedung</a>
            </div>
            <div class="feature">
                <img class="icon" src="images/error.png" />
                <a href="{{ route('staff.error', 'default-building') }}" class="feature-title">Laporan Error</a>
            </div>
        </div>
    </div>
</div>
@endsection