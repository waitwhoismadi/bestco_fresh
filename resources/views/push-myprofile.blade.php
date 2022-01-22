
    <script>

        var coverimg = $('#coverimg');
        var coverimgupload = $('#coverimgupload');
        var coverimgbtn = $('#coverimgbtn');
        var coverimgload = $('#coverimgload');

            coverimgbtn.click(function () {

                coverimgupload.click();
            })

            coverimgupload.change(function (e){

                var image = e.target.files[0];

                var reader = new FileReader();
                     reader.readAsDataURL(image);
                    reader.onload = e => {
                        coverimg.attr('src',e.target.result);
                        // console.log(e.target.result);
                    }

                    coverimgbtn.hide();
                    coverimgload.show();
                var coverimgform = new FormData;
                coverimgform.append('cover_img',image)

                    $.ajax({
                    method: "POST",
                    url: "{{ url('api') }}/update-cover-img",
                    data: coverimgform,
                    processData: false,
                    contentType: false,

                    })
                    .done(function( data ) {
                        if(data.status=='success'){
                            flash_notification(data.msg,'success')
                        }
                        else{
                            flash_notification(data.msg,'error')
                        }
                        coverimgload.hide();
                        coverimgbtn.show();
                    });
            })


        $('#pf-file').change(function (e){
            var image = e.target.files[0];

            var reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e => {
            $('.pf-img img').attr('src',e.target.result);
        // console.log(e.target.result);
             }
        })

        $('.create_portfolio').submit(function(e){

              e.preventDefault();

              var pf_name = $('#pf-name').val();
              var pf_file = $('#pf-file').prop('files')[0];
              var pf_link = $('#pf-url').val();

              var form = new FormData;

              form.append('pf_name', pf_name);
              form.append('pf_link', pf_link);
              form.append('pf_file', pf_file);

              $.ajax({
                    method: "POST",
                    url: "{{ url('api') }}/upload_portfolio",
                    data: form,
                    processData: false,
                    contentType: false,

                    })
                    .done(function( data ) {
                        if(data.status=='success'){

                            if(data.response_data != null){
                                $('.gallery_pf .row').prepend(`
                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                    <div class="gallery_pt">
                                        <img src="{{ asset('storage/') }}/`+data.response_data.pf_file+`" alt="">
                                        <a href="`+data.response_data.pf_link+`" title="`+data.response_data.pf_name+`" target="_blank"><img src="{{ asset('images/all-out.png') }}" alt=""></a>
                                    </div><!--gallery_pt end-->
                                </div>
                                `);
                            }
                            flash_notification(data.response,'success');
                            $(".close-box").click();
                        }
                        else{
                            flash_notification(data.response,'error');
                        }
                        console.log(data);
                    })




        })

    </script>
