document.addEventListener('DOMContentLoaded', () => {
    const chk = document.getElementById('chk');
    const signupForm = document.querySelector('.signup');
    const loginForm = document.querySelector('.login');

    chk.addEventListener('change', () => {
        if (chk.checked) {
            loginForm.style.transform = 'translateY(-500px)';
            signupForm.style.transform = 'translateY(0)';
        } else {
            loginForm.style.transform = 'translateY(0)';
            signupForm.style.transform = 'translateY(500px)';
        }
    });
});
