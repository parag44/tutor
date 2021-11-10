document.addEventListener('DOMContentLoaded', (event) => {
	/* sidetab tab position */
	const topBar = document.querySelector('.tutor-single-page-top-bar');
	const sideBar = document.querySelector('.tutor-lesson-sidebar');
	sideBar.style.top = topBar.clientHeight + 'px';

	/* sidetab tab */
	const sideBarTabs = document.querySelectorAll('.tutor-sidebar-tab-item');
	sideBarTabs.forEach((tab) => {
		tab.addEventListener('click', (event) => {
			clearActiveClass();
			event.currentTarget.classList.add('active');
			let id = event.currentTarget.getAttribute('data-sidebar-tab');
			document.getElementById(id).classList.add('active');
		});
	});

	const clearActiveClass = function() {
		for (let i = 0; i < sideBarTabs.length; i++) {
			sideBarTabs[i].classList.remove('active');
		}
		let sidebarTabItems = document.querySelectorAll(
			'.tutor-lesson-sidebar-tab-item'
		);
		for (let i = 0; i < sidebarTabItems.length; i++) {
			sidebarTabItems[i].classList.remove('active');
		}
	};
	/* end of sidetab tab */

	/* comment text-area focus arrow style */
	const commentTextarea = document.querySelectorAll(
		'.tutor-comment-textarea textarea'
	);
	if (commentTextarea) {
		commentTextarea.forEach((item) => {
			item.addEventListener('focus', () => {
				item.parentElement.classList.add('is-focused');
			});
			item.addEventListener('blur', () => {
				item.parentElement.classList.remove('is-focused');
			});
		});
	}
	/* comment text-area focus arrow style */
});
