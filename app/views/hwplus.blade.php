@extends('layout.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12"><h1>Hitwicket+ Script <small>v1.3</small></h1><hr></div>
        <div class="col-md-9">
            <div class="well">
                Additional functionality to your Hitwicket page which are not even available to musketeers.
                <hr>
                <h3>Features:</h3>
                * Player's Last Transfer Skills<br>
                * Player's Age display in "Moments of Glory" and "Training" tab<br>
            </div>
            <hr>
            <div class="row">
            <div class="col-md-4">
            <a href="{{ URL::to('img/preview1.jpg')}}" class="thumbnail">
                <img src="{{ URL::to('img/preview1.jpg')}}" data-src="holder.js/100x170" class="img-rounded" alt="Preview">
            </a>
            </div>
            <div class="col-md-4">
            <a href="{{ URL::to('img/preview2.jpg')}}" class="thumbnail">
                <img src="{{ URL::to('img/preview2.jpg')}}" data-src="holder.js/100x170" class="img-rounded" alt="Preview">
             </a>
            </div>
            </div>
            <hr>
            <h2>Install Instructions</h2>
            <div class="well">
                <img src="{{ URL::to('img/chrome.png')}}" width="110px" height="35px" data-src="holder.js/100x170" class="img-rounded" alt="Chrome"><br>
                Chrome Users<br>
                Follow the steps below<br>
                1) Install the following extension<br>
                <a href="http://goo.gl/ZmeOmv">TamperMonkey for Chrome</a><br>
                2) Go the following link and click on OK to continue<br>
                <a href="{{URL::to('scripts/script')}}?name=hwplus">Hitwicket+ Script</a><br>
                3) You have successfully installed the script, enjoy!<br>
                <hr>
                <img src="{{ URL::to('img/firefox.png')}}" width="100px" height="40px" data-src="holder.js/100x170" class="img-rounded" alt="Firefox"><br>
                Firefox Users<br>
                Follow the steps below<br>
                1) Install the following extension<br>
                <a href="http://goo.gl/Xn8WHv">GreaseMonkey for Firefox</a><br>
                2) Go the following link and click on OK to continue<br>
                <a href="{{URL::to('scripts/script')}}?name=hwplus">Hitwicket+ Script</a><br>
                3) You have successfully installed the script, enjoy!<br>
            </div>
            <h2>Changelog</h2>
            <div class="well">
                <b>v1.3</b> Feature: Market Research Shortcut in Auction and Scout Page.<br>
                <b>v1.2</b> Feature: Player Age in "Moments of Glory" and Training Tab<br>
                <b>v1.1</b> Minor Bug Fixes<br>
                <b>v1.0</b> Initial Release<br>
            </div>
        </div>
        <?php
        $dws = Cache::get('script_hwplus_v1_1') + 600;
        $rounder = 0 ;
        if($dws > 10){
            $rounder = -1;
        }elseif($dws > 100){
            $rounder = -2;
        }elseif($dws > 1000){
            $rounder = -3;
        }
        ?>
        <div class="col-md-3">
            <div class="well well-lg">
                <a href="{{URL::to('scripts/script')}}?name=hwplus">
                    <img src="{{ URL::to('img/download.png')}}" width="220px" height="75px" style="align-text:center" data-src="holder.js/100x170" class="img-rounded" alt="Download now">
                </a>
                <hr>
                <dl>
                    <dt>Version:</dt>
                    <dd>v1.3</dd>
                </dl>
                <dl>
                    <dt>Downloads:</dt>
                    <dd>{{ round($dws, $rounder) }}+</dd>
                </dl>
                <dl>
                    <dt>Size:</dt>
                    <dd>5.33 kb</dd>
                </dl>
                <dl>
                    <dt>Type:</dt>
                    <dd>Greasemonkey/Javascript</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@stop