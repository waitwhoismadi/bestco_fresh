@php
use App\Http\Controllers\HomeController;
@endphp
<div>

    <div class="filter-secs">
        <div class="filter-heading">
            <h3>Filters</h3>
            <a href="{{ route('jobs_list') }}" title="">Очистить все фильры</a>
        </div><!--filter-heading end-->
        <div class="paddy">
            <div class="filter">

                <form method="GET">
            <div class="filter-dd">
                <div class="filter-ttl">
                    <h3>Ключевое слово</h3>
                    <a href="{{ Request::query()?route('jobs_list',HomeController::remove_veriable_geturl(url()->full(),'keyword')):'#/' }}" title="">Очистить</a>
                </div>

                    <input type="text" name="keyword" placeholder="Ключевое слово для поиска" value="{{ Request::query('keyword') }}">

            </div>

            <div class="filter-dd">
                <div class="filter-ttl">
                    <h3>Навыки</h3>
                    <a href="{{ Request::query()?route('jobs_list',HomeController::remove_veriable_geturl(url()->full(),'skills')):'#/' }}" title="">Очистить</a>
                </div>

                    <input type="text" name="skills" placeholder="Поиск навыков" value="{{ Request::query('skills') }}">

            </div>
            <div class="filter-dd">
                <div class="filter-ttl">
                    <h3>Доступность</h3>
                    <a href="{{ Request::query()?route('jobs_list',HomeController::remove_veriable_geturl(url()->full(),'availabilty')):'#/' }}" title="">Очистить</a>
                </div>
                <ul class="avail-checks">

                    <li>
                            <input type="radio" name="availabilty" id="c1" value="full" {{ Request::query('availabilty')=='full'?'checked':'' }}>
                            <label for="c1">
                                <span></span>
                            </label>
                            <small>Полная оплата</small>
                        </li>

                        <li>
                            <input type="radio" name="availabilty" id="c2" value="hr" {{ Request::query('availabilty')=='hr'?'checked':'' }}>
                            <label for="c2">
                                <span></span>
                            </label>
                            <small>почасовая оплата</small>
                        </li>

                </ul>
            </div>

            <div class="filter-dd">
                <div class="filter-ttl">
                    <h3>Бюджет / ($)</h3>
                    <a href="{{ Request::query()?route('jobs_list',HomeController::remove_veriable_geturl(url()->full(),'budget')):'#/' }}" title="">Очистить</a>
                </div>
                <div class="rg-slider">

                    <input class="rn-slider slider-input" type="hidden" name="budget" value="{{ (Request::query('budget'))?Request::query('budget'):$minprice.','.$maxprice }}" />
                </div>
                <div class="rg-limit">
                    <h4>{{ $minprice?$minprice:1000 }}</h4>
                    <h4>{{ $maxprice?$maxprice:10000 }}</h4>
                </div><!--rg-limit end-->
            </div>


            <button class="btn btn-md btn-danger float-right rounded-pill" type="submit">Фильтр</button>
                </form>
            </div>
        </div>
    </div><!--filter-secs end-->
</div>

