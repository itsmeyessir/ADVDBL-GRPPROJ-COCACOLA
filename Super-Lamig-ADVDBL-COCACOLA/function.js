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

// -------- FOR CRUD --------
function showAddQualityControlForm() {
    document.getElementById('qualityControlFormModal').style.display = 'block';
    document.getElementById('addQualityControlBtn').style.display = 'inline-block';
    document.getElementById('updateQualityControlBtn').style.display = 'none';
}

function editQualityControl(id, product_id, batch_number, description, inspection_date, test_performed, status, defect_description) {
    document.getElementById('qualityControlId').value = id;
    document.getElementById('product_id').value = product_id;
    document.getElementById('batch_number').value = batch_number;
    document.getElementById('description').value = description;
    document.getElementById('inspection_date').value = inspection_date;
    document.getElementById('test_performed').value = test_performed;
    document.getElementById('status').value = status;
    document.getElementById('defect_description').value = defect_description;

    document.getElementById('qualityControlFormModal').style.display = 'block';
    document.getElementById('addQualityControlBtn').style.display = 'none';
    document.getElementById('updateQualityControlBtn').style.display = 'inline-block';
}

function hideQualityControlForm() {
    document.getElementById('qualityControlFormModal').style.display = 'none';
    document.getElementById('qualityControlForm').reset();
}
