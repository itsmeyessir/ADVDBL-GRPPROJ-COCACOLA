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
// prodUnit.js

function showAddUnitForm() {
    document.getElementById('unitFormModal').style.display = 'block';
    document.getElementById('addUnitBtn').style.display = 'inline-block';
    document.getElementById('updateUnitBtn').style.display = 'none';
}

function editUnit(id, product_name, description, size, price, lead_time) {
    document.getElementById('unitId').value = id;
    document.getElementById('product_name').value = product_name;
    document.getElementById('description').value = description;
    document.getElementById('size').value = size;
    document.getElementById('price').value = price;
    document.getElementById('lead_time').value = lead_time;
    
    document.getElementById('unitFormModal').style.display = 'block';
    document.getElementById('addUnitBtn').style.display = 'none';
    document.getElementById('updateUnitBtn').style.display = 'inline-block';
}

function hideUnitForm() {
    document.getElementById('unitFormModal').style.display = 'none';
    document.getElementById('unitForm').reset();
}
