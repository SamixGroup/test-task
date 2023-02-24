@extends('layout.base')
@section('title', $id)
@section('content')
    @include('items.item',['items'=>$items])
    <script type="text/javascript">
        let collapses = document.getElementsByClassName('collapsable')
        for (let i = 0; i < collapses.length; i++) {
            collapses.item(i).addEventListener('click', setDisplay)
        }

        function setDisplay(e) {
            if (e.target.children[1].className === 'show') {
                e.target.children[1].className = 'hide'
                e.target.children[0].className = 'bi bi-caret-right-fill'
            } else {
                e.target.children[1].className = 'show'
                e.target.children[0].className = 'bi bi-caret-down-fill'
            }
            e.stopPropagation()
            // e.target.style.display = 'block';
        }
    </script>
@endsection

