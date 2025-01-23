// Função para abrir um modal
function openModal(modalOverlay) {
    modalOverlay.classList.remove('hidden');
}

// Função para fechar um modal
function closeModal(modalOverlay) {
    modalOverlay.classList.add('hidden');
}

// Função para fechar modal ao clicar na sobreposição
function addOverlayClickEvent(modalOverlay) {
    modalOverlay.addEventListener('click', (event) => {
        if (event.target === modalOverlay) {
            closeModal(modalOverlay);
        }
    });
}

// Função para configurar eventos do botão de abrir modal
function addOpenModalEvent(button, modalOverlay) {
    button.addEventListener('click', () => {
        openModal(modalOverlay);
    });
}

// Função para configurar eventos do botão de fechar modal
function addCloseModalEvent(button, modalOverlay) {
    button.addEventListener('click', () => {
        closeModal(modalOverlay);
    });
}

// Função para atualizar conteúdo do modal de "Ver Curso"
function updateViewCourseModal(courseTitle, courseDescription, courseImage) {
    document.getElementById('courseTitle').innerText = courseTitle;
    document.getElementById('courseDescription').innerText = courseDescription;
    const imageElement = document.getElementById('courseImage');
    if (imageElement) {
        imageElement.src = courseImage;
        imageElement.alt = courseTitle;
    }
}
