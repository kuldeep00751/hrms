DecoupledEditor.create(document.querySelector("#editor"))
    .then((editor) => {
        const toolbarContainer = document.querySelector(
            "#kt_docs_ckeditor_document_toolbar"
        );

        toolbarContainer.appendChild(editor.ui.view.toolbar.element);
    })
    .catch((error) => {
        console.error(error);
    });
