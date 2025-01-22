document.addEventListener('DOMContentLoaded', () => {
    const modal = document.querySelector('.modal-overlay');
    const closeModalBtn = document.querySelector('.close-modal');

    // Exibir modal ao carregar a página (uma vez após login)
    if (modal) {
        modal.classList.remove('hidden');
        closeModalBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    }

    // Adicionar funcionalidade de clique nos botões de curso
    const courseButtons = document.querySelectorAll('.course-card .btn');
    courseButtons.forEach(button => {
        button.addEventListener('click', () => {
            alert('Curso selecionado!');
        });
    });
});
