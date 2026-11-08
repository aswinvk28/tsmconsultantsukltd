var data = LoadChartData();

function drawVisualization() {
    
    new google.visualization.PieChart(document.getElementById('visualization')).draw(data[0], {
        backgroundColor : {
            fill : "transparent"
        },
        chartArea : {
            width : 200,
            height : 200,
            left : 0,
            top : 0
        },
        legend : {
            position : 'none'
        }
    });
    new google.visualization.PieChart(document.getElementById('visualization2')).draw(data[1], {
        backgroundColor : {
            fill : "transparent"
        },
        chartArea : {
            width : 100,
            height : 100,
            left : 0,
            top : 0
        },
        legend : {
            position : 'none'
        }
    });
}

google.setOnLoadCallback(drawVisualization);