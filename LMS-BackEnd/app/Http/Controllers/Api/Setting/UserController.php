<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Contracts\Services\User;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Setting\User\{
    Item,
    Collection
};
use App\Http\Requests\Api\Setting\User\{
    StoreRequest,
    UpdateRequest
};

class UserController extends Controller
{
    /**
     * @var User
     */
    private User $user;

    /**
     * UserController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new Collection(
            $this->user->index(request()->get("per_page", 15), request()->get('query'))
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return Item
     */
    public function store(StoreRequest $request)
    {
        return new Item(
            $this->user->create($request->validated())
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new Item(
            $this->user->view($id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Users\UpdateRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        return new JsonResponse([
            'success' => $this->user->update($id, $request->validated())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return new JsonResponse([
            'success' => $this->user->delete($id)
        ]);
    }
}
