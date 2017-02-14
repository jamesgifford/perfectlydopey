google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawCharts);

function drawCharts() {
    drawChartPerfectYear();
    drawChartPerfectAge();
    drawChartPerfectGender();
    drawChartPerfectState();
    drawChartPerfectCountry();
};

var currentWindowWidth = currentWindowHeight = 0;

$(document).ready(function() {
    originalWindowWidth = window.innerWidth;
    originalWindowHeight = window.innerHeight;
});

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
    var currentWindowWidth = window.innerWidth;
    var currentWindowHeight = window.innerHeight;
    var widthChange = (Math.abs(originalWindowWidth - currentWindowWidth) / originalWindowWidth) * 100;
    var heightChange = (Math.abs(originalWindowHeight - currentWindowHeight) / originalWindowHeight) * 100;

    if (widthChange > 10 || heightChange > 10) {
        location.reload();
    }
});

//# sourceMappingURL=app.js.map
