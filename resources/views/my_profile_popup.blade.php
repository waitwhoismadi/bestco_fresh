<!-------------------about popup-------------------->

<div class="overview-box" id="overview-box">
    <div class="overview-edit">
                <h3>Обзор </h3>
        {{-- <span>5000 символов</span> --}}
        <form id="about_form">
            <textarea placeholder="Something about Yourself..." id="about_input"></textarea>
            <button type="submit" class="save">Сохранить</button>
        </form>

        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
    </div><!--overview-edit end-->
</div><!--overview-box end-->


<!---------------experience popup-------------------->

<div class="overview-box" id="experience-box">
    <div class="overview-edit">
        <h3>Опыт</h3>
        <form class="experience-form submit_experience">
            <input type="text" name="subject" placeholder="Тема" id="experience_title">
            <div class="experience_title-error">
            </div>
            <textarea id="experience_detail"></textarea>
            <div class="experience_detail-error">
            </div>
            <button type="submit" class="save">Сохранить</button>

        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
    </div><!--overview-edit end-->
</div><!--overview-box end-->

<!---------------category popup-------------------->

<div class="overview-box" id="category-box">
    <div class="overview-edit">
        <h3>Категория</h3>
        <form class="category-form submit_category">
            {{-- <input type="text" name="category_name" placeholder="Название категории" id="category_name"> --}}
            <select name="category_name" class="{{ $errors->first('category')?'is_invaild':'' }}" id="category_name">
                <option value="">Категория</option>
                @php
                    $user_categories = App\user_categories::all();
                @endphp
                @foreach($user_categories as $key => $user_category)
                <option value="{{ $user_category->id }}">{{ $user_category->category_name }}</option>
                @endforeach
            </select>
            <div class="category_name-error">
            </div>

            <button type="submit" class="save">Сохранить</button>

        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
    </div><!--overview-edit end-->
</div><!--overview-box end-->


<!---------------education popup-------------------->

<div class="overview-box" id="education-box">
    <div class="overview-edit">
        <h3>Education</h3>
        <form class="submit_education">
            <input type="text" name="institute" placeholder="Школа / Университет" id="institute">
            <div class="datepicky">
                <div class="row">
                    <div class="col-lg-6 no-left-pd">
                        <div class="datefm">
                            <input type="text" name="from" placeholder="От" class="datepicker" id="education_from">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                    <div class="col-lg-6 no-righ-pd">
                        <div class="datefm">
                            <input type="text" name="to" placeholder="До" class="datepicker" id="education_to">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
            <input type="text" name="degree" placeholder="Степень" id="degree">
            <div class="education_degree-error">
            </div>
            <textarea placeholder="Описание" id="education_detail"></textarea>
            <div class="education_detail-error">
            </div>
            <button type="submit" class="save">Сохранить</button>

        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
    </div><!--overview-edit end-->
</div><!--overview-box end-->


<!---------------location popup-------------------->

<div class="overview-box" id="location-box">
    <div class="overview-edit">
        <h3>Местоположение</h3>
        <form class="submit_location">
            <div class="datefm">
                <select id="country">
                    <option value="">Страна</option>
                    @foreach (App\location\Country::orderBy('name','Asc')->get() as $country)
                        <option value="{{ $country->id }}" {{ $country->id == '101'?'selected':'' }}>{{ $country->name }}</option>
                    @endforeach
                </select>
                <i class="fa fa-globe"></i>
            </div>
            <div class="datefm">
                <select id="state">
                    <option value="">Штат</option>
                    @foreach (App\location\State::where('country_id','101')->orderBy('name','Asc')->get() as $country)
                    <option value="{{ $country->id }}" {{ $country->id == '101'?'selected':'' }}>{{ $country->name }}</option>
                @endforeach
                </select>
                <i class="fa fa-map-marker"></i>
            </div>
            <div class="datefm">
                <select id="city">
                    <option value="">Город</option>

                </select>
                <i class="fa fa-map-marker"></i>
                <div class="location-city-error">

                </div>
            </div>
            <div class="datefm">
                <input type="text" id="address" placeholder="Адрес">
                <i class="fa fa-map-pin"></i>
            </div>
            <button type="submit" class="save">Сохранить</button>
            <button type="submit" class="cancel">Отмена</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
    </div><!--overview-edit end-->
</div><!--overview-box end-->


<!---------------skills popup-------------------->

<div class="overview-box" id="skills-box">
    <div class="overview-edit">
        <h3>Skills</h3>

        <form class="submit_skill">
            <input type="text" name="skills" placeholder="Навыки" id="new_skill">
            <div class="skill-error"></div>
            <button type="submit" class="save">Сохранить</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
    </div><!--overview-edit end-->
</div><!--overview-box end-->


<!---------------establish popup-------------------->

<div class="overview-box" id="establish-box">
    <div class="overview-edit">
        <h3>Основано</h3>
        <form class="submit_establish">
            <div class="daty">
                <input type="text" name="establish" placeholder="Выберите дату" class="datepicker" id="establish_input" required>
                <i class="fa fa-calendar"></i>
            </div>
            <button type="submit" class="save">Сохранить</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
    </div><!--overview-edit end-->
</div><!--overview-box end-->


<!---------------employee popup-------------------->

<div class="overview-box" id="total-employes">
    <div class="overview-edit">
        <h3>Общее количество сотрудников</h3>
        <form>
            <input type="text" name="employes" placeholder="Введите число">
            <button type="submit" class="save">Сохранить</button>
            <button type="submit" class="cancel">Отмена</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
    </div><!--overview-edit end-->
</div><!--overview-box end-->

<!---------------portfolio popup-------------------->

<div class="overview-box" id="create-portfolio">
    <div class="overview-edit">
        <h3>Создать портфолио</h3>
        <form class="create_portfolio" method="POST" name="create_portfolio">
            <input type="text" name="pf-name" id="pf-name" placeholder="Название портфолио">
            <div class="file-submit">
                <input type="file" id="pf-file" class="d-block" style="opacity: 1;">
                <label for="pf-file">Выберите файл</label>
            </div>
            <div class="pf-img">
                <img src="{{ asset('images/resources/np.png') }}" alt="" style="width:100px">
            </div>
            <input type="text" name="website-url" id="pf-url" placeholder="htp://www.example.com">
            <button type="submit" class="save">Сохранить</button>
            <button type="submit" class="cancel" onclick="$('.close-box').click()">Отмена</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
    </div><!--overview-edit end-->
</div><!--overview-box end-->



@push('scripts')
    <script>
        function edit_about(about){
            $('#about_input').val(about);
        }

        $('#about_form').submit(function(e){

            e.preventDefault();
            var about_input = $('#about_input').val();

            $.ajax({
                url:"{{ route('update_about') }}",
                type:"POST",
                data:{about:about_input}
            })
            .done(function(data){

                if(data.status == 'success'){

                    flash_notification(data.response,'success');
                    $('#about-content').html(about_input)
                    $(".close-box").click();
                }
                else{
                    flash_notification(data.response,'error')
                }
            })
        })

        function edit_experience(type,experience) {

            $('.submit_experience').attr('data-type',type)
            if(type == 'existing'){
                $('#experience_title').val(experience.title);
                $('#experience_detail').val(experience.detail);
                $('.submit_experience').attr('data-experience_id',experience.id)
            }
        }

        $('.submit_experience').submit( function (e){
            e.preventDefault();


           var title = $('#experience_title').val();
           var detail = $('#experience_detail').val();

            if($(this).data('type') == 'new'){
                var url = "{{ route('add_experience') }}";
                var method = "POST";
            }
            else{
                var url = "{{ url('api') }}/update-experience/"+$(this).data('experience_id');
                var method = "PUT";
            }

            $.ajax({
                url:url,
                type:method,
                data:{'title':title,'detail':detail}
            })
            .done(function (data){
                if(data.status == 'success'){

                    flash_notification(data.response,'success');
                    setTimeout(function() {
                    location.reload(true);
                    }, 1000);
                }
                else{

                    flash_notification(data.response,'error')
                }
            })
            .fail(function(error){
                var errors = error.responseJSON.errors;

                    if(errors.title){
                        $('.experience_title-error').addClass('text-danger');
                        $('.experience_title-error').html(errors.title);
                    }
                    if(errors.detail){
                        $('.experience_detail-error').addClass('text-danger');
                        $('.experience_detail-error').html(errors.title);
                    }
            })
        })

        $('.delete_experience').click( function (e) {

            swal({
                title: "Are you sure?",
                text: "Are you sure, You want to delete Experience!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {

                    if (willDelete) {
                        $.ajax({
                            method:'DELETE',
                            url:'{{ url("/api") }}/delete-experience/'+$(this).data('experience')
                        })
                        .done(function (data) {
                            $('#experience'+data).hide();
                            flash_notification('Delete feed Successfully!','success');
                        })
                    }

                })
        })

        function edit_education(type,education) {

            $('.submit_education').attr('data-type',type)
            if(type == 'existing'){
                $('#institute').val(education.institute);
                $('#education_from').val(education.from);
                $('#education_to').val(education.to);
                $('#degree').val(education.degree);
                $('#education_detail').val(education.detail);
                $('.submit_education').attr('data-education_id',education.id)
            }
        }

        $('.submit_education').submit( function (e){
            e.preventDefault();


           var institute = $('#institute').val();
           var from = $('#education_from').val();
           var to = $('#education_to').val();
           var degree = $('#degree').val();
           var detail = $('#education_detail').val();

            if($(this).data('type') == 'new'){
                var url = "{{ route('add_education') }}";
                var method = "POST";
            }
            else{
                var url = "{{ url('api') }}/update-education/"+$(this).data('education_id');
                var method = "PUT";
            }

            $.ajax({
                url:url,
                type:method,
                data:{'institute':institute,'from':from,'to':to,'degree':degree,'detail':detail}
            })
            .done(function (data){

                if(data.status == 'success'){

                    flash_notification(data.response,'success');
                    setTimeout(function() {
                    location.reload(true);
                    }, 1000);
                }
                else{

                    flash_notification(data.response,'error')
                }
            })
            .fail(function(error){
                var errors = error.responseJSON.errors;

                    if(errors.degree){
                        $('.education_degree-error').addClass('text-danger');
                        $('.education_degree-error').html(errors.degree);
                    }
                    if(errors.detail){
                        $('.education_detail-error').addClass('text-danger');
                        $('.education_detail-error').html(errors.detail);
                    }
            })
        })

        $('.delete_education').click( function (e) {

            swal({
            title: "Are you sure?",
            text: "Are you sure, You want to delete Education!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {

                if (willDelete) {
                    $.ajax({
                        method:'DELETE',
                        url:'{{ url("/api") }}/delete-education/'+$(this).data('education')
                    })
                    .done(function (data) {
                        $('#education'+data).hide();
                        flash_notification('Delete feed Successfully!','success');
                    })
                }

            })
        })


        function edit_location(city,state,country,address) {
            $('#country').attr('data-current_country',city);
            $('#state').attr('data-current_state',state);
            $('#city').attr('data-current_city',city);
            $('#address').val(address);

            select_country();
            $('#country').change();
            $('#state').change();

        }

        function select_country() {

           var current_country = $('#country').data('current_country');

                $( "#country option" ).each(function( index, data ) {
                    if(data.value == current_country){
                        $(this).attr('selected','selected');
                    }
                });
        }

        $('#country').change(function (e) {
            if($(this).val()){
            var country = $(this).val();
            }
            else{
            var country = $('#country').data('current_country');
            }

            $.ajax({
                url:'{{ url('api') }}/states/'+country,
                type:'GET'
            })
            .done(function(data){

                $('#state').html('<option value="">State</option>');
                $('#city').html('<option value="">City</option>');
                $.each(data,function(key, state){

                    if($('#state').data('current_state')== state.id){
                        var selected = 'selected';
                    }
                    else{
                        var selected = '';
                    }
                    $('#state').append(`
                        <option value="`+state.id+`" `+selected+`>`+state.name+`</option>
                    `);
                })
            })
        })

        $('#state').change(function (e) {
            if($(this).val()){
            var state = $(this).val();
            }
            else{
            var state = $('#state').data('current_state');
            }

            $.ajax({
                url:'{{ url('api') }}/cities/'+state,
                type:'GET'
            })
            .done(function(data){
                $('#city').html('<option value="">City</option>');
                $.each(data,function(key, city){

                    if($('#city').data('current_city')== city.id){
                        var selected = 'selected';
                    }
                    else{
                        var selected = '';
                    }

                    $('#city').append(`
                        <option value="`+city.id+`" `+selected+`>`+city.name+`</option>
                    `);
                })

            })
        })

        $('.submit_location').submit(function (e) {
            e.preventDefault();

            var city = $('#city').val();
            var address = $('#address').val();

            $.ajax({
                url:'{{ url("/api") }}/update-location',
                type:'POST',
                data:{'city':city,'address':address}
            })
            .done(function (data) {
                if(data.status == 'success'){

                    $('#location_section').html(data.responsedata);
                    flash_notification(data.response,'success');
                    $(".close-box").click();
                }
                else{
                    var errors = data.errors;

                    if(errors.city){
                        $('.location-city-error').addClass('text-danger');
                        $('.location-city-error').html(errors.city);
                    }

                    flash_notification(data.response,'error');
                }
            })
        })

        $('.submit_skill').submit(function (e) {

           e.preventDefault();

           var skill = $('#new_skill').val();

           $.ajax({
               url:"{{ url('api') }}/add-skill",
               type:'post',
               data:{skill:skill}
           })
           .done(function (data) {
            if(data.status == 'success'){

                $('.skills-list').append(`
                <li id="skillid`+data.skill.id+`">
                    <a href="javascript:void(0)" class="skl-name">`+data.skill.skill+`</a>
                    <a href="javascript:void(0)" class="close-skl" data-skill="`+data.skill.id+`"><i class="la la-close"></i></a>
                </li>
                `);
                flash_notification(data.response,'success');
                $("#new_skill").val('');
                }
                else{
                var errors = data.errors;

                if(errors.skill){
                    $('.skill-error').addClass('text-danger');
                    $('.skill-error').html(errors.skill);
                }

                flash_notification(data.response,'error');
                }
           })
        })

        $('.close-skl').click(function (e) {

            var skillid = $(this).data('skill');
            $.ajax({
                url:"{{ url('api') }}/delete-skill/"+$(this).data('skill'),
                type:"DELETE"
            })
            .done(function (data) {
                if(data.status == 'success'){
                    $('#skillid'+skillid).hide();

                    flash_notification('Skill Deleted Successfully','success');
                }
                else{
                    flash_notification('Skill Deleted Failed','error');
                }
            })
        })

        $('.submit_establish').submit(function (e) {
            e.preventDefault();

            var date = $('#establish_input').val();

            if(date == null){
                flash_notification('Please Select Date','error');

            }
            else{

            $.ajax({
                url:"{{ url('api') }}/update-establish_since",
                type:"POST",
                data:{date:date}
            })
            .done(function (data) {
                if(data.status == 'success'){
                    flash_notification(data.response,'success');
                    $('#establish_date').attr('establish',data.establish.establish_date);
                    $('#establish_date').html("{{ date('F,Y'),strtotime("+data.establish.establish_date+") }}");
                    $(".close-box").click();
                }
                else{
                    flash_notification(data.response,'error');
                }
            })
            }
        })


        $('.submit_category').submit( function (e){
            e.preventDefault();


           var category_name = $('#category_name').val();


                var url = "{{ route('update_category') }}";
                var method = "POST";


            $.ajax({
                url:url,
                type:method,
                data:{'category_name':category_name}
            })
            .done(function (data){
                if(data.status == 'success'){

                    $('.usercat h4 span').html(data.category.category_name);
                    $(".cat-box-open").attr('data-category',data.category.id);
                    flash_notification(data.response,'success');
                    $(".close-box").click();
                }
                else{

                    flash_notification(data.response,'error')
                }
            })
            .fail(function(error){
                var errors = error.responseJSON.errors;

                    if(errors.category_name){
                        $('.category_name-error').addClass('text-danger');
                        $('.category_name-error').html(errors.title);
                    }
            })
        })
    </script>
@endpush
