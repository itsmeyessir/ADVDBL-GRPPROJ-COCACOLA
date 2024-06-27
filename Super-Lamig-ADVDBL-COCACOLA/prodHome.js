const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});


// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})

const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})

// ---------- CHARTS ----------

// BAR CHART
const barChartOptions = {
    series: [
    {
        data: [2, 5, 1, 0, 3],
    },
    ],
    chart: {
    type: 'bar',
    height: 350,
    toolbar: {
        show: false,
    },
    },
    colors: ['#360103', '#360103', '#360103', '#360103', '#360103'],
    plotOptions: {
    bar: {
        distributed: true,
        borderRadius: 4,
        horizontal: false,
        columnWidth: '40%',
    },
    },
    dataLabels: {
    enabled: false,
    },
    legend: {
    show: false,
    },
    xaxis: {
    categories: ['Coke', 'Royal', 'Sprite', 'Minute Maid', 'A&W Root Beer'],
    },
    yaxis: {
    title: {
        text: 'Count',
    },
    },
};

const barChart = new ApexCharts(
    document.querySelector('#bar-chart'),
    barChartOptions
);
barChart.render();

  // AREA CHART
const areaChartOptions = {
    series: [
    {
        name: 'sample',
        data: [31, 40, 28, 51, 42, 109, 100],
    },
    {
        name: 'sample',
        data: [11, 32, 45, 32, 34, 52, 41],
    },
    ],
    chart: {
    height: 350,
    type: 'area',
    toolbar: {
        show: false,
    },
    },
    colors: ['#fe001a', '#FD7238'],
    dataLabels: {
    enabled: false,
    },
    stroke: {
    curve: 'smooth',
    },
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
    markers: {
    size: 0,
    },
    yaxis: [
    {
        title: {
        text: 'sample',
        },
    },
    {
        opposite: true,
        title: {
        text: 'sample',
        },
    },
    ],
    tooltip: {
    shared: true,
    intersect: false,
    },
};

const areaChart = new ApexCharts(
    document.querySelector('#area-chart'),
    areaChartOptions
);
areaChart.render();
