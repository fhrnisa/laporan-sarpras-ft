const togglePassword = document.getElementById("togglePassword");
const password = document.getElementById("password");
const eyeOpen = document.getElementById("eyeOpen");
const eyeClosed = document.getElementById("eyeClosed");

togglePassword.addEventListener("click", () => {
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    // toggle icon
    eyeOpen.classList.toggle("hidden");
    eyeClosed.classList.toggle("hidden");
});
