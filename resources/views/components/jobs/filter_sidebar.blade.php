@php
use App\Http\Controllers\HomeController;
@endphp
<div>

    <div class="filter-secs">
        <div class="filter-heading">
            <h3>Filters</h3>
            <a href="{{ route('jobs_list') }}" title="">Очистить все фильтры</a>
        </div><!--filter-heading end-->
        <div class="paddy">
            <div class="filter">

                <form method="GET">
            <div class="filter-dd">
                <div class="filter-ttl">
                    <h3>Keyword</h3>
                    <a href="{{ Request::query()?route('jobs_list',HomeController::remove_veriable_geturl(url()->full(),'keyword')):'#/' }}" title="">Очистить</a>
                </div>

                    <input type="text" name="keyword" placeholder="Ключевое слово для поиска" value="{{ Request::query('keyword') }}">

            </div>

            <div class="filter-dd">
                <div class="filter-ttl">
                    <h3>Навыки</h3>
                    <a href="{{ Request::query()?route('jobs_list',HomeController::remove_veriable_geturl(url()->full(),'skills')):'#/' }}" title="">Clear</a>
                </div>

                    <input type="text" name="skills" placeholder="Поиск навыков" value="{{ Request::query('skills') }}">

            </div>
            <div class="filter-dd">
                <div class="filter-ttl">
                    <h3>Доступность</h3>
                    <a href="{{ Request::query()?route('jobs_list',HomeController::remove_veriable_geturl(url()->full(),'availabilty')):'#/' }}" title="">Очистить</a>
                </div>
                <ul class="avail-checks">

                    @foreach(App\job_type::all() as $key => $job_type)
                        <li>
                            <input type="radio" name="availabilty" id="c{{ $key }}" value="{{ $job_type->id }}" {{ Request::query('availabilty')==$job_type->id?'checked':'' }}>
                            <label for="c{{ $key }}">
                                <span></span>
                            </label>
                            <small>{{ $job_type->type }}</small>
                        </li>
                    @endforeach

                </ul>
            </div>

            <div class="filter-dd">
                <div class="filter-ttl">
                    <h3>Зарплата / ($)</h3>
                    <a href="{{ Request::query()?route('jobs_list',HomeController::remove_veriable_geturl(url()->full(),'salary')):'#/' }}" title="">Очистить</a>
                </div>
                <div class="rg-slider">

                    <input class="rn-slider slider-input" type="hidden" name="salary" value="{{ (Request::query('salary'))?Request::query('salary'):$minprice.','.$maxprice }}" />
                </div>
                <div class="rg-limit">
                    <h4>{{ $minprice?$minprice:1000 }}</h4>
                    <h4>{{ $maxprice?$maxprice:10000 }}</h4>
                </div><!--rg-limit end-->
            </div>

            <div class="filter-dd">
                <div class="filter-ttl">
                    <h3>Расположение</h3>
                    <a href="{{ Request::query()?route('jobs_list',HomeController::remove_veriable_geturl(url()->full(),'location')):'#/' }}" title="">Clear</a>
                </div>
                <input type="text" name="location" placeholder="Поиск Города" value="{{ Request::query('location') }}">
            </div>

            <button class="btn btn-md btn-danger float-right rounded-pill" type="submit">Фильтр</button>
                </form>
            </div>
        </div>
    </div><!--filter-secs end-->
</div>

