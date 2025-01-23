document.addEventListener('DOMContentLoaded', () => {
    setupViewCourseModal();
    setupAddCourseModal();
    setupEditCourseModal(); 
    setupImagePreview();
    setupSubscribeButton()
});

function setupViewCourseModal() {
    const viewCourseModalOverlay = document.getElementById('viewCourseModalOverlay');
    const openButtons = document.querySelectorAll('.btn-open-view-course');
    const closeButton = viewCourseModalOverlay.querySelector('.close-modal-btn');

    openButtons.forEach(button => {
        const courseTitle = button.getAttribute('data-course-title');
        const courseDescription = button.getAttribute('data-course-description');
        const courseImage = button.getAttribute('data-course-image');

        button.addEventListener('click', () => {
            showCourseModal(button.getAttribute('data-course-id'), courseTitle, courseDescription, courseImage, true);
            openModal(viewCourseModalOverlay);
        });
    });

    if (closeButton) {
        addCloseModalEvent(closeButton, viewCourseModalOverlay);
    }

    addOverlayClickEvent(viewCourseModalOverlay);
}

function setupAddCourseModal() {
    const addCourseModalOverlay = document.getElementById('addCourseModalOverlay');
    const openButton = document.querySelector('.btn-open-add-course');
    const closeButton = addCourseModalOverlay.querySelector('.close-modal-btn');

    if (openButton) {
        addOpenModalEvent(openButton, addCourseModalOverlay);
    }
    if (closeButton) {
        addCloseModalEvent(closeButton, addCourseModalOverlay);
    }
    addOverlayClickEvent(addCourseModalOverlay);
}

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

$(document).ready(function(){
    $('.slick-slider').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});

function showCourseModal(courseId, title, description, image, isAdmin) {
    const modalOverlay = document.getElementById('viewCourseModalOverlay');
    const courseTitle = document.getElementById('courseTitle');
    const courseDescription = document.getElementById('courseDescription');
    const courseImage = document.getElementById('courseImage');
    const deleteCourseButton = document.getElementById('deleteCourseButton');
    const editCourseButton = document.getElementById('editCourseButton');

    courseTitle.textContent = title;
    courseDescription.textContent = description;
    courseImage.src = image;

    if (deleteCourseButton) {
        const newDeleteButton = deleteCourseButton.cloneNode(true);
        deleteCourseButton.parentNode.replaceChild(newDeleteButton, deleteCourseButton);

        newDeleteButton.setAttribute('data-course-id', courseId);
        if (isAdmin) {
            newDeleteButton.classList.remove('hidden');
        } else {
            newDeleteButton.classList.add('hidden');
        }

        newDeleteButton.addEventListener('click', function () {
            const courseId = this.dataset.courseId;

            if (confirm('Tem certeza que deseja excluir este curso?')) {
                fetch(`../models/delete_course.php`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: courseId }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Curso excluído com sucesso.');
                            location.reload();
                        } else {
                            alert(data.message || 'Erro ao excluir o curso.');
                        }
                    })
                    .catch(error => console.error('Erro na exclusão:', error));
            }
        });
    }

    if (editCourseButton) {
        const newEditButton = editCourseButton.cloneNode(true);
        editCourseButton.parentNode.replaceChild(newEditButton, editCourseButton);

        newEditButton.setAttribute('data-course-id', courseId);

        newEditButton.addEventListener('click', function () {
            const courseId = this.dataset.courseId;
            fetchCourseData(courseId, populateEditForm);
            openModal(document.getElementById('editCourseModalOverlay'));
        });
    }

    modalOverlay.classList.remove('hidden');
}

function fetchCourseData(courseId, callback) {
    if (!courseId) {
        console.error("ID do curso não fornecido.");
        return;
    }
    fetch(`../models/get_course.php?course_id=${courseId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                callback(data.course);
            } else {
                alert(data.message || 'Erro ao carregar dados do curso.');
            }
        })
        .catch(error => console.error('Erro ao carregar dados do curso:', error));
}

function populateEditForm(course) {
    document.getElementById('edit-course-id').value = course.id;
    document.getElementById('edit-title').value = course.title;
    document.getElementById('edit-description').value = course.description;
    const previewImage = document.getElementById('edit-preview-image');
    if (course.image) {
        previewImage.src = course.image;
        previewImage.style.display = 'block';
    } else {
        previewImage.src = '';
        previewImage.style.display = 'none';
    }
}

function openModal(modalOverlay) {
    modalOverlay.classList.remove('hidden');
}

function closeModal(modalOverlay) {
    modalOverlay.classList.add('hidden');
}

function addOverlayClickEvent(modalOverlay) {
    modalOverlay.addEventListener('click', (event) => {
        if (event.target === modalOverlay) {
            closeModal(modalOverlay);
        }
    });
}

function addOpenModalEvent(button, modalOverlay) {
    button.addEventListener('click', () => {
        openModal(modalOverlay);
    });
}

function addCloseModalEvent(button, modalOverlay) {
    button.addEventListener('click', () => {
        closeModal(modalOverlay);
    });
}

document.getElementById('editCourseForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message || 'Curso atualizado com sucesso.');
            window.location.href = 'dashboard.php'; // Redireciona para o dashboard
        } else {
            alert(data.message || 'Erro ao atualizar o curso.');
        }
    })
    .catch(error => {
        console.error('Erro ao atualizar o curso:', error);
        alert('Erro ao atualizar o curso.');
    });
});


document.addEventListener('DOMContentLoaded', () => {
    setupViewCourseModal();
    setupAddCourseModal();
    setupImagePreview();
    setupSubscribeButton();
});

function setupSubscribeButton() {
    const subscribeButton = document.getElementById('subscribeButton');
    if (subscribeButton) {
        subscribeButton.addEventListener('click', function () {
            const courseId = this.dataset.courseId;
            subscribeToCourse(courseId);
        });
    }
}

function subscribeToCourse(courseId) {
    fetch(`../models/subscribe_course.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ course_id: courseId }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Inscrição realizada com sucesso.');
            location.reload(); 
        } else {
            alert(data.message || 'Erro ao realizar a inscrição.');
        }
    })
    .catch(error => console.error('Erro na inscrição:', error));
}

document.addEventListener('DOMContentLoaded', () => {
    setupViewCourseModal();
    setupAddCourseModal();
    setupImagePreview();
    setupSubscribeButton();
});

function setupSubscribeButton() {
    const subscribeButton = document.getElementById('subscribeButton');
    if (subscribeButton) {
        subscribeButton.addEventListener('click', function () {
            const courseId = this.dataset.courseId;
            const isSubscribed = this.dataset.subscribed === "true";
            if (isSubscribed) {
                unsubscribeFromCourse(courseId, subscribeButton);
            } else {
                subscribeToCourse(courseId, subscribeButton);
            }
        });
    }
}

function subscribeToCourse(courseId, button) {
    fetch(`../models/subscribe_course.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ course_id: courseId }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Inscrição realizada com sucesso.');
            button.textContent = "Desinscrever-se";
            button.dataset.subscribed = "true";
            location.reload(); 
        } else {
            alert(data.message || 'Erro ao realizar a inscrição.');
        }
    })
    .catch(error => console.error('Erro na inscrição:', error));
}

function unsubscribeFromCourse(courseId, button) {
    fetch(`../models/unsubscribe_course.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ course_id: courseId }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Inscrição removida com sucesso.');
            button.textContent = "Inscrever-se";
            button.dataset.subscribed = "false";
            location.reload(); 
        } else {
            alert(data.message || 'Erro ao remover a inscrição.');
        }
    })
    .catch(error => console.error('Erro ao remover a inscrição:', error));
}