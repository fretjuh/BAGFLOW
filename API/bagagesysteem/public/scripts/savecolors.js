// Menu toggle
const menuToggle = document.getElementById('menu-toggle');
const dropdownMenu = document.getElementById('dropdown-menu');

if (menuToggle && dropdownMenu) {
  menuToggle.addEventListener('click', () => {
    dropdownMenu.classList.toggle('active');
    menuToggle.classList.toggle('active');
  });

  document.addEventListener('click', (event) => {
    if (!event.target.closest('.menu-container')) {
      dropdownMenu.classList.remove('active');
      menuToggle.classList.remove('active');
    }
  });

  dropdownMenu.querySelectorAll('.menu-item').forEach((item) => {
    item.addEventListener('click', () => {
      dropdownMenu.classList.remove('active');
      menuToggle.classList.remove('active');
    });
  });
}

function saveColors(colors) {
  localStorage.setItem('userColors', JSON.stringify(colors));
}

function applyColors(colors) {
  const root = document.documentElement;
  if (colors.button) {
    root.style.setProperty('--button-color', colors.button);
  }
  if (colors.buttonHover) {
    root.style.setProperty('--button-hover-color', colors.buttonHover);
  }
}

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

const buttonColorPicker = document.getElementById('button-color-picker');
const buttonHoverColorPicker = document.getElementById('button-hover-color-picker');
const colorsForm = document.getElementById('colors-form');

if (buttonColorPicker) {
  buttonColorPicker.addEventListener('input', updateColorDisplay);
}
if (buttonHoverColorPicker) {
  buttonHoverColorPicker.addEventListener('input', updateColorDisplay);
}

if (colorsForm) {
  updateColorDisplay();

  colorsForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const colors = {
      button: buttonColorPicker?.value,
      buttonHover: buttonHoverColorPicker?.value,
    };

    applyColors(colors);
    saveColors(colors);
  });
}
