document.addEventListener('DOMContentLoaded', (event) => {
	// if (window.innerWidth < 900) {
	// 	const topBar = document.querySelector('.tutor-single-page-top-bar');
	// 	const sideBar = document.querySelector('.tutor-lesson-sidebar');
	// 	sideBar.style.top = topBar.clientHeight + 'px';
	// }
	const topBar = document.querySelector('.tutor-single-page-top-bar');
	const sideBar = document.querySelector('.tutor-lesson-sidebar');
	sideBar.style.top = topBar.clientHeight + 'px';
	// console.log(topBar.clientHeight);
});

document.addEventListener('DOMContentLoaded', (event) => {
	const sideBarTabs = document.querySelectorAll('.tutor-sidebar-tab-item');
	sideBarTabs.forEach((tab) => {
		tab.addEventListener('click', (event) => {
			clearActiveClass();
			// console.log('cosnole.log sadf');
			event.currentTarget.classList.add('active');
			// console.log(event.currentTarget.getAttribute('data-sidebar-tab'));
			// event.target.classList.add('active');
			let id = event.currentTarget.getAttribute('data-sidebar-tab');
			document.getElementById(id).classList.add('active');
		});
	});

	const clearActiveClass = function() {
		for (let i = 0; i < sideBarTabs.length; i++) {
			sideBarTabs[i].classList.remove('active');
			// let id = menuElements[i].getAttribute('data-tab');
			// document.getElementById(id).classList.remove('active');
		}
		let sidebarTabItems = document.querySelectorAll(
			'.tutor-lesson-sidebar-tab-item'
		);
		for (let i = 0; i < sidebarTabItems.length; i++) {
			sidebarTabItems[i].classList.remove('active');
			// let id = menuElements[i].getAttribute('data-tab');
			// document.getElementById(id).classList.remove('active');
		}
	};
});

// var bindAll = function() {
//     var menuElements = document.querySelectorAll('[data-tab]');
//     for(var i = 0; i < menuElements.length ; i++) {
//       menuElements[i].addEventListener('click', change, false);
//     }
//   }

//   var clear = function() {
//     var menuElements = document.querySelectorAll('[data-tab]');
//     for(var i = 0; i < menuElements.length ; i++) {
//       menuElements[i].classList.remove('active');
//       var id = menuElements[i].getAttribute('data-tab');
//       document.getElementById(id).classList.remove('active');
//     }
//   }

//   var change = function(e) {
//     clear();
//     e.target.classList.add('active');
//     var id = e.currentTarget.getAttribute('data-tab');
//     document.getElementById(id).classList.add('active');
//   }
