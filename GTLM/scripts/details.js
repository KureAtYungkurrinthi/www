document.addEventListener("DOMContentLoaded", function () {

    // Patient Information Edit Mode Toggle
    document.getElementById("edit-btn").addEventListener("click", function () {
        togglePatientEditMode(true);
    });

    document.getElementById("cancel-btn").addEventListener("click", function () {
        togglePatientEditMode(false);
        document.getElementById("patient-form").reset();
    });

    function togglePatientEditMode(isEditMode) {
        const inputs = document.querySelectorAll("#patient-form input, #patient-form select");
        inputs.forEach(input => {
            input.disabled = !isEditMode;
        });

        document.getElementById("edit-btn").style.display = isEditMode ? 'none' : 'inline-block';
        document.getElementById("submit-btn").style.display = isEditMode ? 'inline-block' : 'none';
        document.getElementById("cancel-btn").style.display = isEditMode ? 'inline-block' : 'none';
    }

    // Detailed Information Edit Mode Toggle
    document.getElementById("edit-details-btn").addEventListener("click", function () {
        toggleDetailsEditMode(true);
    });

    document.getElementById("cancel-details-btn").addEventListener("click", function () {
        toggleDetailsEditMode(false);
        document.getElementById("details-form").reset();
    });

    function toggleDetailsEditMode(isEditMode) {
        const textareas = document.querySelectorAll("#details-form textarea");
        textareas.forEach(textarea => {
            textarea.readOnly = !isEditMode;
        });

        document.getElementById("edit-details-btn").style.display = isEditMode ? 'none' : 'inline-block';
        document.getElementById("submit-details-btn").style.display = isEditMode ? 'inline-block' : 'none';
        document.getElementById("cancel-details-btn").style.display = isEditMode ? 'inline-block' : 'none';
        document.getElementById("upload-btn").style.display = isEditMode ? 'inline-block' : 'none';
        document.querySelectorAll(".delete-doc-btn").forEach(btn => {
            btn.style.display = isEditMode ? 'inline-block' : 'none';
        });
    }

    // Document Upload and Deletion
    document.getElementById("upload-btn").addEventListener("click", function () {
        document.getElementById("newDocument").click();
    });

    document.getElementById("newDocument").addEventListener("change", function () {
        // Implement AJAX upload or form submit logic here
    });

    document.querySelectorAll(".delete-doc-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            const docElement = btn.closest(".document");
            const docId = docElement.dataset.docid;
            // Implement AJAX deletion or form submit logic here
            // On success, remove the document element from the DOM
            docElement.remove();
        });
    });
});
