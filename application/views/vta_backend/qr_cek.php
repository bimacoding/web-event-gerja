<style type="text/css">
        .thumbnail {
            border: 0;
        }

        #webcodecam-canvas, #scanned-img {
            background-color: #2d2d2d;
        }

        #camera-select {
            display: inline-block;
            width: auto;
        }

        .btn {
            margin-bottom: 2px;
        }

        .form-control {
            height: 32px;
        }

        .h4, h4 {
            width: auto;
            float: left;
            font-size: 20px;
            line-height: 1.1;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .controls {
            float: right;
            display: inline-block;
        }

        .well {
            position: relative;
            display: inline-block;
        }

        .panel-heading {
            display: inline-block;
            width: 100%;
        }

        .container {
            width: 100%
        }

        pre {
            border: 0;
            border-radius: 0;
            background-color: #333;
            margin: 0;
            line-height: 125%;
            color: whitesmoke;
        }

        button {
            outline: none !important;
        }

        .table-bordered {
            color: #777;
            cursor: default;
        }

        .table-bordered a:hover {
            text-decoration: none;
        }

        .table-bordered th a {
            float: right;
            line-height: 3.49;
        }

        .table-bordered td a {
            float: left;
        }

        .table-bordered th img {
            float: left;
        }

        .table-bordered th, .table-bordered td {
            vertical-align: middle !important;
        }

        .scanner-laser {
            position: absolute;
            margin: 40px;
            height: 30px;
            width: 30px;
            opacity: 0.5;
        }

        .laser-leftTop {
            top: 0;
            left: 0;
            border-top: solid red 5px;
            border-left: solid red 5px;
        }

        .laser-leftBottom {
            bottom: 0;
            left: 0;
            border-bottom: solid red 5px;
            border-left: solid red 5px;
        }

        .laser-rightTop {
            top: 0;
            right: 0;
            border-top: solid red 5px;
            border-right: solid red 5px;
        }

        .laser-rightBottom {
            bottom: 0;
            right: 0;
            border-bottom: solid red 5px;
            border-right: solid red 5px;
        }

        #webcodecam-canvas {
            background-color: #272822;
        }
        #scanned-QR{
            word-break: break-word;
        }
    </style>
<div class="col-sm-12">
    <div class="white-box">
        <h3 class="box-title m-b-0"><?=$title?>
        </h3>
        <div class="" id="QR-Code">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="navbar-form navbar-right">
                        <select class="form-control" id="camera-select"></select>
                        <div class="form-group" >
                            <input id="image-url" type="text" class="form-control" placeholder="Image url" style="display: none;">
                            <button title="Decode Image" class="btn btn-default btn-sm" id="decode-img" type="button" data-toggle="tooltip" style="display: none;"><span class="glyphicon glyphicon-upload"></span></button>
                            <button title="Image shoot" class="btn btn-info btn-sm disabled" id="grab-img" type="button" data-toggle="tooltip" style="display: none;"><span class="glyphicon glyphicon-picture"></span></button>
                            <button title="Play" class="btn btn-success btn-sm" id="play" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-play"></span></button>
                            <button title="Pause" class="btn btn-warning btn-sm" id="pause" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-pause"></span></button>
                            <button title="Stop streams" class="btn btn-danger btn-sm" id="stop" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-stop"></span></button>
                         </div>
                    </div>
                </div>
                <div class="panel-body text-center">
                    <div class=""  style="display: none;">
                        <div class="well" style="width: 100%;">
                            <label id="zoom-value" width="100">Zoom: 2</label>
                            <input id="zoom" onchange="Page.changeZoom();" type="range" min="10" max="30" value="20">
                            <label id="brightness-value" width="100">Brightness: 0</label>
                            <input id="brightness" onchange="Page.changeBrightness();" type="range" min="0" max="128" value="0">
                            <label id="contrast-value" width="100">Contrast: 0</label>
                            <input id="contrast" onchange="Page.changeContrast();" type="range" min="0" max="64" value="0">
                            <label id="threshold-value" width="100">Threshold: 0</label>
                            <input id="threshold" onchange="Page.changeThreshold();" type="range" min="0" max="512" value="0">
                            <label id="sharpness-value" width="100">Sharpness: off</label>
                            <input id="sharpness" onchange="Page.changeSharpness();" type="checkbox">
                            <label id="grayscale-value" width="100">grayscale: off</label>
                            <input id="grayscale" onchange="Page.changeGrayscale();" type="checkbox">
                            <br>
                            <label id="flipVertical-value" width="100">Flip Vertical: off</label>
                            <input id="flipVertical" onchange="Page.changeVertical();" type="checkbox">
                            <label id="flipHorizontal-value" width="100">Flip Horizontal: off</label>
                            <input id="flipHorizontal" onchange="Page.changeHorizontal();" type="checkbox">
                        </div>
                        
                    </div>
                    <div class="" style="display: none;">
                        <div class="thumbnail" id="result">
                            <div class="well" style="overflow: hidden;">
                                <img width="320" height="240" id="scanned-img" src="">
                            </div>
                            <div class="caption">
                                <h3>Scanned result</h3>
                                <p id="scanned-QR"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="well" style="position: relative;display: inline-block;">
                <canvas id="webcodecam-canvas" style="min-width: 230px;width: 100%;min-height: 230px;height: 100%"></canvas>
                <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
            </div>
        </div>
    </div>
</div>