const navItems = document.querySelector('.nav__items')
const openNavBtn = document.querySelector('#open__nav-btn')
const closeNavBtn = document.querySelector('#close__nav-btn')

const openNav = () => {
	navItems.style.display = 'flex'
	openNavBtn.style.display = 'none'
	closeNavBtn.style.display = 'inline-block'
}

const closeNav = () => {
	navItems.style.display = 'none'
	openNavBtn.style.display = 'inline-block'
	closeNavBtn.style.display = 'none'
}

openNavBtn.addEventListener('click', openNav)
closeNavBtn.addEventListener('click', closeNav)

// #region SIDEBAR

const sidebar = document.querySelector('aside')
const showSidebarBtn = document.querySelector('#show__sidebar-btn')
const hideSidebarBtn = document.querySelector('#hide__sidebar-btn')

const showSidebar = () => {
	sidebar.style.left = '0'
	showSidebarBtn.style.display = 'none'
	hideSidebarBtn.style.display = 'inline-block'
}
const hideSidebar = () => {
	sidebar.style.left = '-100%'
	showSidebarBtn.style.display = 'inline-block'
	hideSidebarBtn.style.display = 'none'
}

showSidebarBtn && showSidebarBtn.addEventListener('click', showSidebar)
hideSidebarBtn && hideSidebarBtn.addEventListener('click', hideSidebar)
// #endregion SIDEBAR

hidden = false

addEventListener('resize', () => {
	if (window.innerWidth > 600 && !hidden) {
		hidden = true
		showSidebarBtn && (showSidebarBtn.style.display = 'none')
		hideSidebarBtn && (hideSidebarBtn.style.display = 'none')
		console.log(hidden)
	}
	if (window.innerWidth <= 600 && hidden) {
		showSidebarBtn && (showSidebarBtn.style.display = 'inline-block')
		hideSidebarBtn && (hideSidebarBtn.style.display = 'inline-block')
		hidden = false
		console.log(hidden)
	}
})

// clear button for avatar image upload (file input)
const clear = document.querySelector('#clear')
const avatar = document.querySelector('#avatar')
clear?.addEventListener('click', () => {
	avatar.value = ''
})
