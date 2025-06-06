<?php
// Detecta se a requisição espera JSON
$request = service('request');
$acceptsJson = $request->negotiate('media', ['application/json', 'text/html']) === 'application/json';

// Você pode também usar base na URI, ex: API
$isApi = str_starts_with($request->uri->getPath(), 'api');

if ($acceptsJson || $isApi) {
	header('Content-Type: application/json', true, OK);
	echo json_encode([
		'status'  => false,
		'error'   => NOT_FOUND,
		'message' => 'Página não encontrada.'
	]);
	exit;
}
