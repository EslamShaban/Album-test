<script type="text/javascript">

    function deleteItem(attr){
        swal({
            title: "{{ __('admin.sure')}}",
            //text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "{{ __('admin.yes')}}",
            cancelButtonText: "{{ __('admin.no')}}",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                swal("{{ __('admin.deleted')}}", "", "success");
            $(attr).submit();
            } else {
                swal("{{ __('admin.cancelled')}}", "", "error");
            }
        });
    }

    function dragNdrop(event) {
        var fileName = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("preview");
        var previewImg = document.createElement("img");
        previewImg.setAttribute("src", fileName);
        preview.innerHTML = "";
        preview.appendChild(previewImg);
    }
    function drag() {
        document.getElementById('uploadFile').parentNode.className = 'draging dragBox';
    }
    function drop() {
        document.getElementById('uploadFile').parentNode.className = 'dragBox';
    }

        
    $('#modalToggle').click(function() {
      $('#modal').modal();
    });

    $("a[href='" + window.location.href + "']").addClass('active');
</script>

@yield('js')
