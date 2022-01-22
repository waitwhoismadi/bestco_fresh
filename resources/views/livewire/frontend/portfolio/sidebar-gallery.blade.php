<div>
    <div class="widget widget-portfolio">
        <div class="wd-heady">
            <h3>Портфолио</h3>
            <img src="images/photo-icon.png" alt="">
        </div>
        <div class="pf-gallery">
            <ul>

               @foreach ($portfolios as $portfolio)
                <li><a href="{{ $portfolio->pf_link }}" title="{{ $portfolio->pf_name }}" target="_blank"><img src="{{ asset('storage/'.$portfolio->pf_file) }}" alt=""></a></li>
               @endforeach
            </ul>
        </div><!--pf-gallery end-->
    </div><!--widget-portfolio end-->
</div>
