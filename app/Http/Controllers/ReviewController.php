<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reviews\StoreReviewRequest;
use App\Http\Requests\Reviews\UpdateReviewRequest;
use App\Models\Review;
use App\Services\ReviewService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    private ReviewService $reviewService;
    private UserReviewReactionController $reactionController;
    public function __construct(ReviewService $reviewService, UserReviewReactionController $reactionController)
    {
        $this->reviewService = $reviewService;
        $this->reactionController = $reactionController;
    }

    public function create(): JsonResponse
    {
        $review = Review::factory()->create();

        return response()->json($review);
    }

    public function store(StoreReviewRequest $request):RedirectResponse
    {
        $data = $request->validated();

        Review::create($data);

        return back();
    }

    public function destroy(string $id):RedirectResponse
    {
        Review::destroy($id);

        return back();
    }

    public function update(UpdateReviewRequest $request, string $id):JsonResponse
    {
        $data = $request->validated();

        $review = $this->reviewService->updateReview($data, $id);

        return response()->json($review);
    }

    public function getFilmReviews(string $filmID):Review
    {
        return $this->reviewService->getReviewByFilmID($filmID);
    }

    public function setLike(Request $request)
    {
        $reactionController = $this->reactionController;
        $reactionController->setLike($request->user_id, $request->review_id);

        return response()->json([
            'likes' => $reactionController->getLikes($request->review_id),
            'dislikes' => $reactionController->getDislikes($request->review_id),
        ]);
    }

    public function setDislike(Request $request)
    {
        $reactionController = $this->reactionController;
        $reactionController->setDislike($request->user_id, $request->review_id);

        return response()->json([
            'likes' => $reactionController->getLikes($request->review_id),
            'dislikes' => $reactionController->getDislikes($request->review_id),
        ]);
    }
}
