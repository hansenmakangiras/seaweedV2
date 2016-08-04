/**
 * Created by hanse on 6/16/2016.
 */
(function () {
    // Code used to add Todo Tasks
    jQuery(document).ready(function ($) {
        $(".pie-large").sparkline([3,2,5], {
            type: 'pie',
            width: '150px ',
            height: '150px',
            sliceColors: ['#ee4749', '#c13638','#fe9193']

        });

        $(".bar-large").sparkline([5,6,7,2,1,0,4,3,5,7,2,4], {
            type: 'bar',
            barColor: '#ff6264',
            height: '150px',
            barWidth: 10,
            barSpacing: 2
        });
        // Sparkline Charts
        $('.inlinebar').sparkline('html', {type: 'bar', barColor: '#ff6264'});
        $('.inlinebar-2').sparkline('html', {type: 'bar', barColor: '#445982'});
        $('.inlinebar-3').sparkline('html', {type: 'bar', barColor: '#00b19d'});
        $('.bar').sparkline([[1, 4], [2, 3], [3, 2], [4, 1]], {type: 'bar'});
        $('.pie').sparkline('html', {
            type: 'pie',
            borderWidth: 0,
            sliceColors: ['#3d4554', '#ee4749', '#00b19d']
        });
        $('.linechart').sparkline();
        $('.pageviews').sparkline('html', {type: 'bar', height: '30px', barColor: '#ff6264'});
        $('.uniquevisitors').sparkline('html', {type: 'bar', height: '30px', barColor: '#00b19d'});
                
        // Bind click to OK button within popup
        var confirmDelete = '#confirm-delete';
        $(confirmDelete).on('click', '.btn-ok', function (e) {

            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
            var url = $(this).data('url');

            $modalDiv.addClass('loading');
            var post = $.post(url, {'id': id});
            post.success(function (response) {
                var resp = JSON.parse(response);
                //console.log(resp.message);
                if (resp.message === 'success') {
                    window.location = resp.redirect_url;
                } else {
                    setTimeout(function () {
                        // var opts = {
                        //     "closeButton": true,
                        //     "debug": false,
                        //     "positionClass": rtl() || public_vars.$pageContainer.hasClass('right-sidebar') ? "toast-top-left" : "toast-top-right",
                        //     "toastClass": "black",
                        //     "onclick": null,
                        //     "showDuration": "300",
                        //     "hideDuration": "1000",
                        //     "timeOut": "5000",
                        //     "extendedTimeOut": "1000",
                        //     "showEasing": "swing",
                        //     "hideEasing": "linear",
                        //     "showMethod": "fadeIn",
                        //     "hideMethod": "fadeOut"
                        // };
                        var opts = {
                            "closeButton": false,
                            "debug": false,
                            "positionClass": "toast-top-right",
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };

                        toastr.error(resp.alert, resp.status, opts);
                    }, 3000);
                }

                $modalDiv.modal('hide').removeClass('loading');
            });
        });

        $(confirmDelete).on('click', '.btn-cancel', function (e) {
            var $modalDiv = $(e.delegateTarget);
            $modalDiv.modal('hide').removeClass('loading');
        });

        // Bind to modal opening to set necessary data properties to be used to make request
        $(confirmDelete).on('show.bs.modal', function (e) {
            var data = $(e.relatedTarget).data();
            //console.log(data);
            $('.title', this).text(data.recordTitle);
            $('.body', this).text(data.recordBody);
            $('.btn-ok', this).data('recordId', data.recordId);
            $('.btn-ok', this).data('url', data.href);
        });
        //
        //     $(".monthly-sales").sparkline([1, 2, 3, 5, 6, 7, 2, 3, 3, 4, 3, 5, 7, 2, 4, 3, 5, 4, 5, 6, 3, 2], {
        //         type: 'bar',
        //         barColor: '#485671',
        //         height: '80px',
        //         barWidth: 10,
        //         barSpacing: 2
        //     });
        $(".top-apps").sparkline('html', {
            type: 'line',
            width: '50px',
            height: '15px',
            lineColor: '#ff4e50',
            fillColor: '',
            lineWidth: 2,
            spotColor: '#a9282a',
            minSpotColor: '#a9282a',
            maxSpotColor: '#a9282a',
            highlightSpotColor: '#a9282a',
            highlightLineColor: '#f4c3c4',
            spotRadius: 2,
            drawNormalOnTop: true
        });

        $(".monthly-sales").sparkline([5, 10, 15, 20, 25], {
            type: 'bar',
            barColor: '#ff4e50',
            height: '55px',
            width: '100%',
            barWidth: 8,
            barSpacing: 1
        });

        $(".pie-chart").sparkline([2.5, 3, 2], {
            type: 'pie',
            width: '95',
            height: '95',
            sliceColors: ['#ff4e50', '#db3739', '#a9282a']
        });


        $(".daily-visitors").sparkline([1, 5, 5.5, 5.4, 5.8, 6, 8, 9, 13, 12, 10, 11.5, 9, 8, 5, 8, 9], {
            type: 'line',
            width: '100%',
            height: '55',
            lineColor: '#ff4e50',
            fillColor: '#ffd2d3',
            lineWidth: 2,
            spotColor: '#a9282a',
            minSpotColor: '#a9282a',
            maxSpotColor: '#a9282a',
            highlightSpotColor: '#a9282a',
            highlightLineColor: '#f4c3c4',
            spotRadius: 2,
            drawNormalOnTop: true
        });


        $(".stock-market").sparkline([1, 5, 6, 7, 10, 12, 16, 11, 9, 8.9, 8.7, 7, 8, 7, 6, 5.6, 5, 7, 5], {
            type: 'line',
            width: '100%',
            height: '55',
            lineColor: '#ff4e50',
            fillColor: '',
            lineWidth: 2,
            spotColor: '#a9282a',
            minSpotColor: '#a9282a',
            maxSpotColor: '#a9282a',
            highlightSpotColor: '#a9282a',
            highlightLineColor: '#f4c3c4',
            spotRadius: 2,
            drawNormalOnTop: true
        });
        $(".line-large").sparkline([5,6,7,9,10,5,3,4,5,4,6,7, ], {
            type: 'line',
            width: '320px ',
            height: '150px',
            lineColor: '#ff4e50',
            highlightLineColor: '#ff8889',
            highlightSpotColor: '#b22425',
            minSpotColor: '#ff4e50',
            maxSpotColor: '#ff4e50',
            fillColor: '#f79696',
            lineWidth: 2,
            spotRadius: 4.5,
            normalRangeColor: '#ed4949'
        });

        // Donut Chart
        //     var donut_chart_demo = $("#donut-chart-demo");
        //
        //     donut_chart_demo.parent().show();
        //
        //     var donut_chart = Morris.Donut({
        //         element: 'donut-chart-demo',
        //         data: [
        //             {label: "Download Sales", value: getRandomInt(10, 50)},
        //             {label: "In-Store Sales", value: getRandomInt(10, 50)},
        //             {label: "Mail-Order Sales", value: getRandomInt(10, 50)}
        //         ],
        //         colors: ['#707f9b', '#455064', '#242d3c']
        //     });
        //
        //     donut_chart_demo.parent().attr('style', '');


            // Area Chart
            // var area_chart_demo = $("#area-chart-demo");
            //
            // area_chart_demo.parent().show();
            //
            // var area_chart = Morris.Area({
            //     element: 'area-chart-demo',
            //     data: [
            //         {y: '2006', a: 100, b: 90},
            //         {y: '2007', a: 75, b: 65},
            //         {y: '2008', a: 50, b: 40},
            //         {y: '2009', a: 75, b: 65},
            //         {y: '2010', a: 50, b: 40},
            //         {y: '2011', a: 75, b: 65},
            //         {y: '2012', a: 100, b: 90}
            //     ],
            //     xkey: 'y',
            //     ykeys: ['a', 'b'],
            //     labels: ['Series A', 'Series B'],
            //     lineColors: ['#303641', '#576277']
            // });
            //
            // area_chart_demo.parent().attr('style', '');


            // Rickshaw
            // var seriesData = [[], []];
            //
            // var random = new Rickshaw.Fixtures.RandomData(50);
            //
            // for (var i = 0; i < 50; i++) {
            //     random.addData(seriesData);
            // }
            //
            // var graph = new Rickshaw.Graph({
            //     element: document.getElementById("rickshaw-chart-demo"),
            //     height: 193,
            //     renderer: 'area',
            //     stroke: false,
            //     preserve: true,
            //     series: [{
            //         color: '#73c8ff',
            //         data: seriesData[0],
            //         name: 'Upload'
            //     }, {
            //         color: '#e0f2ff',
            //         data: seriesData[1],
            //         name: 'Download'
            //     }
            //     ]
            // });
            //
            // graph.render();
            //
            // var hoverDetail = new Rickshaw.Graph.HoverDetail({
            //     graph: graph,
            //     xFormatter: function (x) {
            //         return new Date(x * 1000).toString();
            //     }
            // });
            //
            // var legend = new Rickshaw.Graph.Legend({
            //     graph: graph,
            //     element: document.getElementById('rickshaw-legend')
            // });
            //
            // var highlighter = new Rickshaw.Graph.Behavior.Series.Highlight({
            //     graph: graph,
            //     legend: legend
            // });
            //
            // setInterval(function () {
            //     random.removeData(seriesData);
            //     random.addData(seriesData);
            //     graph.update();
            //
            // }, 500);
    });
    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

})();