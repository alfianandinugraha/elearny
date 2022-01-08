@props([
    'header',
    'body'
])

<?php
    $headerAttributes = $header->attributes->merge([
        'class' => 'card-header py-3 d-flex flex-row align-items-center'
    ]);
    $bodyAttributes = $body->attributes->merge([
        'class' => 'card-body'
    ]);
?>

<div class="card shadow mb-4">
    <div {{$headerAttributes}}>
        {{$header}}
    </div>
    <div {{$bodyAttributes}}>
        {{$body}}
    </div>
</div>