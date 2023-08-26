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
                                <span class="card-label fw-bolder" id="chartNumberUsersFieldTitle">تعداد کاربران به تفکیک رشته</span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="chartContainer" id="chartNumberUsersField"></div>
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
<!--begin:chartNumberUsersField-->
<script>
   am5.ready(function() {

    var root = am5.Root.new("chartNumberUsersField");

    root._logo.dispose();

    root.setThemes([
        am5themes_Animated.new(root)
    ]);


    var chart = root.container.children.push(am5xy.XYChart.new(root, {
        panX: false,
        panY: false,
        wheelX: "panX",
        wheelY: "zoomX",
        layout: root.verticalLayout
    }));

    chart.seriesContainer.draggable = false;
    chart.seriesContainer.resizable = false;

    var legend = chart.children.push(am5.Legend.new(root, {
        centerX: am5.p50,
        x: am5.p50,
        layout: root.horizontalLayout,
        marginTop:8
    }));


    legend.labels.template.setAll({
        fontSize: 12,
        fontWeight: "400",
        fontFamily:"iranyekan",
        direction:"rtl",
    });

    legend.markers.template.setAll({
        width: 12,
        height: 12,
        marginRight: 8,
        marginLeft: 8
    });

    legend.valueLabels.template.set("forceHidden", true);

    var data = [];

    const datachartNumberUsersChallange = {!! json_encode($chartNumberUsersChallange) !!};

    for(let i = 0; i < datachartNumberUsersChallange.length; i++)
    {
        let newObj = {};

        newObj['field'] = datachartNumberUsersChallange[i]["field"];

        const participants = datachartNumberUsersChallange[i]["participants"];
        for (let [key, value] of Object.entries(participants)) {
            newObj[key] = value;
        }

        const examiners = datachartNumberUsersChallange[i]["examiners"];
        for (let [key, value] of Object.entries(examiners)) {
            newObj[key] = value;
        }

        data.push(newObj);
    }

    var xRenderer = am5xy.AxisRendererX.new(root, {
        cellStartLocation: 0.1,
        cellEndLocation: 0.9
    });

    xRenderer.labels.template.setAll({
        fontFamily: "iranyekan",
        direction: "rtl",
    });

    var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
        categoryField: "field",
        renderer: xRenderer,
        tooltip: am5.Tooltip.new(root, {})
    }));

    xRenderer.grid.template.setAll({
        location: 1
    })

    xAxis.data.setAll(data);

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
        min: 0,
        renderer: yRenderer,
    }));

    var tooltip_series = am5.Tooltip.new(root, {
        autoTextColor: false,
    });

    tooltip_series.label.setAll({
        fontFamily:"iranyekan",
        direction:"rtl",
        fill: am5.color(0xffffff)
    });

    function makeSeries(name, fieldName, stacked) {
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
            stacked: stacked,
            name: name,
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: fieldName,
            categoryXField: "field",
            tooltip: tooltip_series
        }));

        series.columns.template.setAll({
            tooltipText: "تعداد {valueY}",
            tooltipY: am5.percent(10),
            width: am5.percent(90),
        });

        series.data.setAll(data);

        series.appear();

        series.bullets.push(function() {
            return am5.Bullet.new(root, {
                locationY: 0.5,
                sprite: am5.Label.new(root, {
                    text: "{valueY}",
                    fontFamily: "iranyekan",
                    direction: "rtl",
                    fill: root.interfaceColors.get("alternativeText"),
                    centerY: am5.percent(50),
                    centerX: am5.percent(50),
                    populateText: true
                })
            });
        });

        legend.data.push(series);

        legend.itemContainers.template.setAll({
            reverseChildren: true,
        });
    }


    //make series
    for(let i = 0; i < datachartNumberUsersChallange.length; i++)
    {
        const participants = datachartNumberUsersChallange[i]["participants"];
        let j = 0;
        for (let [key, value] of Object.entries(examiners)) {
            if (j === 0) {
                makeSeries(key, key, false);
            } else {
                makeSeries(key, key, true);
            }
            j++;
        }

        const examiners = datachartNumberUsersChallange[i]["examiners"];
        let k = 0;

        for (let [key, value] of Object.entries(examiners)) {
            if (k === 0) {
                makeSeries(key, key, false);
            } else {
                makeSeries(key, key, true);
            }
            k++;
        }
    }

    chart.appear(1000, 100);

    });
</script>
<!--end:chartNumberUsersField-->
@endsection

