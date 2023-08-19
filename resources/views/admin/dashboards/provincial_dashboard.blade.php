@extends('layouts.admin.master')

@section('title', 'داشبورد')

@section('custom-style')
<style>
    .chartContainer {
        width: 100%;
        height: 500px;
    }
</style>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row gy-5 g-xl-8">
                <div class="col-xl-12">
                    <div class="card card-xl-stretch">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder" id="chartNumberUsersProvinceTitle">تعداد کاربران سامانه به تفکیک استان</span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="chartContainer" id="chartNumberUsersProvince"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<!--begin:chartNumberUsersProvince-->
<script>
    am5.ready(function() {

        var root = am5.Root.new("chartNumberUsersProvince");

        root._logo.dispose();

        root.setThemes([
            am5themes_Animated.new(root)
        ]);

        var chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: false,
            panY: false,
            wheelX: "panX",
            wheelY: "zoomX",
        }));

        chart.seriesContainer.draggable = false;
        chart.seriesContainer.resizable = false;

        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));

        cursor.lineY.set("visible", false);

        var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });

        xRenderer.labels.template.setAll({
            rotation: -90,
            centerY: am5.p50,
            centerX: am5.p100,
            paddingRight: 15
        });

        xRenderer.grid.template.setAll({
            location: 1
        });

        xRenderer.labels.template.setAll({
            fontFamily: "iranyekan",
            direction: "rtl",
        });

        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
            maxDeviation: 0.3,
            categoryField: "title",
            renderer: xRenderer,
            tooltip: am5.Tooltip.new(root, {})
        }));

        var yRenderer = am5xy.AxisRendererY.new(root, { minGridDistance: 120});

        yRenderer.labels.template.setAll({
            maxWidth: 80,
            oversizedBehavior: "truncate",
            textAlign: "center",
            fontFamily: "iranyekan",
            direction: "rtl",
            fontSize: 11,
            fontWeight: "400",
        });

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            maxDeviation: 0.3,
            renderer: yRenderer,
        }));

        var tooltip_series = am5.Tooltip.new(root, {
            autoTextColor: false,
            pointerOrientation: "horizontal",
            labelText: "{categoryX} : {valueY.formatNumber('#.#')}",
        });

        tooltip_series.label.setAll({
            fontFamily: "iranyekan",
            direction: "rtl",
            fill: am5.color(0xffffff)
        });

        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "count",
            sequencedInterpolation: true,
            categoryXField: "title",
            tooltip: tooltip_series
        }));

        series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });

        series.columns.template.adapters.add("fill", function(fill, target) {
             return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        series.columns.template.adapters.add("stroke", function(stroke, target) {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        var data = [];

        $.ajax({
            type: "POST",
            url: "{{ route('charts.chartNumberUsersProvince') }}",
            data: {  _token: '{{csrf_token()}}' },
            success: function (response)
            {
                console.log(response);
                data = response;
                xAxis.data.setAll(data);
                series.data.setAll(data);
            }
        });

        series.appear(1000);
        chart.appear(1000, 100);
    });
</script>
<!--end:chartNumberUsersProvince-->
@endsection

