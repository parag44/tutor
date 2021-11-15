document.addEventListener('DOMContentLoaded', (event) => {
	/* sidetab tab position */
	const topBar = document.querySelector('.tutor-single-page-top-bar');
	const sideBar = document.querySelector('.tutor-lesson-sidebar');
	sideBar.style.top = topBar.clientHeight + 'px';
	/* sidetab tab position */

	/* sidetab tab */
	// const sideBarTabs = document.querySelectorAll(
	// 	'.tutor-desktop-sidebar .tutor-sidebar-tab-item'
	// );
	// sidebarParent(
	// 	document.querySelectorAll(
	// 		'.tutor-desktop-sidebar .tutor-sidebar-tab-item'
	// 	)
	// );
	const sidebarParent = function(sideBarTabs) {
		sideBarTabs.forEach((tab) => {
			tab.addEventListener('click', (event) => {
				const tabConent =
					event.currentTarget.parentNode.nextElementSibling;
				// console.log(tabConent, tabConent);
				clearActiveClass(tabConent);
				// console.log(event.currentTarget.parentNode);
				// console.log(event.currentTarget.parentNode.nextElementSibling);
				event.currentTarget.classList.add('active');
				let id = event.currentTarget.getAttribute('data-sidebar-tab');
				console.log(tabConent.querySelector('#' + id));
				tabConent.querySelector('#' + id).classList.add('active');
			});
		});
		const clearActiveClass = function(tabConent) {
			for (let i = 0; i < sideBarTabs.length; i++) {
				sideBarTabs[i].classList.remove('active');
			}
			let sidebarTabItems = tabConent.querySelectorAll(
				'.tutor-lesson-sidebar-tab-item'
			);
			for (let i = 0; i < sidebarTabItems.length; i++) {
				sidebarTabItems[i].classList.remove('active');
			}
		};
	};
	sidebarParent(
		document.querySelectorAll(
			'.tutor-desktop-sidebar .tutor-sidebar-tab-item'
		)
	);
	sidebarParent(
		document.querySelectorAll(
			'.tutor-mobile-sidebar .tutor-sidebar-tab-item'
		)
	);
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

	const replyComment = document.querySelector(
		'.tutor-comment-box.tutor-reply-box'
	);

	if (parentComments) {
		[...parentComments].forEach((parentComment) => {
			const childComments = parentComment.querySelectorAll(
				'.tutor-comments-list.tutor-child-comment'
			);
			const commentLine = parentComment.querySelector(
				'.tutor-comment-line'
			);
			const childCommentCount = childComments.length;
			const lastCommentHeight =
				childComments[childCommentCount - 1].clientHeight;
			let heightOfLine =
				lastCommentHeight + replyComment.clientHeight + 20 - 25 + 50;
			commentLine.style.setProperty(
				'height',
				`calc(100% - ${heightOfLine}px)`
			);
			console.log(heightOfLine);
		});
	}
	/* commenting */

	// quize drag n drop functionality
	const quizBoxs = document.querySelectorAll('.tutor-quiz-border-box');
	const quizImageBoxs = document.querySelectorAll('.tutor-quiz-dotted-box');
	// const quizImageBoxs = document.querySelectorAll('.quiz-image-box');
	quizBoxs.forEach((quizBox) => {
		quizBox.addEventListener('dragstart', dragStart);
		quizBox.addEventListener('dragend', dragEnd);
		// console.log(quizBox);
	});
	quizImageBoxs.forEach((quizImageBox) => {
		quizImageBox.addEventListener('dragover', dragOver);
		quizImageBox.addEventListener('dragenter', dragEnter);
		quizImageBox.addEventListener('dragleave', dragLeave);
		quizImageBox.addEventListener('drop', dragDrop);
	});
	function dragStart() {
		this.classList.add('dragging');
		console.log('start ', this);
	}
	function dragEnd() {
		this.classList.remove('dragging');
		console.log('end ', this);
	}
	function dragOver(event) {
		this.classList.add('dragover');
		console.log('dragOver ', this);
		event.preventDefault();
	}
	function dragEnter() {
		console.log('dragEnter ', this);
	}
	function dragLeave() {
		this.classList.remove('dragover');
		console.log('dragLeave ', this);
	}
	function dragDrop() {
		const copyElement = document.querySelector(
			'.tutor-quiz-border-box.dragging span'
		);
		this.textContent = copyElement.textContent;
		console.log('drop ', copyElement.textContent, this.textContent);
		this.classList.remove('dragover');
	}
});
