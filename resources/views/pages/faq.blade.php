@extends('master')
@section('body')
<div class="container">
    <div class="row">
        <div class="col-12 py-4">
            @for ($i = 0; $i < sizeof($all); $i++)
                <div class="faq-box">
                    <div class="upper">
                        <h5 class="p-0 m-0">{{ $i+1 }}. {{ $all[$i]->title }}</h5>
                        <button class="btn btn-faq" type="button">
                            <svg width="14" height="7" viewBox="0 0 14 7" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.23256 6.2203L6.98656 6.9237L13.0216 1.29373L12.2676 0.590332L6.98656 5.5169L1.73056 0.613654L0.976562 1.31705L3.98956 4.12783L6.23256 6.2203Z" fill="#000"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="desc" style="display: none">
                        <p><b>Ans : </b>{{ $all[$i]->description }}</p>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $('.btn-faq').click(function (e) {
            e.preventDefault();
            var vc = $(this).closest('.faq-box').find('.desc');
            if(!$(this).hasClass('btn-roted')){
                $(this).addClass('btn-roted');
                vc.slideDown(300);
            }else{
                $(this).removeClass('btn-roted');
                vc.slideUp(300);
            }
        });
    </script>
@endsection
