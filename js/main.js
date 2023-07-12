// 

// function Menu(e){
//     let list = document.querySelector('.nav__items');
//     e.name === 'menu' ? (e.name = 'close',
//     list.classList.add('top-[80px]'),
//     list.classList.add('opacity-100')) : (e.name = "menu",
//     list.classList.remove('top-[80px]'),
//     list.classList.remove('opacity-100'))

// }

//document.addEventListener('DOMContentLoaded', function() {
    const navItems = document.querySelector('.nav__items');
    const openNavBtn = document.querySelector('#open__nav-btn');
    const closeNavBtn = document.querySelector('#close__nav-btn');

    // opens nav dropdown
    const openNav = () => {
        navItems.style.display = 'flex';
        openNavBtn.style.display = 'none';
        closeNavBtn.style.display = 'inline-block';
    };

    // close nav dropdown
    const closeNav = () => {
        navItems.style.display = 'none';
        openNavBtn.style.display = 'inline-block';
        closeNavBtn.style.display = 'none';
    };

    openNavBtn.addEventListener('click', openNav);
    closeNavBtn.addEventListener('click', closeNav);
    
    closeNav(); // Call closeNav() on page load to hide the nav dropdown
//});

const sidebar = document.querySelector('aside');
const showSidebarBtn = document.querySelector('#show__sidebar-btn');
const hideSidebarBtn = document.querySelector('#hide__sidebar-btn');

// shows sidebar on small devices
const showSidebar = () => {
    sidebar.style.left = '0';
    showSidebarBtn.style.display = 'none';
    hideSidebarBtn.style.display = 'inline-block';
};

// hides sidebar on small devices
const hideSidebar = () => {
    sidebar.style.left = '-100%';
    showSidebarBtn.style.display = 'inline-block';
    hideSidebarBtn.style.display = 'none';
};

showSidebarBtn.addEventListener('click', showSidebar);
hideSidebarBtn.addEventListener('click', hideSidebar);

// single post checked 
$('.list-item').on('click', function() {
    $(this).toggleClass('is-checked');
  });

  
  
  //social media share modal
 
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

  

