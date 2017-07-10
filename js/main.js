$(document).ready(function() {
    $('.nav-pills a').click(function(e) {
        e.preventDefault()
        $(this).tab('show')
    })
    $('[data-toggle="tooltip"]').tooltip();

    $('#myModal').modal('show');
    $('.btn-perfil').click(function() {
        $('.perfil').show();
        $('.home').hide();
        $('.inventario').hide();
        $('.loja').hide();
    });
    $('.btn-inventario').click(function() {
        $('.inventario').show();
        $('.home').hide();
        $('.perfil').hide();
        $('.loja').hide();
    });
    $('.btn-loja').click(function() {
        $('.loja').show();
        $('.home').hide();
        $('.perfil').hide();
        $('.inventario').hide();
    });
    $('.btn-home').click(function() {
        $('.home').show();
        $('.loja').hide();
        $('.perfil').hide();
        $('.inventario').hide();
    });
    //Gráfico 3d
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Eagle', 11],
            ['Viking', 2],
            ['Demon', 2],
            ['Angel', 2],
            ['Sword', 7]
        ]);

        var options = {
            backgroundColor: "transparent",
            title: 'Melhores Decks',
            titleTextStyle: {
                color: 'white', // any HTML string color ('red', '#cc00cc')
                fontName: 'Times New Roman', // i.e. 'Times New Roman'
                fontSize: 14, // 12, 18 whatever you want (don't specify px)
                bold: true, // true or false
                italic: false // true of false
            },
            legend: {
                textStyle: {
                    color: 'white'
                }
            },
            is3D: true,
            width: 600,
            height: 500,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }

    function resizeChart() {
        chart.draw(data, options);
    }
    if (document.addEventListener) {
        window.addEventListener('resize', resizeChart);
    } else if (document.attachEvent) {
        window.attachEvent('onresize', resizeChart);
    } else {
        window.resize = resizeChart;
    }

    $('.btn-mostrar').click(function() {
        $('.carousel').carousel('pause');
    });
});
