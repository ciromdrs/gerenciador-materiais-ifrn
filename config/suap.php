<?php

# Parâmetros padrão
$response_type = 'token';
$grant_type = 'implict';
$scope = 'identificacao email documentos_pessoais';
$suap_uri = 'https://suap.ifrn.edu.br';

# Parâmetros que dependem do ambiente de execução
$client_id = env('SUAP_CLIENT_ID');
$redirect_uri = env('REDIRECT_URI');

return [
    # URI base do SUAP
    'uri' => $suap_uri,
    # URI dos dados pessoais
    'uri_eu' => $suap_uri . '/api/eu/',
    # URI de autenticação com OAuth2
    'uri_login' => $suap_uri . '/o/authorize/?' . http_build_query([
        'response_type' => $response_type,
        'grant_type' => $grant_type,
        'client_id' => $client_id,
        'scope' => $scope,
        'redirect_uri' => $redirect_uri,
    ]),
    # Dados de autenticação com OAuth2, caso seja necessário, por exemplo,
    # em javascript
    'grant_type' => $grant_type,
    'client_id' => $client_id,
    'scope' => $scope,
    'redirect_uri' => $redirect_uri,
];