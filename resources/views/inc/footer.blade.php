<div class="container">
    Это футер

    <div class="modal fade" id="deleteReview">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteReviewModalTitle">Удалить комментарий</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить ваш комментарий?</p>
                </div>
                <div class="modal-footer d-flex align-items-center justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <form action="#" method="POST" data-review-id="" class="confirm-delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" type="button" class="btn btn-primary ">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editReview">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editReviewModalTitle">Изменить комментарий</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                @auth()
                    <form action="#" method="post" id="edit-review" class="needs-validation
                    @if($errors->any()) was-validated @endif">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">

                            <div class="d-flex flex-column gap-2">
                                <x-input-group>
                                    <x-label for="stars" required>Оценка:</x-label>
                                    <x-input type="range" name="stars" id="stars" min="0" max="5"
                                             class="form-range h-auto"/>
                                </x-input-group>

                                <x-input-group>
                                    <x-label for="title">Заголовок:</x-label>
                                    <x-input type="text" name="title" id="title"/>
                                </x-input-group>

                                <x-input-group>
                                    <x-label class="input-group-text" for="text">Отзыв:</x-label>
                                    <textarea name="text" id="text" class="form-control" aria-label="With textarea"></textarea>
                                </x-input-group>
                            </div>
                        </div>

                        <div class="modal-footer d-flex align-items-center justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>

                            <button type="submit" type="button" class="btn btn-primary ">Изменить</button>
                        </div>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</div>
