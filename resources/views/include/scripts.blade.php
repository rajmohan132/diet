<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<audio id="myAudio">
    <source src="{{ URL::asset('assets/sound/notification.mp3') }}" type="audio/mpeg">
</audio>
<script>
    var audio = document.getElementById("myAudio");

    function playAudio() {
        audio.play();
    }

    function pauseAudio() {
        audio.pause();
    }
</script>

<script>
    setInterval(function () {
        $.get({
            url: '{{route('get-subscrption-data')}}',
            dataType: 'json',
            success: function (response) {
                let data = response.data;
                if (data.new_order > 0) {
                    playAudio();
                    $('#popup-modal').appendTo("body").modal('show');
                }
            },
        });
    }, 1000);

    function check_order() {
		location.href = '{{url('viewsubscrption-list')}}';
    }
</script>


<script src="{{ URL::asset('assets/js/core/libs.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/core/external.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/charts/widgetcharts.js') }}"></script>
<script src="{{ URL::asset('assets/js/charts/vectore-chart.js') }}"></script>
<script src="{{ URL::asset('assets/js/charts/dashboard.js') }}"></script>
<script src="{{ URL::asset('assets/js/charts/admin.js') }}"></script>
<script src="{{ URL::asset('assets/js/fslightbox.js') }}"></script>
<script src="{{ URL::asset('assets/vendor/gsap/gsap.min.js') }}"></script>
<script src="{{ URL::asset('assets/vendor/gsap/ScrollTrigger.min.js') }}"></script>
<script src="{{ URL::asset('assets/animation/gsap-init.js') }}"></script>
<script src="{{ URL::asset('assets/js/stepper.js') }}"></script>
<script src="{{ URL::asset('assets/js/form-wizard.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
<script src="{{ URL::asset('assets/vendor/moment.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/script.js') }}"></script>
<script src="{{ URL::asset('assets/js/muliselect.js') }}"></script>
<script src="{{ URL::asset('assets/js/virtual-select.min.js') }}"></script>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>


<script>
  $(document).ready(function() {
    // show the alert
    setTimeout(function() {
      $(".alert").alert('close');
    }, 2000);
  });
</script>
<script>
    $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
 </script>

<script>
        $(document).ready(function () {
            $("#test").CreateMultiCheckBox({  defaultText : 'Select Below', height:'250px' });
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#tests").CreateMultiCheckBox({  defaultText : 'Select Below', height:'250px' });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).on("click", ".MultiCheckBox", function () {
                var detail = $(this).next();
                detail.show();
            });

            $(document).on("click", ".MultiCheckBoxDetailHeader input", function (e) {
                e.stopPropagation();
                var hc = $(this).prop("checked");
                $(this).closest(".MultiCheckBoxDetail").find(".MultiCheckBoxDetailBody input").prop("checked", hc);
                $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();
            });

            $(document).on("click", ".MultiCheckBoxDetailHeader", function (e) {
                var inp = $(this).find("input");
                var chk = inp.prop("checked");
                inp.prop("checked", !chk);
                $(this).closest(".MultiCheckBoxDetail").find(".MultiCheckBoxDetailBody input").prop("checked", !chk);
                $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();
            });

            $(document).on("click", ".MultiCheckBoxDetail .cont input", function (e) {
                e.stopPropagation();
                $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();

                var val = ($(".MultiCheckBoxDetailBody input:checked").length == $(".MultiCheckBoxDetailBody input").length)
                $(".MultiCheckBoxDetailHeader input").prop("checked", val);
            });

            $(document).on("click", ".MultiCheckBoxDetail .cont", function (e) {
                var inp = $(this).find("input");
                var chk = inp.prop("checked");
                inp.prop("checked", !chk);

                var multiCheckBoxDetail = $(this).closest(".MultiCheckBoxDetail");
                var multiCheckBoxDetailBody = $(this).closest(".MultiCheckBoxDetailBody");
                multiCheckBoxDetail.next().UpdateSelect();

                var val = ($(".MultiCheckBoxDetailBody input:checked").length == $(".MultiCheckBoxDetailBody input").length)
                $(".MultiCheckBoxDetailHeader input").prop("checked", val);
            });

            $(document).mouseup(function (e) {
                var container = $(".MultiCheckBoxDetail");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.hide();
                }
            });
        });

        var defaultMultiCheckBoxOption = {defaultText: 'Select Below', height: '200px' };

        jQuery.fn.extend({
            CreateMultiCheckBox: function (options) {

                var localOption = {};
                localOption.width = (options != null && options.width != null && options.width != undefined) ? options.width : defaultMultiCheckBoxOption.width;
                localOption.defaultText = (options != null && options.defaultText != null && options.defaultText != undefined) ? options.defaultText : defaultMultiCheckBoxOption.defaultText;
                localOption.height = (options != null && options.height != null && options.height != undefined) ? options.height : defaultMultiCheckBoxOption.height;

                this.hide();
                this.attr("multiple", "multiple");
                var divSel = $("<div class='MultiCheckBox'>" + localOption.defaultText + "<span class='k-icon k-i-arrow-60-down'><svg aria-hidden='true' focusable='false' data-prefix='fas' data-icon='sort-down' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512' class='svg-inline--fa fa-sort-down fa-w-10 fa-2x'><path fill='currentColor' d='M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41z' class=''></path></svg></span></div>").insertBefore(this);
                divSel.css({ "width": localOption.width });

                var detail = $("<div class='MultiCheckBoxDetail'><div class='MultiCheckBoxDetailHeader'><input type='checkbox' class='mulinput' value='-1982' /><div>Select All</div></div><div class='MultiCheckBoxDetailBody'></div></div>").insertAfter(divSel);
                detail.css({ "width": parseInt(options.width) + 10, "max-height": localOption.height });
                var multiCheckBoxDetailBody = detail.find(".MultiCheckBoxDetailBody");

                this.find("option").each(function () {
                    var val = $(this).attr("value");

                    if (val == undefined)
                        val = '';

                    multiCheckBoxDetailBody.append("<div class='cont'><div><input type='checkbox' class='mulinput' value='" + val + "' /></div><div>" + $(this).text() + "</div></div>");
                });

                multiCheckBoxDetailBody.css("max-height", (parseInt($(".MultiCheckBoxDetail").css("max-height")) - 28) + "px");
            },
            UpdateSelect: function () {
                var arr = [];

                this.prev().find(".mulinput:checked").each(function () {
                    arr.push($(this).val());
                });

                this.val(arr);
            },
        });
      </script>

<script>

function clear_cache() {
    Swal.fire({
      title: 'Are you sure want to clear System cache?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, clear it!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'clear-cache';
        Swal.fire(
          'Cleared!',
          'System cache has been cleared.',
          'success'
        )
      }
    })
  }

    function emptyDatabase() {
    Swal.fire({
      title: 'Are you sure want clear Database?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, clear it!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'setting/empty-database';
        Swal.fire(
          'Cleared!',
          'Database has been cleared.',
          'success'
        )
      }
    })
  }
  function logout() {
    Swal.fire({
      title: 'Are you sure want logout?',
      text: "Please Save all the things!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Logout!'
    }).then((result) => {
      if (result.isConfirmed) {
        $('#logout-form').submit();
        //window.location.href = 'logout';
        Swal.fire(
          'Success!',
          'Successfully Logout.',
          'success'
        )
      }
    })
  }
</script>

<script>
$(function() {

    $('#select_all').click(function() {
        if ($(this).prop('checked')) {
            $('.priv').prop('checked', true);
        } else {
            $('.priv').prop('checked', false);
        }
    });

});
</script>

<script>
$("#dietplan").change(function(){

  var plan = $("#dietplan").val();
  $.ajax({

      url:"{{route('product-filter-sub-plan')}}",
      method:'POST',
      data:{plan:plan, "_token":"{{csrf_token()}}" },
      dataType:'JSON',
      success:function(res){
              console.log(res);
              $("#subplan").html('');
              $("#subplan").append('<option value="">Select Calories Plan</option>');
              for(var i = 0; i<res.length; i++){
                console.log(res[i].splanname);
                $("#subplan").append('<option value=' + res[i].id + '>' + res[i].splanname + '</option>');
              }
      }

  })

})

</script>

<script>
$("#customer-plan").change(function(){

  var plan = $("#customer-plan").val();
  $.ajax({

      url:"{{route('find_num_days')}}",
      method:'POST',
      data:{plan:plan, "_token":"{{csrf_token()}}" },
      dataType:'JSON',
      success:function(res){

              console.log(res.num_days);
              $('#days').val(res.num_days);
              
              }

  })

})

</script>

<script>
$("#plan_from").change(function(){

    from_date = new Date($("#plan_from").val());
    
    var weeks = $("#days").val();
    var days = parseInt(weeks*7);

    output_f = new Date(from_date.setDate(from_date.getDate()+ days)).toISOString().split('.');
    output_s = output_f[0].split('T');
    $("#plan_to").val(output_s[0]);
    console.log(output_f);

       
})
</script>

<script>
$("#customer-plan").change(function(){
  $("#price").val('0.00');
  var plan = $("#customer-plan").val();
  $.ajax({

      url:"{{route('filter-sub-plan')}}",
      method:'POST',
      data:{plan:plan, "_token":"{{csrf_token()}}" },
      dataType:'JSON',
      success:function(res){
              console.log(res);
              $("#customer-subplan").html('');
              $("#customer-subplan").append('<option value="">Select Calories Plan</option>');
              for(var i = 0; i<res.length; i++){
                console.log(res[i].splanname);
                $("#customer-subplan").append('<option value=' + res[i].id + '>' + res[i].splanname + '</option>');
              }
      }

  })

})

$("#customer-subplan").change(function(){

var subplan = $("#customer-subplan").val();
$.ajax({

    url:"{{route('get_subplan_price')}}",
    method:'POST',
    data:{subplan:subplan, "_token":"{{csrf_token()}}" },
    dataType:'JSON',
    success:function(res){
            $("#price").val(res.price);
    }

})

})


</script>

<script>
VirtualSelect.init({ 
  ele: '#custom-category' 
});
</script>

<script>
function pass_modal(id){

  $.ajax({
      url:'{{route('findcustomplan')}}',
      method:"POST",
      data:{id:id , "_token":"{{csrf_token()}}" },
      success:function(res){
        console.log(res);
        $("#result").html(res);
      }
      
  })

}
</script>

<script type="text/javascript">
    // $('.table').dataTable({
    //   aaSorting: [[0, 'DESC']]
    // });
    $(document).ready(function() {
        "use strict";

        $('#update_app_settings').on('submit', function(event) {
  
            event.preventDefault();
            var form_data = new FormData(this);
            $('#preloader').show();
            $.ajax({
                url: "{{ URL::to('app_settings_update') }}",
                method: "POST",
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(result) {
                    $('#preloader').hide();
                    var msg = '';
                    if (result.success == "success") {
                        toastr.success('Uploaded Successfully');
                    } else {
                        toastr.error('Failed To Uploaded');
                    }
                },
            })
        });


    });
</script>
<script type="text/javascript">
    // $('.table').dataTable({
    //   aaSorting: [[0, 'DESC']]
    // });
    $(document).ready(function() {
        "use strict";

        $('#add_company_settings').on('submit', function(event) {
            event.preventDefault();
            var form_data = new FormData(this);
            $('#preloader').show();
            $.ajax({
                url: "{{ URL::to('add_company_settings') }}",
                method: "POST",
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(result) {
                    $('#preloader').hide();
                    var msg = '';
                    if (result.success == 'success') {
                        toastr.success('Uploaded Successfully');
                    } else {
                        toastr.error('Failed To Uploaded');
                    }
                },
            })
        });


    });

    
    
</script>

<script>
  // check for saved 'darkMode' in localStorage
let darkMode = localStorage.getItem('darkMode'); 

const darkModeToggle = document.querySelector('#darkModeIcon');

const enableDarkMode = () => {
  // 1. Add the class to the body
  document.body.classList.add('darkmode');
  // 2. Update darkMode in localStorage
  localStorage.setItem('darkMode', 'enabled');
}

const disableDarkMode = () => {
  // 1. Remove the class from the body
  document.body.classList.remove('darkmode');
  // 2. Update darkMode in localStorage 
  localStorage.setItem('darkMode', null);
}
 
// If the user already visited and enabled darkMode
// start things off with it on
if (darkMode === 'enabled') {
  enableDarkMode();
}

// When someone clicks the button
darkModeToggle.addEventListener('click', () => {
  // get their darkMode setting
  darkMode = localStorage.getItem('darkMode'); 
  
  // if it not current enabled, enable it
  if (darkMode !== 'enabled') {
    enableDarkMode();
  // if it has been enabled, turn it off  
  } else {  
    disableDarkMode(); 
  }
});
</script>