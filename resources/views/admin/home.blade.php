@extends('layouts.admin.app')

@section('content')
@php
    $albums = \App\Models\Album::all();
@endphp
 <div class="col-12 p-0">    

    <div class="col-12 row p-0">

        <div class="col-12 col-lg-6 p-2">
            <div class="col-12 p-0 main-box" style="background-color: #FFF">
                <div class="col-12 px-0">
                    <div class="col-12 px-3 py-3">
                        Album Images 
                    </div>
                    <div class="col-12 divider" style="min-height: 2px;"></div>
                </div>
                <div class="col-12 p-3">
                    <div id="main-chart">
                        
                    </div> 
                </div>
            </div>
        </div>
    </div>  
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script type="text/javascript"> 



    var chart = new ApexCharts(document.querySelector("#main-chart"), {
        chart: {
            height: 280,
            type: "bar",

        },
        dataLabels: {
            enabled: false
        },
        series: [
            {
            name: "Album Images",
            data: [
              @foreach($albums as $album )
              "{{$album->getMedia()->count()}}",
              @endforeach
            ]
            
            }
        ],
        xaxis: {
            categories: [              
              @foreach($albums as $album )
              "{{$album->name}}",
              @endforeach
            ]

        }
        }).render();

    
    </script> 
    
</div>

@endsection
