<?php
/**
 * Created By: jithinvijayan
 * Date: 12/02/20
 */

use mikehaertl\wkhtmlto\Pdf;

require_once '../vendor/autoload.php';
try {
    $html = '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/7.0.0/polyfill.min.js"></script>
<style>
    .reportGraph {width:900px;height: 900px;}
</style>
</head>
<body>

<div class="reportGraph">
    <canvas id="canvas"></canvas>
</div>

<script type="text/javascript">
\'use strict\';
(function(setLineDash) {
    CanvasRenderingContext2D.prototype.setLineDash = function() {
        if(!arguments[0].length){
            arguments[0] = [0,0];
        }
        return setLineDash.apply(this, arguments);
    };
})(CanvasRenderingContext2D.prototype.setLineDash);
function drawGraphs() {
    new Chart(
        document.getElementById("canvas"), {
            "responsive": false,
            "type":"pie",
            "data":{
                "labels":["January","February","March","April","May","June","July"],
                "datasets":[
                    {
                        "label":"My First Dataset",
                        "data":[65,59,80,81,56,55,40],
                        backgroundColor: [
                            window.chartColors.red,
                            window.chartColors.orange,
                            window.chartColors.yellow,
                            window.chartColors.green,
                            window.chartColors.blue,
                            window.chartColors.grey,
                            window.chartColors.purple,
					    ],
                        "borderColor":"rgb(75, 192, 192)"
                    }
                ]
            },
            options: {
                animation: {
                    duration: 0, // general animation time
                },
                hover: {
                    animationDuration: 0, // duration of animations when hovering an item
                },
                responsiveAnimationDuration: 0, // animation duration after a resize
            }
        }
    );
}
window.chartColors = {
	red: \'rgb(255, 99, 132)\',
	orange: \'rgb(255, 159, 64)\',
	yellow: \'rgb(255, 205, 86)\',
	green: \'rgb(75, 192, 192)\',
	blue: \'rgb(54, 162, 235)\',
	purple: \'rgb(153, 102, 255)\',
	grey: \'rgb(201, 203, 207)\'
};
window.onload = function() {
    drawGraphs();
};
</script>
</body>
</html>';

    $options = array(
        'page-width' => '210mm',
        'page-height' => '297mm',
        'binary' => "/usr/local/bin/wkhtmltopdf", // For Mac
        

    );


    $pdf = new Pdf($options);
    $pdf->ignoreWarnings = true;
    $pdf->addPage($html);
    $pdf->send('test-chart' . date('d_m_Y') . '.pdf', true);
} catch (\Exception $e) {
    throw $e;
}
