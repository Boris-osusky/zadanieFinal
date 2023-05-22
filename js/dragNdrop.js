$(document).ready(function () {
    var dropzone = $('#dropzone');
    var pointsInput = $('#pointsInput');
    var fromDateInput = $('#fromDateInput');
    var toDateInput = $('#toDateInput');

    $(document).on('dragenter', function (e) {
        e.stopPropagation();
        e.preventDefault();
        dropzone.text('Drop the file here');
    });

    $(document).on('dragover', function (e) {
        e.stopPropagation();
        e.preventDefault();
    });

    $(document).on('drop', function (e) {
        e.stopPropagation();
        e.preventDefault();

        dropzone.text('Uploading...');
        var file = e.originalEvent.dataTransfer.files[0];

        var points = pointsInput.val();
        var fromDate = fromDateInput.val();
        var toDate = toDateInput.val();

        if (!isPositiveInteger(points)) {
            alert('Points should be a positive integer.');
            return;
        }

        var fromDateTime = new Date(fromDate);
        var toDateTime = new Date(toDate);

        if (isNaN(fromDateTime) || isNaN(toDateTime) || fromDateTime > toDateTime) {
            alert('Invalid date range.');
            return;
        }

        uploadFile(file, points, fromDate, toDate);
    });

    function uploadFile(file, points, fromDate, toDate) {
        var formData = new FormData();
        formData.append('file', file);
        formData.append('points', points);
        formData.append('fromDate', fromDate);
        formData.append('toDate', toDate);

        $.ajax({
            url: 'api/uploadFile.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (e) {
                    if (e.lengthComputable) {
                        var percent = Math.round((e.loaded / e.total) * 100);
                        $('#progress').text(percent + '%');
                    }
                });
                return xhr;
            },
            success: function (response) {
                dropzone.text('Drag and drop a file here to upload.');
                $('#progress').empty();
                alert('File uploaded successfully!');
                location.reload();
            },
            error: function () {
                alert('Error uploading file!');
            }
        });
    }

    function isPositiveInteger(value) {
        return /^\d+$/.test(value) && parseInt(value) > 0;
    }
});
