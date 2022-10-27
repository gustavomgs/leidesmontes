Run composer install in source folder;

Example request:

$dados = [
    'verificarPeca' => [
        'arg0' => [
            'nEtiqueta' => 1
        ]
    ]
];

return (new LeiDesmontesRequests)->request(LeiDesmontesStatements::VERIFICAR_PECA, $dados);