// connected_device_form.js

document.addEventListener('DOMContentLoaded', function() {
    const deviceIdInput = document.getElementById('connected_device_deviceId');
    const formFieldsToToggle = document.querySelectorAll('.toggleable-fieldset');

    function toggleFormFieldsVisibility() {
        const selectedDeviceId = deviceIdInput.value;
        const isDeviceIdMatching = selectedDeviceId && selectedDeviceId === '{{ device.idDevice }}'; // Remplacez '{{ device.idDevice }}' par la valeur de l'ID de périphérique correspondant dans votre template Twig

        formFieldsToToggle.forEach(fieldset => {
            if (isDeviceIdMatching) {
                fieldset.classList.remove('hidden');
            } else {
                fieldset.classList.add('hidden');
            }
        });
    }

    deviceIdInput.addEventListener('change', toggleFormFieldsVisibility);
    toggleFormFieldsVisibility();
});
