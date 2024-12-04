tinymce.init({
    selector: '#content-editor',
    plugins: 'image link code lists',
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | bullist numlist | code',
    height: 600,
    file_picker_types: 'image',

    forced_root_block: false,
    forced_br_newlines: true,
    forced_p_newlines: false,

    valid_elements: '*[*]',
    cleanup: true,
    file_picker_callback: function(callback, value, meta) {
        if (meta.filetype === 'image') {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.onchange = function() {
                const file = this.files[0];
                const reader = new FileReader();

                reader.onload = function() {
                    callback(reader.result, {
                        alt: file.name
                    });
                };
                reader.readAsDataURL(file);
            };
            input.click();
        }
    }
});