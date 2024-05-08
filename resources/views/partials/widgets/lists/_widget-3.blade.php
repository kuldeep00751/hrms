<script>
    var pieChart = function() {
        var labels = {!! json_encode($registrationsByQualification['categories']) !!}
        var values = {!! json_encode($registrationsByQualification['values']) !!}
        
        var options = {
            series: values,
            chart: {
                width: '100%',
                type: 'pie',
            },
            labels: labels,
           
            plotOptions: {
                pie: {
                    dataLabels: {
                        offset: -5
                    }
                }
            },
            title: {
                text: ""
            },
            dataLabels: {
                formatter(val, opts) {
                    const name = opts.w.globals.labels[opts.seriesIndex]
                    return [name, val.toFixed(1) + '%']
                }
            },
            legend: {
                show: false
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    }
</script>


<!--begin::List Widget 3-->
<div class="card {{ $class }}">
    <!--begin::Header-->
    <div class="card-header border-0">
        <h3 class="card-title fw-bolder text-dark">Registration per Qualification</h3>

       
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-2 overflow-auto">
        <div id="chart"></div>
        
    </div>
    <!--end::Body-->
</div>
<!--end:List Widget 3-->