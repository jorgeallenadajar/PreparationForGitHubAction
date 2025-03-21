<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FilePond with Bootstrap 5</title>
    <!-- FilePond CSS -->
    <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 for popup alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Upload PDF File</h3>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            <!-- FilePond File Input -->
                            <input type="file" id="files" name="files" class="filepond" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FilePond Scripts -->
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

    <!-- Initialize FilePond and handle PDF validation -->
    <script>
        const inputElement = document.querySelector('#files');
        FilePond.registerPlugin(FilePondPluginImagePreview);
        const pond = FilePond.create(inputElement);
        pond.on('addfile', (error, file) => {
            if (file.fileType !== 'application/pdf') {
                pond.removeFile(file.id);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Only PDF files are allowed.',
                });
            }
        });
    </script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
