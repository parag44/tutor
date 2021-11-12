document.addEventListener('DOMContentLoaded', (event) => {
	/* sidetab tab position */
	const topBar = document.querySelector('.tutor-single-page-top-bar');
	const sideBar = document.querySelector('.tutor-lesson-sidebar');
	sideBar.style.top = topBar.clientHeight + 'px';
	/* sidetab tab position */

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

	/* commenting */
	const parentComments = document.querySelectorAll(
		'.tutor-comments-list.tutor-parent-comment'
	);
	// const childComment = document.querySelectorAll(
	// 	'.tutor-comments-list.tutor-child-comment'
	// );
	const replyComment = document.querySelector(
		'.tutor-comment-box.tutor-reply-box'
	);
	// console.log(replyComment.clientHeight);
	if (parentComments) {
		parentComments.forEach((parentComment) => {
			const childComments = parentComment.querySelectorAll(
				'.tutor-comments-list.tutor-child-comment'
			);
			const childCommentCount = childComments.length;
			const lastCommentHeight = [childCommentCount - 1].clientHeight;
			let calc =
				lastCommentHeight + replyComment.clientHeight + 20 - 25 + 50;
			// console.log(calc);
			let style = window.getComputedStyle(parentComment, '::before');
			// var styleElem = document.head.appendChild(
			// 	document.createElement('style')
			// );
			console.log(style);
			// styleElem.innerHTML = `tutor-comments-list.tutor-parent-comment:after { height: calc(100% - ${calc}px); }`;
		});
	}
	console.log();

	/* commenting */
});
