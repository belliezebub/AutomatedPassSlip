document.getElementById('add-photo-btn').addEventListener('click', function() {
    document.getElementById('file-upload').click();
});

document.getElementById('file-upload').addEventListener('change', function() {
    document.getElementById('upload-form').submit();
});
