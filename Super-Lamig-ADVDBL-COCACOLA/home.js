// ---------- CHARTS ----------

// BAR CHART
const barChartOptions = {
    series: [
    {
        data: [10, 8, 6, 4, 2],
    },
    ],
    chart: {
    type: 'bar',
    height: 350,
    toolbar: {
        show: false,
    },
    },
    colors: ['#fe001a', '#008B47', '#f99245', '#4169e1', '#4f2400'],
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
    categories: ['Coke', 'Sprite', 'Royal', 'Minute Maid', 'A&W Root Beer'],
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
        name: 'Purchase Orders',
        data: [31, 40, 28, 51, 42, 109, 100],
    },
    {
        name: 'Sales Orders',
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
    colors: ['#3C91E6', '#6F1712'],
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
        text: 'Purchase Orders',
        },
    },
    {
        opposite: true,
        title: {
        text: 'Sales Orders',
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


// -------- FOR SIDEBAR -------- 
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





if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})