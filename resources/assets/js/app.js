google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawCharts);

function drawCharts() {
    drawChartPerfectYear();
    drawChartPerfectAge();
    drawChartPerfectGender();
    drawChartPerfectState();
    drawChartPerfectCountry();
};

// create trigger to resizeEnd event     
$(window).resize(function() {
    if (this.resizeTO) {
        clearTimeout(this.resizeTO);
    }
    this.resizeTO = setTimeout(function() {
        $(this).trigger('resizeEnd');
    }, 500);
});

// redraw graph when window resize is completed  
$(window).on('resizeEnd', function() {
    //location.reload(); // TODO: trigger a reload only if the window size changes too much, else do a redraw
    //drawCharts();
});
