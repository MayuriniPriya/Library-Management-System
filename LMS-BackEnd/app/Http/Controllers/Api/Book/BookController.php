<?php

namespace App\Http\Controllers\Api\Book;

use App\Http\Controllers\Controller;
use App\Contracts\Services\Book;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Book\{
    Item,
    Collection
};
use App\Http\Requests\Api\Book\{
    StoreRequest,
    UpdateRequest
};

class BookController extends Controller
{
    /**
     * @var Book
     */
    private Book $book;

    /**
     * BookController constructor.
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new Collection(
            $this->book->index(request()->get("per_page", 15), request()->get('query'))
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return Iteme
     */
    public function store(StoreRequest $request)
    {
        return new Item(
            $this->book->create($request->validated())
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Item
     */
    public function show($id)
    {
        return new Item(
            $this->book->view($id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        return new JsonResponse([
            'success' => $this->book->update($id, $request->validated())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return new JsonResponse([
            'success' => $this->book->delete($id)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function search()
    {
        return new JsonResponse(
            $this->book->search(request()->get('query'), 'title')
        );
    }
}
