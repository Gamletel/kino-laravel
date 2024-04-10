$(document).ready(function () {

    /*DELETE REVIEW*/
    function deleteReview(reviewID) {
        let confirmDelete = $('#deleteReview .confirm-delete');
        confirmDelete.data('review-id', reviewID);
        let action = `/review/delete/$id`.replace(`$id`, reviewID);
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
        let action = `/review/edit/$id`.replace(`$id`, reviewID);
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
            }
        });
    });
});
