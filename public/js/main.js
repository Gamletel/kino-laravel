

$(document).ready(function () {

    /*AJAX UPDATE USER NAME*/
    $('#update-name').on('submit', function (e) {
        let input = $(this).find('input');
        e.preventDefault(); // Отменить стандартное поведение отправки формы

        $.ajax({
            url: $(this).attr('action'), // URL-адрес маршрута Laravel
            type: 'POST', // Тип запроса (GET, POST, PUT, DELETE и т.д.)
            data: $(this).serialize(), // Сериализовать данные формы
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Добавить токен CSRF в заголовок запроса
            },
            success: function (response) {
                // Обновить данные на странице
                $('#user-name').text(response.name);
            },
            error: function (error) {
            }
        });
    });

    /*AJAX UPDATE USER EMAIL*/
    $('#update-email').on('submit', function (e) {
        let form = $(this);
        let input = $(this).find('input');
        e.preventDefault(); // Отменить стандартное поведение отправки формы

        $.ajax({
            url: $(this).attr('action'), // URL-адрес маршрута Laravel
            type: 'POST', // Тип запроса (GET, POST, PUT, DELETE и т.д.)
            data: $(this).serialize(), // Сериализовать данные формы
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Добавить токен CSRF в заголовок запроса
            },
            success: function (response) {
                // Обновить данные на странице
                input.removeClass('is-invalid');
                input.addClass('is-valid');
                $('#user-email').text(response.email);
            },
            error: function (error) {
                // Код, который выполняется при ошибке запроса
                // $('#email').html(error.responseJSON.errors['email']);
                input.removeClass('is-valid');
                input.addClass('is-invalid');


                // form.addClass('was-validated');
                console.log(error);
            }
        });
    });

    /*AJAX UPDATE USER AVATAR*/
    $('#update-avatar').on('submit', function (e) {
        let formData = new FormData(this);
        let input = $(this).find('input[type="file"]');
        e.preventDefault(); // Отменить стандартное поведение отправки формы

        $.ajax({
            url: $(this).attr('action'), // URL-адрес маршрута Laravel
            type: 'POST', // Тип запроса (GET, POST, PUT, DELETE и т.д.)
            data: formData, // Отправить объект FormData
            processData: false, // Отключить обработку данных, иначе файл не будет отправлен
            contentType: false, // Отключить заголовок content-type, иначе файл не будет отправлен
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Добавить токен CSRF в заголовок запроса
            },
            success: function (response) {
                console.log(response)
                // Обновить данные на странице
                input.removeClass('is-invalid');
                input.addClass('is-valid');
                $('#user-avatar img').attr('src', response.avatar);
            },
            error: function (error) {
                // Код, который выполняется при ошибке запроса
                input.removeClass('is-valid');
                input.addClass('is-invalid');

                // form.addClass('was-validated');
                console.log(error);
            }
        });
    });

    /*DELETE REVIEW*/
    function deleteReview(reviewID) {
        let confirmDelete = $('#deleteReview .confirm-delete');
        confirmDelete.data('review-id', reviewID);
        let action = `/reviews/$id/delete`.replace(`$id`, reviewID);
        confirmDelete.attr('action', action);
    }

    let deleteReviewBtn = $('.delete-review-btn');
    deleteReviewBtn.click(function () {
        let reviewID = $(this).data('review-id');

        deleteReview(reviewID)
    });

    /*UPDATE REVIEW*/
    function editReview(reviewID, starsValue, titleValue, textValue) {
        let editReviewForm = $('#editReview #edit-review');
        let starsInput = editReviewForm.find('#stars');
        let titleInput = editReviewForm.find('#title');
        let textInput = editReviewForm.find('#text');

        starsInput.val(starsValue);
        titleInput.val(titleValue);
        textInput.val(textValue);

        editReviewForm.data('review-id', reviewID);
        let action = `/reviews/$id/edit`.replace(`$id`, reviewID);
        editReviewForm.attr('action', action);
        editReviewForm.attr('data-review-id', reviewID);
    }

    let reviewCard = $('.review-card');
    let curReviewCard = null;
    reviewCard.each(function () {
        let card = $(this);
        let editReviewBtn = $(this).find('.edit-review-btn');

        editReviewBtn.click(function () {
            curReviewCard = card;
            let reviewID = $(this).data('review-id');
            let starsValue = curReviewCard.find('.review-stars').data('value');
            let titleValue = curReviewCard.find('.review-title').text();
            let textValue = curReviewCard.find('.review-text').text();

            editReview(reviewID, starsValue, titleValue, textValue)
        });
    });

    /*AJAX UPDATE REVIEW*/
    $('#edit-review').on('submit', function (e) {
        e.preventDefault(); // Отменить стандартное поведение отправки формы

        $.ajax({
            url: $(this).attr('action'), // URL-адрес маршрута Laravel
            type: 'PATCH', // Тип запроса (GET, POST, PUT, DELETE и т.д.)
            data: $(this).serialize(), // Сериализовать данные формы
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Добавить токен CSRF в заголовок запроса
            },
            success: function (response) {
                // Обновить данные на странице
                curReviewCard.find('.review-stars .value').text(response.stars);
                curReviewCard.find('.review-title').text(response.title);
                curReviewCard.find('.review-text').text(response.text);
            },
            error: function (error) {
                console.log(error)
            }
        });
    });

    /*AJAX UPDATE REVIEW CARDS*/
    let reviewCards = $('.review-card');
    reviewCards.each(function () {
        let likeBtn = $(this).find('.like-btn');
        let dislikeBtn = $(this).find('.dislike-btn');
        /*AJAX SET LIKE TO REVIEW*/
        $(this).find('.like-form').on('submit', function (e) {
            e.preventDefault(); // Отменить стандартное поведение отправки формы

            let form = $(this);

            $.ajax({
                url: $(this).attr('action'), // URL-адрес маршрута Laravel
                type: 'POST', // Тип запроса (GET, POST, PUT, DELETE и т.д.)
                data: $(this).serialize(), // Сериализовать данные формы
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Добавить токен CSRF в заголовок запроса
                },
                success: function (response) {
                    // Обновить данные
                    likeBtn.toggleClass('active');
                    likeBtn.find('.count').text(response.likes);
                    dislikeBtn.removeClass('active');
                    dislikeBtn.find('.count').text(response.dislikes);
                },
                error: function (error) {
                    console.log(error)
                }
            });
        });

        /*AJAX SET DISLIKE TO REVIEW*/
        $(this).find('.dislike-form').on('submit', function (e) {
            e.preventDefault(); // Отменить стандартное поведение отправки формы

            let form = $(this);

            $.ajax({
                url: $(this).attr('action'), // URL-адрес маршрута Laravel
                type: 'POST', // Тип запроса (GET, POST, PUT, DELETE и т.д.)
                data: $(this).serialize(), // Сериализовать данные формы
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Добавить токен CSRF в заголовок запроса
                },
                success: function (response) {
                    // Обновить данные
                    likeBtn.removeClass('active');
                    likeBtn.find('.count').text(response.likes);
                    dislikeBtn.toggleClass('active');
                    dislikeBtn.find('.count').text(response.dislikes);
                },
                error: function (error) {
                    console.log(error)
                }
            });
        });
    })

    /*AJAX DELETE GENRE*/
    function deleteGenre(genreID, genreName) {
        let confirmDelete = $('#deleteGenre .confirm-delete');
        let formGenreName = $('#deleteGenre #genre-name');
        formGenreName.text(genreName);
        confirmDelete.data('genre-id', genreID);
        let action = `/genres/$id/delete`.replace(`$id`, genreID);
        confirmDelete.attr('action', action);
    }

    let deleteGenreBtn = $('.delete-genre-btn');
    deleteGenreBtn.click(function () {
        let genreID = $(this).data('genre-id');
        let genreName = $(this).data('genre-name');
        deleteGenre(genreID, genreName);
    });

    $(this).find('#delete-genre-form').on('submit', function (e) {
        e.preventDefault(); // Отменить стандартное поведение отправки формы
        let form = $(this);

        $.ajax({
            url: $(this).attr('action'), // URL-адрес маршрута Laravel
            type: 'POST', // Тип запроса (GET, POST, PUT, DELETE и т.д.)
            data: $(this).serialize(), // Сериализовать данные формы
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Добавить токен CSRF в заголовок запроса
            },
            success: function (response) {
                // Обновить данные
                console.log(response.id);
                $(`#genre-card-${response.id}`).remove();
            },
            error: function (error) {
                console.log(error)
            }
        });
    });
});
