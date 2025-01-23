document.addEventListener('DOMContentLoaded', () => {
    setupViewCourseModal();

    setupAddCourseModal();
});

// Configura o modal de "Ver Curso"
function setupViewCourseModal() {
    const viewCourseModalOverlay = document.getElementById('viewCourseModalOverlay');
    const openButtons = document.querySelectorAll('.btn-open-view-course');
    const closeButton = viewCourseModalOverlay.querySelector('.close-modal-btn');

    openButtons.forEach(button => {
        const courseTitle = button.getAttribute('data-course-title');
        const courseDescription = button.getAttribute('data-course-description');
        const courseImage = button.getAttribute('data-course-image');

        button.addEventListener('click', () => {
            updateViewCourseModal(courseTitle, courseDescription, courseImage); 
            openModal(viewCourseModalOverlay);
        });
    });

    addCloseModalEvent(closeButton, viewCourseModalOverlay);

    addOverlayClickEvent(viewCourseModalOverlay);
}


// Configura o modal de "Adicionar Curso"
function setupAddCourseModal() {
    const addCourseModalOverlay = document.getElementById('addCourseModalOverlay');
    const openButton = document.querySelector('.btn-open-add-course');
    const closeButton = addCourseModalOverlay.querySelector('.close-modal-btn');


    addOpenModalEvent(openButton, addCourseModalOverlay);


    addCloseModalEvent(closeButton, addCourseModalOverlay);


    addOverlayClickEvent(addCourseModalOverlay);
}

// Função para exibir a pré-visualização da imagem no modal "Adicionar Curso"
function setupImagePreview() {
    const imageInput = document.getElementById('image');
    const previewContainer = document.querySelector('.image-preview');
    const previewImage = previewContainer.querySelector('img');
    const previewText = previewContainer.querySelector('.preview-text');

    imageInput.addEventListener('change', () => {
        const file = imageInput.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = () => {
                previewImage.src = reader.result;
                previewImage.style.display = 'block';
                previewText.style.display = 'none';
            };

            reader.readAsDataURL(file);
        } else {
            previewImage.src = '';
            previewImage.style.display = 'none';
            previewText.style.display = 'block';
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    setupImagePreview();
});

