<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Money;
use App\Models\tabelao;
use Illuminate\Http\Request;
use Laravel\Prompts\Table;

class CollectionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	private $collectionName = 'collection';
	
	public function index($userId)
	{
		$tabelaoModel = tabelao::where([
			"user_id" => $userId
		])->get();
		// $collectionsModel = Collection::all();
		$collectionsIds = [];
		foreach ($tabelaoModel as $collection) {
			$collectionsIds[] = $collection->collection_id;
		}
		$collections = [];
		foreach ($collectionsIds as $collectionId) {
			$collections[] = $this->moneyCollection($userId, $collectionId);
		}

		return response()->json([
			$this->collectionName => array_values(array_unique($collections))
		], 200);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store($userId, Request $request)
	{
		
		$collection = Collection::create([
			'name' => $request->input('name'),
			'observation' => $request->input('observation'),
			'url_img' => $request->input('url_img'),
		]);
		$id = $collection->id;
		$user = $userId;
		$moneyIds = $request->input("money_id");
		for ($i = 0; $i < count($moneyIds); $i++) {
			$tabelao = new tabelao();
			$tabelao->money_id = $moneyIds[$i];
			$tabelao->collection_id = $id;
			$tabelao->user_id = $user;
			$tabelao->save();
		}
		

		return response()->json([
			$this->collectionName => $this->moneyCollection($user, $id),
			"status" => true
		], 200);
	}
	public function edit($userId, $collectionId, Request $request)
	{

		Collection::findOrFail( $collectionId )->delete();
		tabelao::where([
			"collection_id" => $collectionId,
			"user_id" => $userId
		])->delete();
		$collection = Collection::create([
			'name' => $request->input('name'),
			'observation' => $request->input('observation'),
			'url_img' => $request->input('url_img'),
		]);
		$id = $collection->id;
		$user = $userId;
		$moneyIds = $request->input("money_id");
		for ($i = 0; $i < count($moneyIds); $i++) {
			$tabelao = new tabelao();
			$tabelao->money_id = $moneyIds[$i];
			$tabelao->collection_id = $id;
			$tabelao->user_id = $user;
			$tabelao->save();
		}
		
		return response()->json([
			$this->collectionName => $this->moneyCollection($user, $id),
			"status" => true
		], 200);
	}
	public function moneyCollection($id, $colletion)
	{
		
				$teste = tabelao::with(["money","user","collection"])->where([
					"collection_id" => $colletion,
					"user_id" => $id
				])->get();
				$money_ids = [];
    foreach ($teste as $item) {
        $money_ids[] = $item->money_id;
    }

    $collection = Collection::where([
        "id" => $colletion
    ])->first();

    // Usar um array intermediário
    $moneys = [];
    foreach ($money_ids as $money_id) {
        $money = Money::where([
            "id" => $money_id
        ])->first();
        if ($money) { // Verifique se o objeto Money foi encontrado
            $moneys[] = $money;
        }
    }

    // Atribuir o array intermediário à propriedade sobrecarregada
    $collection->moneys = $moneys;
		
		return $collection;
	}
	/**
	 * Display the specified resource.
	 */
	public function show($userId, $collectionId)
{
    $bernardo = $this->moneyCollection($userId, $collectionId);
    // $money_ids = [];
    // foreach ($bernardo as $item) {
    //     $money_ids[] = $item->money_id;
    // }

    // $collection = Collection::where([
    //     "id" => $collectionId
    // ])->first();

    // // Usar um array intermediário
    // $moneys = [];
    // foreach ($money_ids as $money_id) {
    //     $money = Money::where([
    //         "id" => $money_id
    //     ])->first();
    //     if ($money) { // Verifique se o objeto Money foi encontrado
    //         $moneys[] = $money;
    //     }
    // }

    // // Atribuir o array intermediário à propriedade sobrecarregada
    // $collection->moneys = $moneys;

    return response()->json([
        $this->collectionName => $bernardo,
        "status" => true
    ], 200);
}


	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Collection $collection)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Collection $collection)
	{
		//
	}
}
