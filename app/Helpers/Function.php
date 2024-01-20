<?php
	
	use Illuminate\Http\JsonResponse;
	use Illuminate\Http\RedirectResponse;
	use Illuminate\Support\Facades\Redirect;
	use Illuminate\Support\Str;
	use Illuminate\Validation\Validator;
	
	
	function selectMedicineType(): array
	{
		return [
			'generic' => 'Generic',
			'branded' => 'Branded'
		];
	}
	
	function selectUnitOfMeasurement(): array
	{
		return [
			'pieces'  => 'Pieces',
			'cartoon' => 'Cartoon'
		];
	}
	
	function generateReceiptNumber(): string
	{
		return generateRandomLetters() . '-' . rand(9999, 9999999);
	}
	
	function generateRandomLetters(): string
	{
		$seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
		shuffle($seed);
		$rand = '';
		foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];
		return $rand;
	}
	
	
	function validateErrorResponse(Validator $validator): JsonResponse
	{
		return response()->json([
			'errmsg' => $validator->getMessageBag()->all()[0]
		], 500);
	}
	
	function successResponse(array $data): JsonResponse
	{
		
		return response()->json([
			'success' => true,
			'data'    => $data
		]);
	}
	
	function redirectWithErrors(Validator $validator): RedirectResponse
	{
		return Redirect::back()->withErrors($validator->getMessageBag()->all()[0]);
	}
	
	function redirectWithInput(Validator $validator): RedirectResponse
	{
		return Redirect::back()->withInput()->withErrors($validator->getMessageBag()->all()[0]);
	}
	
	
	function redirectWithAlert(string $loc, array $alert): RedirectResponse
	{
		return Redirect::to($loc)->with($alert);
	}
	
	function uuid(): string
	{
		return Str::uuid();
	}

