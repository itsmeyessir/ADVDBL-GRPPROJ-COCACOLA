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

// -------- FOR CRUD --------
// Function to show the add unit form
function showAddUnitForm() {
    document.getElementById('unitFormModal').style.display = 'block';
    document.getElementById('addUnitBtn').style.display = 'inline-block';
    document.getElementById('updateUnitBtn').style.display = 'none';
}

// Function to edit a unit
function editUnit(id, product_id, inventory_id, batch_id, quantity, manufacturing_date, location) {
    document.getElementById('unitId').value = id;
    document.getElementById('product_id').value = product_id;
    document.getElementById('inventory_id').value = inventory_id;
    document.getElementById('batch_id').value = batch_id;
    document.getElementById('quantity').value = quantity;
    document.getElementById('manufacturing_date').value = manufacturing_date;
    document.getElementById('location').value = location;

    document.getElementById('unitFormModal').style.display = 'block';
    document.getElementById('addUnitBtn').style.display = 'none';
    document.getElementById('updateUnitBtn').style.display = 'inline-block';
}

// Function to hide the unit form modal
function hideUnitForm() {
    document.getElementById('unitFormModal').style.display = 'none';
    document.getElementById('unitForm').reset();
}