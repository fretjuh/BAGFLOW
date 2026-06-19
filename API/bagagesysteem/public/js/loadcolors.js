function applyColors(colors) {
  const root = document.documentElement;
  if (colors.button) {
    root.style.setProperty("--button-color", colors.button);
  }
  if (colors.buttonHover) {
    root.style.setProperty("--button-hover-color", colors.buttonHover);
  }
}

const saved = localStorage.getItem("userColors");
if (saved) {
  applyColors(JSON.parse(saved));
}
