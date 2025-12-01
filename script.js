// Mobile Menu Toggle
const menuButton = document.getElementById('menu-button');
const navLinks = document.querySelector('.nav-links');

function toggleMenu() {
  navLinks.classList.toggle('open');
  const isExpanded = navLinks.classList.contains('open');
  menuButton.setAttribute('aria-expanded', isExpanded);
  menuButton.innerHTML = isExpanded ? '✕' : '☰';
}

menuButton.addEventListener('click', toggleMenu);

// Close menu when a link is clicked
navLinks.querySelectorAll('a').forEach(link => {
  link.addEventListener('click', () => {
    if (navLinks.classList.contains('open')) {
      toggleMenu();
    }
  });
});

// Scroll Progress Bar
window.addEventListener('scroll', function() {
  const scrollProgress = document.getElementById('scroll-progress');
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  const scrollPercentage = (scrollTop / scrollHeight) * 100;
  scrollProgress.style.width = scrollPercentage + '%';
});

// Form Submission Handling
const contactForm = document.getElementById('contact-form-id');
const messageDiv = document.getElementById('form-message');

if (contactForm && messageDiv) {
  contactForm.addEventListener('submit', function(event) {
    event.preventDefault();
    
    const nameInput = document.getElementById('name').value;
    const emailInput = document.getElementById('email').value;

    if (nameInput === '' || emailInput === '') {
      messageDiv.textContent = 'Please fill out all required fields.';
      messageDiv.style.color = 'red';
      messageDiv.style.background = '#ffebee';
    } else {
      messageDiv.textContent = 'Thank you for your message! I will be in touch shortly.';
      messageDiv.style.color = 'green';
      messageDiv.style.background = '#e8f5e9';
      contactForm.reset();
    }
  });
}