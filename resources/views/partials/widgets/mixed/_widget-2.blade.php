@php
$chartColor = $chartColor ?? 'primary';
$chartHeight = $chartHeight ?? '175px';
@endphp

<script>
    // Mixed widgets
    var initMixedWidget2 = function() {
        let data = {!! json_encode($applicationsPerMonth) ?? [] !!}
        let categories = {!! json_encode($applicationCategories) ?? [] !!}

        var charts = document.querySelectorAll(".mixed-widget-2-chart");

        var color;
        var strokeColor;
        var height;
        var labelColor = KTUtil.getCssVariableValue("--kt-gray-500");
        var borderColor = KTUtil.getCssVariableValue("--kt-gray-200");
        var options;
        var chart;

        [].slice.call(charts).map(function(element) {
            height = parseInt(KTUtil.css(element, "height"));
            color = KTUtil.getCssVariableValue(
                "--kt-" + element.getAttribute("data-kt-color")
            );
            strokeColor = KTUtil.colorDarken(color, 15);

            options = {
                series: [{
                    name: "Total Applications",
                    data: data,
                }, ],
                chart: {
                    fontFamily: "inherit",
                    type: "area",
                    height: height,
                    toolbar: {
                        show: false,
                    },
                    zoom: {
                        enabled: false,
                    },
                    sparkline: {
                        enabled: true,
                    },
                    dropShadow: {
                        enabled: true,
                        enabledOnSeries: undefined,
                        top: 5,
                        left: 0,
                        blur: 3,
                        color: strokeColor,
                        opacity: 0.5,
                    },
                },
                plotOptions: {},
                legend: {
                    show: false,
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    type: "solid",
                    opacity: 0,
                },
                stroke: {
                    curve: "smooth",
                    show: true,
                    width: 3,
                    colors: [strokeColor],
                },
                xaxis: {
                    categories: categories,
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: "12px",
                        },
                    },
                    crosshairs: {
                        show: false,
                        position: "front",
                        stroke: {
                            color: borderColor,
                            width: 1,
                            dashArray: 3,
                        },
                    },
                },
                yaxis: {
                    min: 0,
                    max: 80,
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: "12px",
                        },
                    },
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
                            return val;
                        },
                    },
                    marker: {
                        show: false,
                    },
                },
                colors: ["transparent"],
                markers: {
                    colors: [color],
                    strokeColor: [strokeColor],
                    strokeWidth: 3,
                },
            };

            chart = new ApexCharts(element, options);
            chart.render();
        });
    };
</script>
<!--begin::Mixed Widget 2-->
<div class="card {{ $class }}">
    <!--begin::Header-->
    <div class="card-header border-0 bg-{{ $chartColor }} py-5">
        <h3 class="card-title fw-bolder text-white">Academic Statistics</h3>

        
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body p-0">
        <!--begin::Chart-->
        <div class="mixed-widget-2-chart card-rounded-bottom bg-{{ $chartColor }}" data-kt-color="{{ $chartColor }}" data-kt-chart-url="{{ route('profits') }}" style="height: {{ $chartHeight }}"></div>
        <!--end::Chart-->

        <!--begin::Stats-->
        <div class="card-p mt-n20 position-relative">
            <!--begin::Row-->
            <div class="row g-0">
                <!--begin::Col-->
                <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                    {!! theme()->getSvgIcon("icons/duotune/general/gen032.svg", "svg-icon-3x svg-icon-warning d-block my-2") !!}
                    <a href="#" class="text-warning fw-bold fs-6">
                        {{ $academicTallies['applications'] }} Applications
                    </a>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col bg-light-primary px-6 py-8 rounded-2 mb-7">
                    {!! theme()->getSvgIcon("icons/duotune/finance/fin006.svg", "svg-icon-3x svg-icon-primary d-block my-2") !!}
                    <a href="#" class="text-primary fw-bold fs-6">
                        {{ $academicTallies['applicants'] }} Applicants
                    </a>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row g-0">
                <!--begin::Col-->
                <div class="col bg-light-danger px-6 py-8 rounded-2 me-7">
                    {!! theme()->getSvgIcon("icons/duotune/abstract/abs027.svg", "svg-icon-3x svg-icon-danger d-block my-2") !!}
                    <a href="#" class="text-danger fw-bold fs-6 mt-2">
                        {{ $academicTallies['enrolments'] }} Enrolments
                    </a>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col bg-light-success px-6 py-8 rounded-2">
                    {!! theme()->getSvgIcon("demo1/media/icons/duotune/communication/com014.svg", "svg-icon-3x svg-icon-success d-block my-2") !!}
                    <a href="#" class="text-success fw-bold fs-6 mt-2">
                        {{ $academicTallies['students'] }} Students
                    </a>

                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Stats-->
    </div>
    <!--end::Body-->
</div>
<!--end::Mixed Widget 2-->