$(document).ready(function() {
    $('.deleteButton').on('click', function(e) {
        e.preventDefault();

        var todoId = $(this).data('id');
        var token = $('meta[name="csrf-token"]').attr('content');
        var button = $(this);
        if (confirm('A you sure to delete todo with id ' + todoId)) {

            $.ajax({
                url: '/delete/' + todoId,
                method: 'delete',
                success: function (data) {
                    button.closest('tr').remove();
                    console.log(data);
                },
                headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
        }
    });

    $('.deleteUserButton').on('click', function(e) {
        e.preventDefault();

        var userId = $(this).data('id');
        var token = $('meta[name="csrf-token"]').attr('content');
        var button = $(this);
        if (confirm('A you sure to delete todo with id ' + userId)) {

            $.ajax({
                url: '/deleteuser/' + userId,
                method: 'delete',
                success: function (data) {
                    button.closest('tr').remove();
                    console.log(data);
                },
                error: function (error)
                {
                    if (error.status === 422)
                    {
                        alert('No access');
                    }
                },
                headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
        }
    });

    // Форма для добавления todo
    $('.addButton').on('click', function(e) {
        e.preventDefault();

        $("#ex2").modal({
            fadeDuration: 100
        });
    });

    $('#addForm').on('submit', function (e) {
        e.preventDefault();

        var todoId = $('[name="id"]').val();
        $.ajax({
            url: '/todo',
            method: 'put',
            data:  $('#addForm').serialize(),
            success: function (data) {
                document.location.reload(true);
            },
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
    });

    // Для редактирования todo
    $('.openModal').on('click', function (e) {
        e.preventDefault();
        $("#ex1").modal({
            fadeDuration: 100
        });
        var todoId = $(this).data('id');
        $.ajax({
            url: '/todo/' + todoId,
            method: 'get',
            success: function (data) {
                for (var param in data) {
                    if(param == "execution_time")
                    {
                        data[param] = data[param].substring(0, 10) + "T" + data[param].substring(11, 16);
                    }

                    $('[name="' + param +'"]').val(data[param]);
                }
            },
            error: function (error)
            {
                if (error.status === 422)
                {
                    alert('No access');
                }
            },
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
    });

    $('#updateForm').on('submit', function (e) {
        e.preventDefault();

        var todoId = $('[name="id"]').val();
        $.ajax({
            url: '/todo/' + todoId,
            method: 'post',
            data:  $('#updateForm').serialize(),
            success: function (data) {
                document.location.reload(true);
            },
            error: function (error)
            {
                if (error.status === 422)
                {
                    alert('No access');
                }
            },
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
    });

    $('.openEditUserForm').on('click', function (e) {
        e.preventDefault();
        $('#ex3').modal({
            fadeDuration: 100
        });

        var userId = $(this).data('id');
        $.ajax({
            url: '/user/' + userId,
            method: 'get',
            success: function (data) {
                for (var param in data) {
                    $('[name="' + param +'"]').val(data[param]);
                }
            },
            error: function (error)
            {
                if (error.status === 422)
                {
                    alert('No access');
                }
            },
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
    });

    $('#updateUserForm').on('submit', function (e) {
        e.preventDefault();

        var userId = $('[name="id"]').val();
        $.ajax({
            url: '/user/' + userId,
            method: 'post',
            data:  $('#updateUserForm').serialize(),
            success: function (data) {
                document.location.reload(true);
            },
            error: function (error)
            {
                if (error.status === 422)
                {
                    alert('No access');
                }
            },
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
    });

    // Для смены папки в менеджере
    $('.changeFolder').on('click', function (e) {
        e.preventDefault();

        var folderName = $(this).data('name');
        $.ajax({
            url: '/filemanager/' + folderName,
            method: 'get',
            success: function (data)
            {
                document.location.reload(true);
            },
            error: function (error)
            {
                if (error.status === 422)
                {
                    alert('No access');
                }
            },
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
    });

    // Для перехода на одну папку вверх в менеджере
    $('.goUp').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            url: '/filemanager/go/up',
            method: 'get',
            success: function (data)
            {
                document.location.reload(true);
            },
            error: function (error)
            {
                if (error.status === 422)
                {
                    alert('No access');
                }
            },
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
    });

    // Для загрузки файла
    $('#fileUploadForm').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData($(this)[0]);
        $.ajax({
            url: '/filemanager/upload/file',
            method: 'post',
            data:  formData,
            processData: false,
            contentType: false,
            success: function (data) {
                document.location.reload(true);
            },
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
    });

    // Для создания папки
    $('#folderCreationForm').on('submit', function (e) {
        e.preventDefault();

        var newFolderName = $('[name="newFolderName"]').val();
        $.ajax({
            url: '/filemanager/createfolder/' + newFolderName,
            method: 'post',
            success: function (data) {
                document.location.reload(true);
            },
            error:function(error){
                console.log(error.status);
            },
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
    });

    // Для удаления файла
    $('.deleteFile').on('click', function (e) {
        e.preventDefault();

        var fileName = $(this).data('name');
        $.ajax({
            url: '/filemanager/deletefile/' + fileName,
            method: 'post',
            success: function (data) {
                document.location.reload(true);
            },
            error:function(error){
                console.log(error.status);
            },
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
    });
});
