<html>
<head>
    <link rel="stylesheet" href="http://static.josephthenara.com/jt-assets/css/w3.css">
    <script src="api/gstatic/jquery.min.js"></script>
    <script src="api/gstatic/jquery.csv.min.js"></script>
    <script type="text/javascript" src="api/gstatic/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['gantt']});
        google.charts.setOnLoadCallback(drawChart);

        function daysToMilliseconds(days) {
            return days * 24 * 60 * 60 * 1000;
        }

        function drawChart() {
            $.get("documents/timeline.csv", function (csvString) {
                var arrData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar()});
                var data = new google.visualization.DataTable();

                var x = arrData.length;
                var y = new Date(2015, 0, 1);
                var i = 0;
                while (i < x) {
                    console.log("=================");
                    console.log("Array = " + arrData[i]);
                    console.log("Current i: " + i);
                    console.log("Date val = " + arrData[i][3])

                    y = new Date(arrData[i][3]);
                    arrData[i][3] = y;
                    console.log(arrData[i][3]);
                    y = new Date(arrData[i][4]);
                    arrData[i][4] = y;
                    console.log(arrData[i][4]);

                    if (arrData[i][2] === 'null') {
                        arrData[i][2] = null;
                    }

                    if (arrData[i][5] === 'null') {
                        arrData[i][5] = null;
                    }

                    if (arrData[i][7] === 'null') {
                        arrData[i][7] = null;
                    }

                    arrData[i][6] = parseInt(arrData[i][6], 10);



                    i++;
                }



                console.log(arrData);
                console.log("length: " + arrData.length);
                var lol = arrData[0][3];
                console.log("Data from lol: ");
                console.log(lol);
                console.log(data);

                data.addColumn('string', 'Task ID');
                data.addColumn('string', 'Task Name');
                data.addColumn('string', 'Resource');
                data.addColumn('date', 'Start Date');
                data.addColumn('date', 'End Date');
                data.addColumn('number', 'Duration');
                data.addColumn('number', 'Percent Complete');
                data.addColumn('string', 'Dependencies');

                data.addRows(arrData);


                var options = {
                    height : 1080,
                    gantt : {
                        sortTasks : false
                    }
                };

                var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

                chart.draw(data, options);
            })



        }
    </script>
</head>
<body>
<div id="chart_div" class="w3-padding-large" style="width: 100%;" ></div>
</body>
</html>
