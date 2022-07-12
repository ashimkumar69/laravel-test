<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use MeiliSearch\Endpoints\Indexes;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::with('phone')->paginate(15));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        if (config('scout.driver') === 'meilisearch') {
            $results = User::search($query,
                function (Indexes $meilisearch, string $query, array $options) {
                    $options['attributesToHighlight'] = ['name', 'email'];
                    return $meilisearch->search($query, $options);
                })->raw()['hits'];
        } else {
            $results = User::search($query)->get();
        }
        return $results;
    }

    public function store(Request $request)
    {
    }

    public function show(User $user)
    {
    }

    public function update(Request $request, User $user)
    {
    }

    public function destroy(User $user)
    {
    }
}
