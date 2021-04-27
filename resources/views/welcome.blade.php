@extends('layouts.app')

@section('page-scripts')
    @parent
    <script src="{{ asset('js/pages/welcome.js') }}" defer></script>
@endsection

@section('page-css')
    @parent
@endsection

@section('content')

    <div class="" id="weather" v-cloak>

        <video class="" :src="'/video/' + video" style="z-index: 0" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop"></video>

        <div class="row">
            <div class="col-12">

                <div class="col-md-7 col-sm-12 weather p-5">
                    <div class="row w-75">
                        <div class="col-12">
                            <h1 class="temp ml-4">@{{ temp }}°</h1>
                            <hr class="" />
                        </div>

                        <div class="col-md-3 col-sm-3 text-center">
                            <h1 class="p-auto icon"><i :class="icon"></i></h1>
                        </div>

                        <div class="col-md-9 col-sm-12 text-left ">
                            <h2 class="summary">@{{ location }} <span class="edit" v-on:click="edit()"><i class="fa fa-pen"></i></span></h2>
                            <h5 class="summary">@{{ sky }}</h5>
                        </div>

                        <div class="col-12 mt-5 ml-4" >
                            <p class="m-3">Humidity: @{{ humidity }}%</p>
                            <p class="m-3">Pressure: @{{ pressure }}mb</p>
                            <p class="m-3">Wind: @{{ wind }} MPH</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection


