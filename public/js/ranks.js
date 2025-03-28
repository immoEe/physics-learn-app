function showLogoutModal() {
    document.getElementById('logoutModal').showModal();
}

function closeLogoutModal() {
    document.getElementById('logoutModal').close();
}

document.addEventListener('DOMContentLoaded', function() {
const progressBar = document.querySelector('.rank-progress-bar');
const progressValue = parseInt(progressBar.value);
const maxValue = parseInt(progressBar.max);
const percent = (progressValue / maxValue) * 100;

if(percent < 33) {
    progressBar.style.setProperty('--progress-color', '#ef4444');
} else if(percent < 66) {
    progressBar.style.setProperty('--progress-color', '#eab308');
} else {
    progressBar.style.setProperty('--progress-color', '#22c55e');
}
});

function updateProgress(newPoints) {
const progressBar = document.querySelector('.rank-progress-bar');
progressBar.value = newPoints;
progressBar.nextElementSibling.textContent = `${newPoints}/1000 очк.`;
}