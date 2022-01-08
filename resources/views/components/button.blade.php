<?php
    $hasHref = $attributes->get('href');
    $classBtn = $variant ? "btn-$variant-$color" : "btn-$color";
    $tag = $hasHref ? 'a' : 'button'
?>
<{{$tag}} {{$attributes->merge([
    'class' => "btn $classBtn",
])}} />
    {{$slot}}
</{{$tag}}>