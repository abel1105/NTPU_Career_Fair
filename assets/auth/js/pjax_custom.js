$.fn.bindPJAX = {}; // Create namespace

function bindPJAX(functionName) {
    // Check function existence, then call it
    $().bindPJAX['all']();
    return $().bindPJAX[functionName] && $().bindPJAX[functionName]();
}
$(document).ready(function(){
    if ($.support.pjax) {
        $(document).on('click', 'a[data-pjax]', function(event) { //
            var container = '.pjax-container';
            var emptyRoute = 'feed'; // The function that will be called on domain's root

            // Store current href without domain
            var link = event.currentTarget.href.replace(/^.*\/\/[^\/]+\//, '').replace(/career\/auth\//, '').replace(/\/[0-9]+/, '/id').replace(/[0-9]+\//,'').replace(/\//, '_').replace(/\?.*/, '');
            var target = link === "" ? emptyRoute : link;
            console.log(target);

            // Bind href-specific asynchronous initialization
            $(document).on('ready pjax:success', container, function() {
                bindPJAX(target); // Call initializers
                $(document).off('ready pjax:success', container); // Unbind initialization
            });

            // PJAX-load the new content
            $.pjax.click(event, {container: $(container)});
            event.stopPropagation();

        });
    }
});
$.extend($.fn.bindPJAX, {
    all: function(){
        Dropzone.autoDiscover = false;
        $('[data-toggle="tooltip"]').tooltip();
        console.log('trigger all');
    },
    dashboard: function(){
        var start = 0;
        $('.loadmoreimg').on('click', function(){
            $.ajax({
                url: '/career/auth/file/images/'+start,
                success: function(data){
                    start += data.files.length;
                    for(var i=0; i<data.files.length; i++){
                        $('.gallery-img').last().after("<div class='gallery-img' style='background-image:url('"+ data.files[i].url + "')'></div>");
                    }
                }
            });
        });

        $('.save').on('click', function(){
            var count = 0,$json;
            $('form#fair-set select,form#fair-set input[type!="hidden"]').each(function(){
                if(count == 0){
                    $json = '"'+$(this).attr('name') +'":"'+ $(this).val()+'"';
                }else{
                    $json += ',"'+$(this).attr('name') +'":"'+ $(this).val()+'"';
                }
                count++;
            });
            $json = "{"+$json+"}";
            $('input[name="value"]').val($json);
            $('#fair-set').submit();
        });
    },
    fair_create: function(){
        $("#createlogo").dropzone({
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            maxFilesize: 5,
            parallelUploads: 1,
            acceptedFiles: 'image/*',
            // Dropzone settings
            init: function() {
                var myDropzone = this;

                this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                this.on('success', function(file,data){
                    $("input[edit-logo]").val(data['url']);
                })
            }
        });
        $("#updatelogo").dropzone({
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            maxFilesize: 5,
            parallelUploads: 1,
            acceptedFiles: 'image/*',
            // Dropzone settings
            init: function() {
                var myDropzone = this;
                this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                this.on('success', function(file,data){
                    $("input[update-logo]").val(data['url']);
                })
            }
        });
        $('select[name=year]').on('change', function(){
            $nowUpdateYear = $('select[name=year]').val();
            $nowUpdateName = $('option[value='+$nowUpdateYear+']').attr('data-name');
            $nowUpdateLogo = $('option[value='+$nowUpdateYear+']').attr('data-logo');

            $('input[update-name]').val($nowUpdateName);
            $('input[update-logo]').val($nowUpdateLogo);
        });
        $('select[name=year]').trigger('change');
    },
    post_create: function(){
        $("#uploadimagePC").dropzone({
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 10,
            maxFilesize: 5,
            parallelUploads: 1,
            acceptedFiles: 'image/*',
            // Dropzone settings
            init: function() {
                var myDropzone = this;

                this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });

                this.on('success', function(file,data){
                    CKEDITOR.instances.editor.insertHtml('<img src="'+data['url']+'" style="width:500px;"/>');
                })
            }
        });
        $('.save').on('click', function() {
            $count = 0;
            $('input[required], textarea[required]').each(function () {
                if ($(this).val() == '') {
                    toastr.error($(this).attr('placeholder') + ' 尚未填寫');
                    $count++;
                }
            });
            if ($count == 0) {
                $('#post_form').submit();
            }
        });
    },
    post: function(){
        $('.post-status').submit(function(e){
            e.preventDefault();
            var token = $( this ).find( 'input[name=_token]' ).val();
            var id = $( this ).find( 'input[name=id]' ).val();
            var url = $(this).prop('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    '_token':  token,
                    'id':  id
                },
                success: function(data){
                    var status = data['status'];
                    if(status == 'active')
                    {
                        $('button.status_'+id).removeClass('btn-warning').addClass('btn-primary').text('顯示');
                    }
                    else if(status == 'inactive')
                    {
                        $('button.status_'+id).removeClass('btn-primary').addClass('btn-warning').text('隱藏');
                    }
                }
            },'json');
            return false;
        });
        $('.delete-post').submit(function(e){
            e.preventDefault();
            var token = $( this ).find( 'input[name=_token]' ).val();
            var id = $( this ).find( 'input[name=id]' ).val();
            var title = $( this ).find( 'input[name=title]' ).val();
            var url = $(this).prop('action');
            swal({
                    title: "您確定要刪除？",
                    text: "您將無法回復刪除",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#ed5565",
                    confirmButtonText: "是，請刪除!",
                    cancelButtonText: "否，取消！",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                '_token':  token,
                                'id':  id
                            },
                            success: function(data){
                                var status = data['status'];
                                var msg = data['msg'];
                                if(status == 'success')
                                {
                                    swal("刪除", "公告："+title+"已刪除", "success");
                                    $('.post_'+id).remove();
                                }
                                else
                                {
                                    swal.close();
                                    toastr.error(msg);
                                }
                            }
                        },'json');
                    } else {
                        swal("取消刪除", "您的公告尚未被刪除：)", "error");
                    }
                });
        });

    },
    post_id: function(){
        $("#uploadimagePI").dropzone({
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 10,
            maxFilesize: 5,
            parallelUploads: 1,
            acceptedFiles: 'image/*',
            // Dropzone settings
            init: function() {
                var myDropzone = this;

                this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });

                this.on('success', function(file,data){
                    CKEDITOR.instances.editor.insertHtml('<img src="'+data['url']+'" style="width:500px;"/>');
                })
            }
        });
        $('.save').on('click', function() {
            $count = 0;
            $('input[required], textarea[required]').each(function () {
                if ($(this).val() == '') {
                    toastr.error($(this).attr('placeholder') + ' 尚未填寫');
                    $count++;
                }
            });
            if ($count == 0) {
                $('#post_form').submit();
            }
        });
    },
    lecture_create:function(){
        $("#uploadimageLC").dropzone({
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 10,
            maxFilesize: 5,
            parallelUploads: 1,
            acceptedFiles: 'image/*',
            // Dropzone settings
            init: function() {
                var myDropzone = this;

                this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });

                this.on('success', function(file,data){
                    CKEDITOR.instances.editor.insertHtml('<img src="'+data['url']+'" style="width:500px;"/>');
                })
            }
        });
        $('.save').on('click', function(){
            $count = 0;
            $('input[required]').each(function(){
                if($(this).val() == '') {
                    toastr.error($(this).attr('placeholder')+' 尚未填寫');
                    $count++;
                }
            });
            if($count==0){
                $('#lecture_form').submit();
            }
        });
        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            todayHighlight: true,
            language: 'tw',
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $('.clockpicker').clockpicker();
    },
    lecture_id: function(){
        $("#uploadimageLI").dropzone({
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 10,
            maxFilesize: 5,
            parallelUploads: 1,
            acceptedFiles: 'image/*',
            // Dropzone settings
            init: function() {
                var myDropzone = this;

                this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });

                this.on('success', function(file,data){
                    CKEDITOR.instances.editor.insertHtml('<img src="'+data['url']+'" style="width:500px;"/>');
                })
            }
        });
        $('.save').on('click', function(){
            $count =0;
            $('input[required]').each(function(){
                if($(this).val() == '') {
                    toastr.error($(this).attr('placeholder')+' 尚未填寫');
                    $count++;
                }
            });
            if($count==0){
                $('#lecture_form').submit();
            }
        });
        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            todayHighlight: true,
            language: 'tw',
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $('.clockpicker').clockpicker();
    },
    lecture: function(){
        $('.delete-lecture').submit(function(e){
            e.preventDefault();
            var token = $( this ).find( 'input[name=_token]' ).val();
            var id = $( this ).find( 'input[name=id]' ).val();
            var title = $( this ).find( 'input[name=title]' ).val();
            var url = $(this).prop('action');
            swal({
                    title: "您確定要刪除？",
                    text: "您將無法回復刪除",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#ed5565",
                    confirmButtonText: "是，請刪除!",
                    cancelButtonText: "否，取消！",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                '_token':  token,
                                'id':  id
                            },
                            success: function(data){
                                var status = data['status'];
                                var msg = data['msg'];
                                if(status == 'success')
                                {
                                    swal("刪除", "活動："+title+" 已刪除", "success");
                                    $('.lecture_'+id).remove();
                                }
                                else
                                {
                                    swal.close();
                                    toastr.error(msg);
                                }
                            }
                        },'json');
                    } else {
                        swal("取消刪除", "您的活動尚未被刪除：)", "error");
                    }
                });
        });
    },
    link: function(){
        $('.delete-link').submit(function(e){
            e.preventDefault();
            var token = $( this ).find( 'input[name=_token]' ).val();
            var id = $( this ).find( 'input[name=id]' ).val();
            var name = $( this ).find( 'input[name=name]' ).val();
            var url = $(this).prop('action');
            swal({
                    title: "您確定要刪除？",
                    text: "您將無法回復刪除",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#ed5565",
                    confirmButtonText: "是，請刪除!",
                    cancelButtonText: "否，取消！",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                '_token':  token,
                                'id':  id
                            },
                            success: function(data){
                                var status = data['status'];
                                var msg = data['msg'];
                                if(status == 'success')
                                {
                                    swal("刪除", "連結："+name+" 已刪除", "success");
                                    $('.link_'+id).remove();
                                }
                                else
                                {
                                    swal.close();
                                    toastr.error(msg);
                                }
                            }
                        },'json');
                    } else {
                        swal("取消刪除", "您的活動尚未被刪除：)", "error");
                    }
                });
        });
    },
    link_create: function(){
        $('.save').on('click', function(){
            $count =0
            $('input[required]').each(function(){
                if($(this).val() == '') {
                    toastr.error($(this).attr('placeholder')+' 尚未填寫');
                    $count++;
                }
            })
            if($count==0){
                $('#link_form').submit();
            }
        });
        $("#uploadimg").dropzone({

            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            maxFilesize: 5,
            parallelUploads: 1,
            acceptedFiles: 'image/*',

            // Dropzone settings
            init: function() {
                var myDropzone = this;

                this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                this.on('success', function(file,data){
                    $("input[name=img]").val(data['url']);
                })
            }

        });
    },
    link_id: function(){
        $('.save').on('click', function(){
            $count =0;
            $('input[required]').each(function(){
                if($(this).val() == '') {
                    toastr.error($(this).attr('placeholder')+' 尚未填寫');
                    $count++;
                }
            });
            if($count==0){
                console.log('shit');
                $('#link_form').submit();
            }
        });
        $("#uploadimg").dropzone({

            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            maxFilesize: 5,
            parallelUploads: 1,
            acceptedFiles: 'image/*',

            // Dropzone settings
            init: function() {
                var myDropzone = this;

                this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                this.on('success', function(file,data){
                    $("input[name=img]").val(data['url']);
                    $("img.img").attr('src',data['url']);
                })
            }

        });
    },
    partner: function(){
        $('.partner-status').submit(function(e){
            e.preventDefault();
            var token = $( this ).find( 'input[name=_token]' ).val();
            var id = $( this ).find( 'input[name=id]' ).val();
            var url = $(this).prop('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    '_token':  token,
                    'id':  id
                },
                success: function(data){
                    var status = data['status'];
                    if(status == 'active')
                    {
                        $('button.status_'+id).removeClass('btn-warning').addClass('btn-primary').text('顯示');
                    }
                    else if(status == 'inactive')
                    {
                        $('button.status_'+id).removeClass('btn-primary').addClass('btn-warning').text('隱藏');
                    }
                }
            },'json');
            return false;
        });
        $('.delete-partner').submit(function(e){
            e.preventDefault();
            var token = $( this ).find( 'input[name=_token]' ).val();
            var id = $( this ).find( 'input[name=id]' ).val();
            var company = $( this ).find( 'input[name=company]' ).val();
            var url = $(this).prop('action');
            swal({
                    title: "您確定要刪除？",
                    text: "您將無法回復刪除",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#ed5565",
                    confirmButtonText: "是，請刪除!",
                    cancelButtonText: "否，取消！",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                '_token':  token,
                                'id':  id,
                                'company': company
                            },
                            success: function(data){
                                var status = data['status'];
                                var msg = data['msg'];
                                if(status == 'success')
                                {
                                    swal("刪除", "公司："+company+" 已刪除", "success");
                                    $('.partner_'+id).remove();
                                }
                                else
                                {
                                    swal.close();
                                    toastr.error(msg);
                                }
                            }
                        },'json');
                    } else {
                        swal("取消刪除", "您的職缺尚未被刪除：)", "error");
                    }
                });
        });
    },
    partner_create: function(){
        $('.save').on('click', function(){
            $count =0
            $('input[required]').each(function(){
                if($(this).val() == '') {
                    toastr.error($(this).attr('placeholder')+' 尚未填寫');
                    $count++;
                }
            })
            if($count==0){
                $('#partner_form').submit();
            }
        });
        $("#uploadimg").dropzone({

            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            maxFilesize: 5,
            parallelUploads: 1,
            acceptedFiles: 'image/*',

            // Dropzone settings
            init: function() {
                var myDropzone = this;

                this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                this.on('success', function(file,data){
                    $("input[name=img]").val(data['url']);
                })
            }
        });
        $("#uploadfile").dropzone({
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            maxFilesize: 5,
            parallelUploads: 1,
            acceptedFiles: 'application/*',

            // Dropzone settings
            init: function() {
                var myDropzone = this;

                this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                this.on('success', function(file,data){
                    $("input[name=link]").val(data['url']);
                })
            }
        });
    },
    partner_id: function(){
        $('.save').on('click', function(){
            $count =0;
            $('input[required]').each(function(){
                if($(this).val() == '') {
                    toastr.error($(this).attr('placeholder')+' 尚未填寫');
                    $count++;
                }
            });
            if($count==0){
                console.log('shit');
                $('#partner_form').submit();
            }
        });
        $("#uploadimg").dropzone({

            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            maxFilesize: 5,
            parallelUploads: 1,
            acceptedFiles: 'image/*',

            // Dropzone settings
            init: function() {
                var myDropzone = this;

                this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                this.on('success', function(file,data){
                    $("input[name=img]").val(data['url']);
                    $("img.img").attr('src',data['url']);
                })
            }
        });
        $("#uploadfile").dropzone({
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            maxFilesize: 5,
            parallelUploads: 1,
            acceptedFiles: 'application/*',

            // Dropzone settings
            init: function() {
                var myDropzone = this;

                this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                this.on('success', function(file,data){
                    $("input[name=link]").val(data['url']);
                })
            }
        });
    },
    category: function(){
        $('.modal .infont a').bind('click', function(){
            fontawesome = $(this).find('i').attr('class').substring(3);
            $('#icon_modal').modal('hide');
            $('#select-icon').find('i').remove();
            $('#select-icon .preview').append('<i class="fa ' + fontawesome + '" style="font-size:30px; margin-left: 10px; float: right;"></i>');
            $('input[name="fontawesome"]').val(fontawesome);
        });
        $('.modal .color-list li').bind('click', function(){
            color = $(this).data('color');
            $('#color_modal').modal('hide');
            $('#select-color .preview').find('div').remove();
            $('#select-color .preview').append('<div style="background: ' +color + '; width:26px;height:26px;"></div>');
            $('input[name="color"]').val(color);
        });
        $('#all-cat').on('click','.cat', function(){
            id = $(this).attr('id').substring(4);
            fontawesome = $(this).find('i').attr('class').substring(3);
            title = $(this).find('span').text();
            color = $(this).find('a').css("color");
            $('input[name="fontawesome"]').val(fontawesome);
            $('input[name="color"]').val(color);
            $('input[name="title"]').val(title);
            $('input[name="id"]').val(id);
            $('#select-icon .preview').find('i').remove();
            $('#select-color .preview').find('div').remove();
            $('#select-icon .preview').append('<i class="fa ' + fontawesome + '" style="font-size:30px; margin-left: 10px; float: right;"></i>');
            $('#select-color .preview').append('<div style="background: ' +color + '; width:26px;height:26px;"></div>');
            $('#dynamic-h5').text('編輯分類');
            $('button.save').text('更新');
            $('#dynamic-btn').show();
        });
        $('#add').bind('click', function(){
            $('input[name="id"]').val('');
            $('input[name="fontawesome"]').val('');
            $('input[name="color"]').val('');
            $('input[name="title"]').val('');
            $('#dynamic-h5').text('新增分類');
            $('#dynamic-btn').hide();
            $('#select-icon .preview').find('i').remove();
            $('#select-color .preview').find('div').remove();
            $('button.save').text('新增');
        });
        $('.save').bind('click', function(){
            $count =0;
            $('input[required]').each(function(){
                if($(this).val() == '') {
                    toastr.error($(this).attr('placeholder')+' 尚未填寫');
                    $count++;
                }
            });
            if($count==0){
                var fontawesome = $('input[name="fontawesome"]').val(),
                    id = $('input[name="id"]').val(),
                    title = $('input[name="title"]').val(),
                    color = $('input[name="color"]').val(),
                    token = $('meta[name="csrf-token"]').attr('content');
                if(id == ''){
                    console.log('add');
                    $.ajax({
                        method: 'POST',
                        data: {
                            _token: token,
                            title: title,
                            fontawesome: fontawesome,
                            color: color
                        },
                        url: '/career/auth/category',
                        success: function(data){
                            $('#all-cat').append('<div id="cat-' + data.id + '" class="cat infont col-md-3 col-sm-4"><a href="#" style="color:'+data.color+'"><i class="fa ' + data.fontawesome + '" style="color:'+data.color+'"></i><span> ' + data.title + '<span/></a> </div>')
                        }
                    })
                }else {
                    console.log('edit');
                    $.ajax({
                        method: 'POST',
                        data: {
                            _token: token,
                            title: title,
                            fontawesome: fontawesome,
                            id: id,
                            color: color
                        },
                        url: '/career/auth/category/update/'+id,
                        success: function(data){
                            console.log('success');
                            $('#cat-'+data.id).find('i').animate({opacity: 0},300, function() {
                                $(this).attr('class', 'fa '+ data.fontawesome).animate({color: '#1ab394',opacity: 1},700, function() {
                                    $(this).animate({color: data.color},1000)
                                });
                            });
                            $('#cat-'+data.id).find('span').animate({opacity: 0},300, function() {
                                $(this).text(data.title).animate({color: '#1ab394',opacity: 1},700, function() {
                                    $(this).animate({color: data.color},1000)
                                });
                            });
                        }
                    })
                }
            }
        });
    }
});