<?php

namespace App\Http\Controllers;

use App\Models\Money;
use App\Http\Requests\StoreMoneyRequest;
use App\Http\Requests\UpdateMoneyRequest;
use App\Models\marketplace;


class MoneyAPI extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$money = Money::all();
		return response()->json([ money ], 200);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		
	}
	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		// Crie uma instância do modelo Money e preencha os campos diretamente a partir do pedido.
		$money = Money::create([
			'name' => $request->input('name'),
			'year' => $request->input('year'),
			'country' => $request->input('country'),
			'condition' => $request->input('condition'),
			'price' => $request->input('price'),
			'observation' => $request->input('observation'),
			'type' => $request->input('type'),
			'material' => $request->input('material'),
			'available_sell' => isset($request->available_sell) ? 1 : 0,
			'user_id' => $request->input('user_id'),
			'url_img' => $request->input('url_img'),
		]);

		// Verifique se o campo 'available_sell' está definido como verdadeiro.
		if ($money->available_sell) {
			$money->marketplace()->create();
		}
		// Retorne uma resposta adequada, como um redirecionamento ou uma resposta JSON.
		// Por exemplo:
		return response()->json(["status" => "OK" ], 200);
	}

	/*
	 * Display the specified resource.
	 */
	public function show()
	{
		echo " bernardk";
		// $money = Money::where([
		// 		"user_id" => $userId,
		// 	])->get();
		// return response()->json([ money ], 200);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Money $money)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateMoneyRequest $request, Money $money)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Money $money)
	{
		//
	}
}
