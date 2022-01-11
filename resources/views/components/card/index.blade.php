@props([
    'header',
    'body'
])

<?php
    $headerAttributes;

    if (!empty($header)) {
        $headerAttributes = $header->attributes->merge([
            'class' => 'card-header py-3 d-flex flex-row align-items-center'
        ]);
    }
    $bodyAttributes = $body->attributes->merge([
        'class' => 'card-body'
    ]);
?>

<div class="card shadow mb-4">
    @if(!empty($header))
    <div {{$headerAttributes}}>
        {{$header}}
    </div>
    @endif
    <div {{$bodyAttributes}}>
        {{$body}}
    </div>
</div>