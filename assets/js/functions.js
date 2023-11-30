
const createCustomModal = (id, title, bodyText, cancelButtonText, buttonText, buttonClass, buttonHref, openInNewTab = false) => `
    <div class="modal fade" id="${id}" tabindex="-1" role="dialog" aria-labelledby="${id}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="${id}Label">
                        ${title}
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="ModalManager.closeModal('${id}')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ${bodyText}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal" onclick="ModalManager.closeModal('${id}')">
                        ${cancelButtonText}
                    </button>
                    <a class="btn ${buttonClass}" href="${buttonHref}" ${openInNewTab ? 'target="_blank"' : ''}>${buttonText}</a>
                </div>
            </div>
        </div>
    </div>
`;

const ModalManager = {
    createCustomModal(id, title, bodyText, cancelButtonText, buttonText, buttonClass, buttonHref, openInNewTab = false) {
        const modalHTML = createCustomModal(id, title, bodyText, cancelButtonText, buttonText, buttonClass, buttonHref, openInNewTab);
        document.body.insertAdjacentHTML('beforeend', modalHTML);
    },

    showModal(id) {
        $(`#${id}`).modal('show');
    },

    closeModal(id) {
        const modal = $(`#${id}`);
        if (modal.length) {
            modal.modal('hide');
            modal.on('hidden.bs.modal', function () {
                modal.remove();
            });
        }
    },
};

function deleteModal(id, targetText, hrefStart) {
    const title = 'Confirmar Eliminación';
    const bodyText = `Haz clic en "Eliminar" para eliminar ${targetText}`;
    const cancelButtonText = 'Cancelar';
    const buttonText = 'Eliminar';
    const buttonClass = 'btn-danger';
    const buttonHref = `${hrefStart}${id}`;

    ModalManager.createCustomModal(id, title, bodyText, cancelButtonText, buttonText, buttonClass, buttonHref);
    ModalManager.showModal(id);
}


function printModal(id, targetText, hrefStart) {
    const title = 'Confirmar Impresión';
    const bodyText = `Haz clic en "Imprimir" para Imprimir ${targetText}`;
    const cancelButtonText = 'Cancelar';
    const buttonText = 'Imprimir';
    const buttonClass = 'btn-primary';
    const buttonHref = `${hrefStart}${id}`;

    ModalManager.createCustomModal(id, title, bodyText, cancelButtonText, buttonText, buttonClass, buttonHref, true);
    ModalManager.showModal(id);
}
