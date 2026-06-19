// --- Menu Toggle ---
const menuToggle = document.getElementById('menu-toggle');
const dropdownMenu = document.getElementById('dropdown-menu');

if (menuToggle && dropdownMenu) {
  menuToggle.addEventListener('click', function() {
    dropdownMenu.classList.toggle('active');
    menuToggle.classList.toggle('active');
  });

  // Close menu when clicking outside
  document.addEventListener('click', function(event) {
    if (!event.target.closest('.menu-container')) {
      dropdownMenu.classList.remove('active');
      menuToggle.classList.remove('active');
    }
  });

  // Close menu when clicking a menu item
  const menuItems = dropdownMenu.querySelectorAll('.menu-item');
  menuItems.forEach(item => {
    item.addEventListener('click', function() {
      dropdownMenu.classList.remove('active');
      menuToggle.classList.remove('active');
    });
  });
}

// --- Storage layer ---
function saveColors(colors) {
  localStorage.setItem('userColors', JSON.stringify(colors));
}

function loadColors() {
  const stored = localStorage.getItem('userColors');
  return stored ? JSON.parse(stored) : null;
}

// --- Apply colors to CSS variables ---
function applyColors(colors) {
  const root = document.documentElement;
  if (colors.button) {
    root.style.setProperty('--button-color', colors.button);
  }
  if (colors.buttonHover) {
    root.style.setProperty('--button-hover-color', colors.buttonHover);
  }
}

// --- Update color value displays ---
function updateColorDisplay() {
  const buttonColorPicker = document.getElementById('button-color-picker');
  const buttonHoverColorPicker = document.getElementById('button-hover-color-picker');
  const buttonColorValue = document.getElementById('button-color-value');
  const buttonHoverColorValue = document.getElementById('button-hover-color-value');

  if (buttonColorPicker && buttonColorValue) {
    buttonColorValue.textContent = buttonColorPicker.value.toUpperCase();
  }
  if (buttonHoverColorPicker && buttonHoverColorValue) {
    buttonHoverColorValue.textContent = buttonHoverColorPicker.value.toUpperCase();
  }
}

// --- On color input change ---
const buttonColorPicker = document.getElementById('button-color-picker');
const buttonHoverColorPicker = document.getElementById('button-hover-color-picker');

if (buttonColorPicker) {
  buttonColorPicker.addEventListener('input', updateColorDisplay);
}
if (buttonHoverColorPicker) {
  buttonHoverColorPicker.addEventListener('input', updateColorDisplay);
}

// --- On submit ---
document.getElementById('colors-form').addEventListener('submit', function(e) {
  e.preventDefault();

  const colors = {
    button: document.getElementById('button-color-picker').value,
    buttonHover: document.getElementById('button-hover-color-picker').value
  };

  applyColors(colors);
  saveColors(colors);
});
