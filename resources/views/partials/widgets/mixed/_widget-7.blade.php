@php
$chartColor = $chartColor ?? 'primary';
$chartHeight = $chartHeight ?? '175px';

$campuses = array();
$females = array();
$males = array();

foreach($enrolmentCampusStatistics as $key => $campus){
array_push($campuses, $key);
array_push($females, $enrolmentCampusStatistics[$key]["Female"] ?? 0);
array_push($males, $enrolmentCampusStatistics[$key]["Male"] ?? 0);
}

@endphp
<script>
    var initMixedWidget7 = function() {
        var femaleSeries = {!!json_encode($females) !!}
        var maleSeries = {!!json_encode($males) !!}
        var campusCategories = {!!json_encode($campuses) !!}


        var charts = document.querySelectorAll(".mixed-widget-7-chart");

        [].slice.call(charts).map(function(element) {
            var height = parseInt(KTUtil.css(element, "height"));

            if (!element) {
                return;
            }

            var color = element.getAttribute("data-kt-chart-color");

            var labelColor = KTUtil.getCssVariableValue("--kt-" + "gray-800");
            var strokeColor = KTUtil.getCssVariableValue("--kt-" + "gray-300");
            var baseColor = KTUtil.getCssVariableValue("--kt-" + color);
            var lightColor = KTUtil.getCssVariableValue(
                "--kt-" + color + "-light"
            );
            var secondaryColor = KTUtil.getCssVariableValue("--kt-gray-300");
            var borderColor = KTUtil.getCssVariableValue("--kt-gray-200");

            options = {
                series: [{
                        name: "Female",
                        data: femaleSeries,
                    },
                    {
                        name: "Male",
                        data: maleSeries,
                    },
                ],
                chart: {
                    fontFamily: "inherit",
                    type: "bar",
                    height: height,
                    toolbar: {
                        show: false,
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: ["50%"],
                        borderRadius: 4,
                    },
                },
                legend: {
                    show: false,
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ["transparent"],
                },
                xaxis: {
                    categories: campusCategories,
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: "12px",
                        },
                    },
                },
                yaxis: {
                    y: 0,
                    offsetX: 0,
                    offsetY: 0,
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: "12px",
                        },
                    },
                },
                fill: {
                    type: "solid",
                },
                states: {
                    normal: {
                        filter: {
                            type: "none",
                            value: 0,
                        },
                    },
                    hover: {
                        filter: {
                            type: "none",
                            value: 0,
                        },
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: "none",
                            value: 0,
                        },
                    },
                },
                tooltip: {
                    style: {
                        fontSize: "12px",
                    },
                    y: {
                        formatter: function(val) {
                            return val + " Students";
                        },
                    },
                },
                colors: [baseColor, secondaryColor],
                grid: {
                    padding: {
                        top: 10,
                    },
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true,
                        },
                    },
                },
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        });
    };
</script>
<!--begin::Mixed Widget 7-->
<div class="card {{ $class }}">
    <!--begin::Body-->
    <div class="card-body d-flex flex-column p-0">
        <!--begin::Stats-->
        <div class="flex-grow-1 card-p pb-0">
            <div class="d-flex flex-stack flex-wrap">
                <div class="me-2">
                    <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Registration Per Campus</a>

                    <div class="text-muted fs-7 fw-bold">Grouped By Gender</div>
                </div>

                <div class="fw-bolder fs-3 text-{{ $chartColor }}">
                    {{ $academicTallies['enrolments'] }}
                </div>
            </div>
        </div>
        <!--end::Stats-->

        <!--begin::Chart-->
        <div class="mixed-widget-7-chart card-rounded-bottom" data-kt-chart-color="{{ $chartColor }}" data-kt-chart-url="{{ route('profits') }}" style="height: {{ $chartHeight }}"></div>
        <!--end::Chart-->
    </div>
    <!--end::Body-->
</div>
<!--end::Mixed Widget 7-->