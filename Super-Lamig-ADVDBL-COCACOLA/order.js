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
// order.js
function showAddOrderForm() {
    document.getElementById('orderFormModal').style.display = 'block';
    document.getElementById('addOrderBtn').style.display = 'inline-block';
    document.getElementById('updateOrderBtn').style.display = 'none';
}

function editOrder(id, sales_order_id, buyer_id, items_ordered, total_price, order_date, delivery_date, status) {
    document.getElementById('orderId').value = id;
    document.getElementById('sales_order_id').value = sales_order_id;
    document.getElementById('buyer_id').value = buyer_id;
    document.getElementById('items_ordered').value = items_ordered;
    document.getElementById('total_price').value = total_price;
    document.getElementById('order_date').value = order_date;
    document.getElementById('delivery_date').value = delivery_date;
    document.getElementById('status').value = status;
    
    document.getElementById('orderFormModal').style.display = 'block';
    document.getElementById('addOrderBtn').style.display = 'none';
    document.getElementById('updateOrderBtn').style.display = 'inline-block';
}

function hideOrderForm() {
    document.getElementById('orderFormModal').style.display = 'none';
    document.getElementById('orderForm').reset();
}
