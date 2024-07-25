document.addEventListener('DOMContentLoaded', (event) => {
    // Fonction pour ouvrir une modal
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('show');
        setTimeout(() => {
            modal.querySelector('.modal-content').classList.add('show');
        }, 10);
    }

    // Fonction pour fermer une modal
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.querySelector('.modal-content').classList.remove('show');
        setTimeout(() => {
            modal.classList.remove('show');
        }, 300);
    }

    // Ajouter des écouteurs d'événements aux boutons d'ouverture
    document.querySelectorAll('.open-modal').forEach(button => {
        button.addEventListener('click', (event) => {
            const modalId = event.target.getAttribute('data-modal');
            openModal(modalId);
        });
    });

    // Ajouter des écouteurs d'événements aux boutons de fermeture
    document.querySelectorAll('.close').forEach(span => {
        span.addEventListener('click', (event) => {
            const modalId = event.target.getAttribute('data-modal');
            closeModal(modalId);
        });
    });

    // Fermer la modal si l'utilisateur clique en dehors de celle-ci
    window.addEventListener('click', (event) => {
        if (event.target.classList.contains('modal')) {
            closeModal(event.target.id);
        }
    });
});
