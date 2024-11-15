

document.addEventListener('DOMContentLoaded', function() {
    const versionSwitch = document.getElementById('version-switch');
    versionSwitch.addEventListener('change', function() {
        if (this.checked) {
            switchVersion('short');
        } else {
            switchVersion('full');
        }
    });

    // Initial check on load
    if (versionSwitch.checked) {
        switchVersion('short');
    } else {
        switchVersion('full');
    }
});

function switchVersion(ver) {
    document.querySelectorAll('.ver').forEach(element => {
        element.style.display = 'none';
    });
    document.querySelectorAll(`.${ver}`).forEach(element => {
        element.style.display = 'inline';
    });
}