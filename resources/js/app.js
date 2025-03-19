import './bootstrap';
import $ from 'jquery';
window.$ = window.jQuery = $;
require('bootstrap');

document.addEventListener('DOMContentLoaded', function () {
    const deleteProductButtons = document.querySelectorAll('.delete-product-btn');

    deleteProductButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            console.log('Delete button clicked');
            console.log('Form:', this.closest('form'));
            const form = this.closest('form');
            const deleteConfirmationModal = document.getElementById('deleteConfirmationModal');
            const confirmDeleteButton = document.getElementById('confirmDelete');

            // Set up modal to submit form on confirmation
            confirmDeleteButton.onclick = function() {
                form.submit();
            };

            // Show the modal
            $(deleteConfirmationModal).modal('show');
        });
    });
});
