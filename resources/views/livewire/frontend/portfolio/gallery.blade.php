<div>
    <div class="portfolio-gallery-sec">
        <h3>Portfolio</h3>
        @if (Route::currentRouteName() == 'user_dashboard.profile' || Route::currentRouteName() == 'company_dashboard.profile')
        <div class="portfolio-btn">
            <a href="#/" title=""><i class="fas fa-plus-square"></i> Добавить портфолио</a>
        </div>
        @endif

        <div class="gallery_pf">
            <div class="row">

                @foreach($portfolios as $key => $portfolio)
                @if ($delete_portfolio !== $portfolio)
                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                    <div class="gallery_pt">
                        <img src="{{ asset('storage/'.$portfolio->pf_file) }}" alt="">
                        <a href="{{ $portfolio->pf_link }}" title="{{ $portfolio->pf_name }}" target="_blank"><img src="{{ asset('images/all-out.png') }}" alt=""></a>
                    @if (Route::currentRouteName() == 'user_dashboard.profile' || Route::currentRouteName() == 'company_dashboard.profile')
                    <a class="delete-portfolio" href="#/" wire:click="delete_portfolio({{ $portfolio->id }})">Delete</a>
                    @endif

                    </div><!--gallery_pt end-->
                </div>
                @endif

                @endforeach



            </div>
        </div><!--gallery_pf end-->
    </div><!--portfolio-gallery-sec end-->
</div>

@push('styles')
    <style>
        .delete-portfolio{
            top: 118px !important;
    font-weight: bold;
    background: #fff;
    color:rgb(196, 3, 3);
    padding: 8px 0px;
        }
    </style>
@endpush


