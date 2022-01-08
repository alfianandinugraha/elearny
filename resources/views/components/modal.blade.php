@props(["body", "footer"])

@php
    $rootAttributes = $attributes->merge([
        'class' => 'modal fade',
        'role' => 'dialog',
        'tabindex' => '-1',
        'aria-hidden' => 'true'
    ]);

    $tag = $form ? 'form' : 'div';
@endphp

<div {{$rootAttributes}}>
    <div class="modal-dialog" role="document">
        <form class="modal-content" action="{{$action}}" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                @method($method)
                {{$body}}
            </div>
            <div class="modal-footer">{{$footer}}</div>
        </form>
    </div>
</div>