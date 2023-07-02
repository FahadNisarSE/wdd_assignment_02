const body = document.querySelector("body");

function toggleTheme() {
  const toggler = document.getElementById("toggler");

  if (body.classList.contains("dark-mode")) {
    body.classList.remove("dark-mode");
    toggler.innerText = "Dark Mode";
  } else {
    body.classList.add("dark-mode");
    toggler.innerText = "Light Mode";
  }
}
