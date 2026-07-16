import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';

const escapeHtml = (value) =>
    String(value ?? '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#39;');

const showStudentAlert = (message) => {
    const alertBox = document.getElementById('student-alert');

    if (!alertBox) {
        return;
    }

    alertBox.innerHTML = `
        <div class="px-4 py-3 rounded-lg border border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900/30 text-sm text-green-700 dark:text-green-300">
            ${message}
        </div>
    `;
};

const refreshStudentList = () => {
    fetch(window.location.href)
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            const tableBody = document.getElementById('student-table');
            const newTableBody = doc.getElementById('student-table');
            if (tableBody && newTableBody) {
                tableBody.innerHTML = newTableBody.innerHTML;
            }

            const pagination = document.getElementById('student-pagination-container');
            const newPagination = doc.getElementById('student-pagination-container');
            if (pagination && newPagination) {
                pagination.innerHTML = newPagination.innerHTML;
            }
            
            const countIndicator = document.getElementById('student-count-indicator');
            const newCountIndicator = doc.getElementById('student-count-indicator');
            if (countIndicator && newCountIndicator) {
                countIndicator.outerHTML = newCountIndicator.outerHTML;
            }
        });
};

const studentsChannel = window.Echo.channel('students');

studentsChannel.listen('.student.created', (student) => {
    showStudentAlert(`New student added: ${escapeHtml(student.first_name)} ${escapeHtml(student.last_name)}`);
    refreshStudentList();
});

studentsChannel.listen('.student.updated', (student) => {
    showStudentAlert(`Student updated: ${escapeHtml(student.first_name)} ${escapeHtml(student.last_name)}`);
    refreshStudentList();
});

studentsChannel.listen('.student.deleted', (student) => {
    showStudentAlert(`Student deleted: ${escapeHtml(student.first_name)} ${escapeHtml(student.last_name)}`);
    refreshStudentList();
});
