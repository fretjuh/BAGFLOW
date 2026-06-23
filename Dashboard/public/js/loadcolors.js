function applyColors(colors) {
  const root = document.documentElement;
  if (colors.button) {
    root.style.setProperty("--button-color", colors.button);
  }
  if (colors.buttonHover) {
    root.style.setProperty("--button-hover-color", colors.buttonHover);
  }
}

function applyTheme(theme) {
  const root = document.documentElement;
  if (theme === "light") {
    root.dataset.theme = "light";
  } else {
    root.removeAttribute("data-theme");
  }
}

const savedColors = localStorage.getItem("userColors");
if (savedColors) {
  applyColors(JSON.parse(savedColors));
}

const savedTheme = localStorage.getItem("userTheme");
if (savedTheme) {
  applyTheme(savedTheme);
}