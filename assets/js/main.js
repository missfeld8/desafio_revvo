document.addEventListener('DOMContentLoaded', () => {
    const modal = document.querySelector('.modal-overlay');
    const closeModalBtn = document.querySelector('.close-modal');

    // Exibir modal ao carregar a página
    modal.classList.remove('hidden');
    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });
});
